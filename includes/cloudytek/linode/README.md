# Cloudytek Linode — tích hợp trực tiếp trong source WHMCS

Không dùng addon trong `modules/addons`, không phụ thuộc WGS, không sửa cơ chế license WHMCS. Code được viết riêng trên API và OpenAPI chính thức của Linode.

## Truy cập trên bản local hiện tại

- Admin: `http://127.0.0.1:8178/admin/cloudytek-linode.php` hoặc menu **Linode**.
- Khách hàng: `linode.php?serviceid=<WHMCS service ID>`; nút **Manage cloud service** xuất hiện tại trang chi tiết dịch vụ đã liên kết.
- Database đã có 5 bảng `ctk_linode_*`. Ngày 2026-10-29 đã nhập account `jpt-sandbox-nghiant` (ID 6) từ `linode_info.txt`: API v4, prefix `cloudytek`, Backup Price `0.0000` do file để trống. Token được mã hóa qua Vault, đã kiểm tra giải mã khớp. Account ở chế độ read-only; chưa cấu hình product mapping hay bật tự động provisioning.
- Đã kiểm tra kết nối thật bằng GET `/profile`, `/linode/instances`, `/regions`, `/linode/types`, `/images`: cả 5 trả HTTP 200, profile khớp Username. Lần kiểm tra ghi nhận 13 instances, 33 regions, 75 types, 43 images; số lượng có thể thay đổi. Không tạo/sửa/xóa tài nguyên provider. Kết quả không chứa token nằm tại `WHMCS-7.8.0-runtime/logs/linode-configuration-result.json`.

## Phạm vi đã viết

| Thành phần | Khả năng |
|---|---|
| Bộ gọi API | 539 operation / 358 endpoint templates, OpenAPI 4.229.1; GET, POST, PUT, DELETE; query / header / path; JSON, PNG và multipart |
| API Explorer admin | Tìm thao tác theo tên / endpoint, xem tham số và schema, gọi toàn bộ operation của catalogue cài đặt |
| Account | Nhiều token / account, v4 hoặc v4beta; quyền ghi tắt mặc định; PAT / OAuth bearer hoặc bearer chuyên biệt do người quản trị cung cấp |
| Product mapping | Ánh xạ sản phẩm, account, loại tài nguyên, payload khởi tạo và quyền thao tác khách hàng |
| Tự động hóa | InvoicePaid → job bền vững → tạo tài nguyên → liên kết service → theo dõi provider state → cập nhật WHMCS Active khi đủ điều kiện |
| Client | Chỉ đọc tài nguyên được gán cho service của khách; các thao tác ghi có danh sách cho phép, kiểm tra ownership và xác nhận |
| Bảo mật | CSRF, role admin, kiểm tra chủ sở hữu, token / payload mã hóa AES-256-GCM, HTTPS verification, API host cố định, che dữ liệu nhạy cảm mặc định |
| Vận hành | Audit, job chống trùng, kiểm tra invoice trước khi gọi provider, chống tự tạo lại khi timeout / kết quả không rõ |

### 14 loại tài nguyên có mapping khởi tạo và liên kết service

Compute Linode (gồm plan CPU / GPU theo tài khoản); Block Storage volume; DNS domain zone; firewall; VPC; NodeBalancer; LKE; MySQL; PostgreSQL; Valkey; Object Storage bucket; Longview client; StackScript; image.

Các nhóm khác trong API như account, billing provider, IAM, OAuth, quota, managed services, monitor, alerts, logs, support, networking, SSH key, image sharing… sử dụng API Explorer / lớp gọi API. Các thao tác này thuộc quyền quản trị; không mở các API account chung cho khách hàng.

Các thao tác khách được bật riêng theo gói: boot, shutdown, reboot, rebuild OS, reset password, snapshot, restore backup vào chính máy của service, enable/cancel backups, cấp IP, rDNS IPv4 của chính service, DNS record CRUD. Resize, đổi plan, xóa tài nguyên và các thao tác account để admin thực hiện. Giao diện client nâng cao sử dụng lựa chọn action cùng JSON parameters; chưa có form riêng cho từng operation.

