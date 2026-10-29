# Tra cứu tên miền

- Trang client: `/domains`; truy cập từ mục **Tên miền** trong danh mục dịch vụ.
- Nhập tên đầy đủ hoặc một từ khóa (mặc định `.com`). Mỗi lần tải 6 tên miền gợi ý theo danh sách đuôi tên miền trong admin.
- Khi chưa có registrar: tra cứu dữ liệu đăng ký công khai qua RDAP, sử dụng máy chủ từ danh sách IANA. Kết quả không chứa thông tin cá nhân chủ thể.
- “Chưa tìm thấy bản ghi đăng ký” chưa phải xác nhận tên miền có thể mua. Lỗi mạng, đuôi chưa hỗ trợ, dữ liệu không hợp lệ đều trả trạng thái chưa kiểm tra được.
- Giá chưa cấu hình được ẩn. Không tự bật đăng ký/chuyển tên miền; nút liên hệ dùng trang liên hệ hiện có. Tab chuyển tên miền hiện phục vụ tra cứu và liên hệ tư vấn.
- Có cache ngắn, giới hạn truy vấn theo IP, CSRF, kiểm tra đầu vào và giới hạn thời gian/kích thước phản hồi.

## Cấu hình nhà cung cấp sau

1. **Setup > Products/Services > Domain Registrars**: kích hoạt module registrar và nhập thông tin API trong admin.
2. **Setup > Products/Services > Domain Pricing**: cấu hình đuôi tên miền, giá bán, registrar tự động và nhà cung cấp tra cứu hỗ trợ `CheckAvailability`.
3. **Setup > General Settings > Domains**: bật đăng ký/chuyển tên miền khi đã kiểm thử với nhà cung cấp.
4. Trang mới chỉ cung cấp nút đăng ký khi registrar xác nhận khả dụng, đã có giá và chức năng đăng ký được bật. Luồng đặt mua/đăng ký sử dụng giỏ hàng WHMCS hiện có.

## Các điểm dữ liệu

- `tbldomainpricing`: đuôi tên miền, thứ tự gợi ý, nhà đăng ký cấu hình cho TLD.
- `tblpricing`: `type = domainregister`, `relid = tbldomainpricing.id`, `currency`; `msetupfee` là giá đăng ký 1 năm. Giá âm nghĩa là chưa bán.
- `tblconfiguration`: `domainLookupProvider`, `domainLookupRegistrar`, `AllowRegister`, `PremiumDomains`.
- `tblproductgroups`: nhóm dịch vụ công khai cho danh mục và dịch vụ liên quan.
- API mới chỉ đọc dữ liệu, không tạo đơn hàng, hóa đơn hay bản ghi tên miền.

Kiểm tra trình duyệt: tên miền đã đăng ký/chưa có bản ghi, lỗi đầu vào/CSRF, gợi ý phân trang không trùng, tiếng Việt/Anh, khách/chủ tài khoản và chiều rộng mobile. Nhà cung cấp chưa cấu hình nên chưa kiểm thử mua hoặc chuyển tên miền thực tế.