## Thiết lập để sử dụng thật

1. Mở **Accounts**: tạo PAT trong Linode với quyền cần thiết, nhập vào form token; giữ read-only để kiểm tra kết nối. Token được mã hóa, không hiện lại trong form. Trường token bỏ trống khi sửa account sẽ giữ token cũ.
   Form gồm **API URL**, **API Key**, **Username**, **Prefix**, **Backup Price**; không có License Key. API URL cố định theo host Linode và phiên bản v4 / v4beta. Username là thông tin tham chiếu tùy chọn. Prefix (1–10 ký tự chữ thường / số / dấu gạch ngang) áp dụng cho label mới; label / binding đã có được giữ nguyên. Backup Price lưu giá tham chiếu theo tháng, chưa tự tạo phí trên hóa đơn; cần khai báo WHMCS configurable options cho việc thu tiền backup. Có nút Edit account; API Key bỏ trống khi sửa sẽ giữ key đang lưu.
2. **API Explorer**: gọi `get-profile`, `get-regions`, `get-linode-types`, `get-images` để lấy các giá trị hợp lệ cho account / region. Với các operation chuyên biệt, đọc `security` trong schema và dùng credential đúng loại / quyền; token có hạn cần cập nhật hoặc cấp lại.
3. Tạo hoặc chọn sản phẩm WHMCS. Để **Module Settings = None** và tắt native automatic setup trước khi bật automation trực tiếp; tránh hai hệ thống cùng cấp dịch vụ.
4. **Product mappings**: chọn product ID, account ID, family, nhập đúng JSON payload theo request schema. Các placeholder hỗ trợ: `{{service_id}}`, `{{client_id}}`, `{{domain}}`, `{{password}}`. Non-domain resource được gán label đối soát duy nhất. Với template dùng `{{password}}`, service chưa có mật khẩu sẽ được sinh mật khẩu ngẫu nhiên và lưu qua cơ chế mật khẩu WHMCS.
5. Bật quyền ghi của account và automation trên đúng product. Chỉ bật các thao tác khách phù hợp gói đã bán; backup / IP có thể phát sinh phí provider nên cần được tính vào gói.
6. Đặt cron worker mỗi phút; dùng PHP và cấu hình của môi trường triển khai:

```text
php /path/to/whmcs/includes/cloudytek/linode/worker.php
```

Hook `AfterCronJob` cũng xử lý một batch; dedicated cron giúp giảm thời gian chờ. Các job được claim bằng cập nhật có điều kiện để tránh hai worker cùng xử lý một job.

7. Kiểm thử đơn pilot, đối soát provider và nghiệm thu trước khi mở bán. Local demo hiện chưa có payment gateway thật; hook chạy khi WHMCS ghi nhận hóa đơn Paid qua gateway hoặc quy trình thanh toán hợp lệ.

## Khởi tạo và xử lý ngoại lệ

- Chỉ invoice Paid, đúng chủ sở hữu, service Pending, product bật automation và order không Fraud / Cancelled mới được xếp hàng. Invoice và order được kiểm tra lại lúc worker thực thi.
- Job khóa duy nhất theo service. Chưa có chức năng cấp lại service đã hủy bằng cùng job; trường hợp đó cần quy trình đặt lại / cấp mới được quản trị duyệt.
- GET lỗi tạm thời có retry giới hạn. Mutation không tự retry. Worker bị ngắt, timeout, 5xx hoặc kết quả mutation chưa chắc chắn được giữ ở trạng thái `reconcile`.
- Với job `reconcile`, tra cứu label correlation (domain dùng tên domain) tại provider / API Explorer. Liên kết tài nguyên đã tạo tại **Services**. Nếu chắc chắn chưa có tài nguyên, cần xác minh với provider trước khi xử lý cấp lại; UI hiện chỉ cho retry job thất bại trước khi gọi mutation.
- Readiness dựa vào trạng thái tài nguyên do API trả về; LKE yêu cầu các node trong pool trả về trạng thái ready. Một số tài nguyên không có status được xem là sẵn sàng khi GET resource thành công. Kiểm tra sức khỏe workload / ứng dụng cần bổ sung theo gói triển khai; đây chưa phải kiểm thử sẵn sàng ứng dụng.
- Khi một API admin xóa / thay đổi tài nguyên, người vận hành cần đối soát binding và trạng thái billing WHMCS. Cron hiện theo dõi readiness của tài nguyên mới; chưa tự đồng bộ toàn bộ lifecycle billing, hoàn tiền hoặc usage-based invoicing.

## Giới hạn phạm vi và xác minh

- Bao phủ catalogue ở lớp dispatch/API Explorer không có nghĩa mọi operation đã được nghiệm thu trên tài khoản Linode thật hoặc có form riêng. Snapshot hiện tại 4.229.1 có 539 operation; các cờ `live_verified: false` trong `resources/coverage.json` chưa được cập nhật từ kiểm tra kết nối riêng nêu trên.
- Region, quota, beta access, scope / IAM và credential chuyên biệt quyết định thao tác có được provider cho phép hay không. Đã xác minh 5 GET nêu trên; chưa mua hoặc tạo tài nguyên thật và chưa nghiệm thu các thao tác ghi.
- Linode DNS API quản lý zone / record. Đăng ký và gia hạn tên miền cần registrar riêng. Dedicated CPU là máy ảo; API này không cấp bare-metal của nhà cung cấp khác.
- Object Storage control plane nằm trong Linode API. Upload / download object, S3 signing và chính sách data plane ngoài các endpoint trong snapshot này cần S3 client riêng; chưa được triển khai ở đây.
- OAuth authorization-code onboarding, tự refresh credential chuyên biệt, đồng bộ chi phí / usage thành hóa đơn, đầy đủ UI client theo từng dịch vụ và cấu hình ứng dụng WordPress / mail không nằm trong kiểm thử hoàn tất của bản code này.
- Target đã kiểm tra: source WHMCS 7.8 / PHP 7.3 của workspace. Chưa chứng nhận tương thích WHMCS 9 hoặc production.

## Kiểm thử và cập nhật catalogue

```text
php includes/cloudytek/linode/tests/api_test.php
php includes/cloudytek/linode/tests/worker_test.php
python includes/cloudytek/linode/tools/update_catalog.py
```

API test chạy mock transport cho mọi operation, retry, upload encoding và kiểm tra quyền. Worker test dùng fixture trong transaction, chỉ chạy trên DB demo được chỉ định và rollback cuối test; từ chối chạy khi đã có resource / job integration.

Nguồn OpenAPI, SHA256 và giấy phép Apache được giữ trong `resources/OPENAPI-SOURCE.json`, `openapi.json`, `LICENSE-OPENAPI`. Cập nhật catalogue phải kèm regression test trước khi phát hành.

Role admin mặc định được phép: role ID 1, đồng thời cần quyền WHMCS **View Products/Services**. Copy `admin-roles.example.php` thành `admin-roles.php` để điều chỉnh danh sách role. Trang nội bộ không được thêm vào public menu; client có endpoint riêng kiểm tra ownership.

Các tệp chính: `admin/cloudytek-linode.php`, `linode.php`, `includes/hooks/cloudytek_linode.php`, `includes/cloudytek/linode/lib/*`, templates `kinsmen` / `six`, CSS / JS `assets/*/cloudytek-linode.*`.

## Nguồn chính thức

- [Linode API reference](https://techdocs.akamai.com/linode-api/reference/api)
- [Official OpenAPI repository](https://github.com/linode/linode-api-openapi)
- [WGS Linode Manager — tham khảo chức năng](https://marketplace.whmcs.com/product/1458-whmcs-linode-manager)
