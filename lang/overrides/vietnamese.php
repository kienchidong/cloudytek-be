<?php
if (!defined('WHMCS')) { exit; }
// Client interface and server-side validation; English remains a separate pack.
$cloudytekVietnamese = <<<'LANG'
ordererrorservernohostname|Vui lòng nhập tên máy chủ.
ordererrorservernonameservers|Vui lòng nhập tiền tố cho cả hai máy chủ tên miền.
ordererrorservernorootpw|Vui lòng nhập mật khẩu root cho máy chủ.
ordererrorserverhostnameinuse|Tên máy chủ đã được sử dụng. Vui lòng chọn tên khác.
ordererrornameserver1|Vui lòng nhập máy chủ tên miền thứ nhất.
ordererrornameserver2|Vui lòng nhập máy chủ tên miền thứ hai.
clientareaerrorisrequired|là thông tin bắt buộc.
clientareaerroraddress1|Vui lòng nhập địa chỉ.
clientareaerroraddress12|Địa chỉ chỉ được chứa chữ, số và khoảng trắng.
clientareaerrorbannedemail|Nhà cung cấp email này không được chấp nhận. Vui lòng sử dụng địa chỉ email khác.
clientareaerrorcity|Vui lòng nhập tỉnh hoặc thành phố.
clientareaerrorcity2|Tên thành phố chỉ được chứa chữ và khoảng trắng.
clientareaerrorcountry|Vui lòng chọn quốc gia.
clientareaerrorfirstname2|Tên chỉ được chứa chữ.
clientareaerrorlastname2|Họ chỉ được chứa chữ.
clientareaerrorpasswordconfirm|Vui lòng xác nhận mật khẩu.
clientareaerrorpasswordnotmatch|Mật khẩu nhập lại không khớp.
clientareaerrorphonenumber|Vui lòng nhập số điện thoại.
clientareaerrorphonenumber2|Số điện thoại không hợp lệ.
clientareaerrorpostcode|Vui lòng nhập mã bưu chính.
clientareaerrorpostcode2|Mã bưu chính chỉ được chứa chữ, số và khoảng trắng.
clientareaerrorstate|Vui lòng nhập tỉnh hoặc khu vực.
clientareaerrors|Vui lòng kiểm tra các thông tin sau:
cartaddons|Dịch vụ bổ sung
cartbrowse|Danh sách sản phẩm và dịch vụ
cartavailableaddons|Dịch vụ bổ sung hiện có
cartchoosecycle|Chọn chu kỳ thanh toán
cartconfigdomainextras|Tùy chọn bổ sung cho tên miền
cartconfigoptionsdesc|Chọn các tùy chọn bên dưới để cấu hình dịch vụ theo nhu cầu.
cartconfigserver|Cấu hình máy chủ
cartcustomfieldsdesc|Vui lòng cung cấp thêm thông tin để chúng tôi xử lý đơn hàng.
cartdomainsconfig|Cấu hình tên miền
cartdomainshashosting|Đã có hosting
cartdomainsnohosting|Chưa có hosting. Nhấn để thêm.
cartexistingclientlogin|Đăng nhập tài khoản hiện có
cartexistingclientlogindesc|Đăng nhập để thêm đơn hàng vào tài khoản hiện có.
cartnameserversdesc|Nhập máy chủ tên miền riêng nếu bạn muốn sử dụng. Nếu để trống, tên miền mới sẽ dùng máy chủ tên miền mặc định của chúng tôi.
cartproductaddons|Dịch vụ bổ sung
cartproductaddonschoosepackage|Chọn gói dịch vụ
cartproductaddonsnone|Chưa có dịch vụ bổ sung cho sản phẩm của bạn.
cartproductdesc|Chọn cấu hình cho sản phẩm hoặc dịch vụ bên dưới.
cartproductdomain|Tên miền
cartproductdomainchoose|Chọn tên miền
cartproductdomaindesc|Dịch vụ này yêu cầu tên miền. Vui lòng nhập tên miền bên dưới.
cartproductdomainuseincart|Dùng tên miền có sẵn trong giỏ hàng
cartremoveitemconfirm|Bạn có chắc muốn xóa mục này khỏi giỏ hàng?
carttaxupdateselections|Thuế có thể thay đổi theo quốc gia và khu vực. Nhấn cập nhật sau khi thay đổi lựa chọn.
carttaxupdateselectionsupdate|Cập nhật
cartcongratsdomainavailable|Tên miền %s hiện có thể đăng ký!
cartdomainexists|Tên miền này đã tồn tại trong hệ thống nên không thể đặt lại.
cartdomaininvalid|Tên miền không hợp lệ. Vui lòng nhập tên miền kèm đuôi, không bao gồm www.
cartdomaintaken|Tên miền %s đã được đăng ký.
cartexistingdomainchoice|Dùng tên miền hiện có và cập nhật máy chủ tên miền
cartfraudcheck|Kiểm tra giao dịch
cartotherdomainsuggestions|Tên miền khác bạn có thể quan tâm
cartregisterdomainchoice|Đăng ký tên miền mới
cartsubdomainchoice|Dùng tên miền phụ từ %s
carttransferdomainchoice|Chuyển tên miền từ nhà đăng ký khác
carttransfernotregistered|Tên miền %s chưa được đăng ký.
carttransferpossible|Bạn có thể chuyển tên miền %s về đây với giá %s.
cartSimpleCaptcha|Vui lòng nhập mã xác nhận bên dưới.
cart.availableCreditBalance|Số dư khả dụng của bạn là :amount.
cart.applyCreditAmount|Dùng <span>:amount</span> từ số dư để thanh toán đơn hàng; phần còn lại thanh toán bằng phương thức đã chọn.
cart.applyCreditAmountNoFurtherPayment|Dùng <span>:amount</span> từ số dư để thanh toán toàn bộ đơn hàng.
cart.applyCreditSkip|Không dùng số dư tài khoản; thanh toán toàn bộ bằng phương thức đã chọn.
orderserverhostname|Tên máy chủ
orderservernameservers|Máy chủ tên miền
orderservernameserversdescription|Tiền tố dùng cho máy chủ tên miền mặc định, ví dụ ns1.example.com và ns2.example.com.
orderservernameserversprefix1|Tiền tố thứ nhất
orderservernameserversprefix2|Tiền tố thứ hai
serverhostname|Tên máy chủ
servername|Tên máy chủ
serverns1prefix|Tiền tố NS1
serverns2prefix|Tiền tố NS2
serverrootpw|Mật khẩu root
serverusername|Tên đăng nhập
serverchangepassword|Đổi mật khẩu
addfunds|Nạp tiền
addfundsamount|Số tiền nạp
addfundsmaximum|Số tiền nạp tối đa
addfundsmaximumbalance|Số dư tối đa
addfundsminimum|Số tiền nạp tối thiểu
addfundsnonrefundable|* Tiền đã nạp không được hoàn lại.
additionalInfo|Thông tin bổ sung
addtocart|Thêm vào giỏ hàng
assignedIPs|Các địa chỉ IP được cấp
balancedue|Số tiền cần thanh toán
bandwidth|Băng thông
billingAddress|Địa chỉ thanh toán
bundledeal|Ưu đãi theo bộ
bundlereqsnotmet|Chưa đáp ứng điều kiện của bộ sản phẩm
buyadomain|Mua tên miền
cancellationrequested|Đã yêu cầu hủy
cancellationrequestedexplanation|Dịch vụ này đang có yêu cầu hủy chờ xử lý.
cancelrequestdomain|Hủy gia hạn tên miền?
cancelrequestdomainconfirm|Tôi xác nhận không muốn gia hạn tên miền này.
cancelrequestdomaindesc|Bạn còn một tên miền liên quan đến dịch vụ này.<br />Tên miền sẽ gia hạn vào %s, giá %s cho %s năm.<br /><br />Chọn ô bên dưới nếu muốn ngừng gia hạn và để tên miền hết hạn.
clientareaaccountaddons|Dịch vụ bổ sung của tài khoản
clientareaaddfundsdisabled|Hiện tại hệ thống chưa hỗ trợ nạp tiền trước.
clientareaaddfundsnotallowed|Bạn cần có ít nhất một đơn hàng đang hoạt động trước khi nạp tiền.
clientareaaddon|Dịch vụ bổ sung
clientareaaddonsfor|Dịch vụ bổ sung cho
clientareaaddonorderconfirmation|Đã đặt dịch vụ bổ sung. Vui lòng chọn phương thức thanh toán bên dưới.
clientareabacklink|&laquo; Quay lại
clientareabwlimit|Giới hạn băng thông
clientareabwusage|Băng thông đã sử dụng
clientareacancel|Hủy thay đổi
clientareacancelconfirmation|Đã gửi yêu cầu hủy. Nếu gửi nhầm, vui lòng tạo yêu cầu hỗ trợ ngay để được xử lý.
clientareacancelinvalid|Dịch vụ này đã có yêu cầu hủy nên không thể gửi thêm.
clientareacancellationendofbillingperiod|Cuối chu kỳ thanh toán
clientareacancellationimmediate|Ngay lập tức
clientareacancellationtype|Thời điểm hủy
clientareacancelproduct|Yêu cầu hủy dịch vụ
clientareacancelreason|Lý do hủy dịch vụ
clientareacancelreasonrequired|Vui lòng nhập lý do hủy.
clientareacancelrequest|Yêu cầu hủy dịch vụ
clientareacancelrequestbutton|Gửi yêu cầu hủy
clientareachangepassword|Đổi mật khẩu
clientareachangesuccessful|Thông tin đã được cập nhật thành công.
clientareachoosecontact|Chọn người liên hệ
clientareacontactsemails|Tùy chọn nhận email
clientareacontactsemailsdomain|Email tên miền: thông báo gia hạn và xác nhận đăng ký
clientareacontactsemailsgeneral|Email chung: thông báo và nhắc mật khẩu
clientareacontactsemailsinvoice|Email thanh toán: hóa đơn và nhắc thanh toán
clientareacontactsemailsproduct|Email dịch vụ: thông tin đơn hàng và hướng dẫn sử dụng
clientareacontactsemailssupport|Email hỗ trợ: cho phép người này tạo yêu cầu hỗ trợ
clientareacurrentsecurityanswer|Nhập câu trả lời bảo mật hiện tại.
clientareacurrentsecurityquestion|Chọn câu hỏi bảo mật hiện tại.
clientareadeletecontact|Xóa người liên hệ
clientareadeletecontactareyousure|Bạn có chắc muốn xóa người liên hệ này?
clientareadescription|Xem và cập nhật thông tin tài khoản
clientareadisklimit|Giới hạn dung lượng
clientareadiskusage|Dung lượng đã sử dụng
clientareadomainexpirydate|Ngày hết hạn
clientareadomainnone|Bạn chưa đăng ký tên miền nào tại đây.
clientareaemails|Email của tôi
clientareaemailsdate|Ngày gửi
clientareaemailsintrotext|Lịch sử email chúng tôi đã gửi liên quan đến tài khoản của bạn.
clientareaemailssubject|Tiêu đề email
clientareaexpired|Đã hết hạn
clientareafullname|Tên khách hàng
clientareahostingaddons|Dịch vụ bổ sung
clientareahostingaddonsintro|Các dịch vụ bổ sung của sản phẩm này.
clientareahostingaddonsview|Xem
clientareahostingdomain|Tên miền
clientareahostingpackage|Gói dịch vụ
clientarealastupdated|Cập nhật gần nhất
clientarealeaveblank|Để trống nếu không muốn đổi mật khẩu.
clientareamodifydomaincontactinfo|Cập nhật thông tin liên hệ tên miền
clientareamodifynameservers|Đổi máy chủ tên miền
clientareamodifywhoisinfo|Cập nhật thông tin WHOIS
clientareanameserver|Máy chủ tên miền
clientareanavchangecc|Thông tin thẻ thanh toán
clientareanavorder|Đặt thêm dịch vụ
clientareanavsecurityquestions|Đổi câu hỏi bảo mật
clientareanocontacts|Chưa có người liên hệ.
clientareapendingregistration|Chờ đăng ký
clientareapendingtransfer|Chờ chuyển tên miền
clientareaproductsnone|Bạn chưa đặt sản phẩm hoặc dịch vụ nào.
clientarearegistrationperiod|Thời hạn đăng ký
clientareasecurityanswer|Vui lòng nhập câu trả lời.
clientareasecurityconfanswer|Vui lòng xác nhận câu trả lời.
clientareasecurityquestion|Vui lòng chọn câu hỏi bảo mật.
clientareaselectcountry|Chọn quốc gia
clientareasetlocking|Thiết lập khóa tên miền
clientareaticktoenable|Chọn để bật
clientareaunlimited|Không giới hạn
clientareaupdatebutton|Cập nhật
clientareaupdateyourdetails|Cập nhật thông tin
clientareaused|Đã sử dụng
clientareaviewaddons|Xem dịch vụ bổ sung
clientareaviewdetails|Xem chi tiết
clientareaemaildesc|Lịch sử email của tài khoản
clientareatransferredaway|Đã chuyển đi
clientareacompleted|Hoàn tất
clientareagrace|Thời gian ân hạn sau khi hết hạn
clientarearedemption|Thời gian khôi phục sau khi hết hạn
closewindow|Đóng cửa sổ
completeorder|Hoàn tất đơn hàng
confirmnewpassword|Xác nhận mật khẩu mới
creditCardStore|Lưu thẻ để thanh toán nhanh hơn cho lần sau
creditcard|Thanh toán bằng thẻ
creditcardcardexpires|Ngày hết hạn
creditcardcardissuenum|Số phát hành
creditcardcardnumber|Số thẻ
creditcardcardstart|Ngày bắt đầu
creditcardcardtype|Loại thẻ
creditcardccvinvalid|Vui lòng nhập mã CVV của thẻ.
creditcardcvvnumber|Mã CVV/CVC2
creditcardcvvnumbershort|CVV/CVC2
creditcardcvvwhere|Tìm mã này ở đâu?
creditcarddetails|Thông tin thẻ thanh toán
creditcardenterexpirydate|Vui lòng nhập ngày hết hạn của thẻ.
creditcardenternewcard|Nhập thông tin thẻ mới
creditcardenternumber|Vui lòng nhập số thẻ.
creditcardnumberinvalid|Số thẻ không hợp lệ.
creditcardinvalid|Thông tin thẻ không hợp lệ. Vui lòng thử lại hoặc liên hệ hỗ trợ.
creditcarddeclined|Thẻ bị từ chối. Vui lòng dùng thẻ khác hoặc liên hệ hỗ trợ.
creditcardsecuritynotice|Thông tin được mã hóa khi gửi để hạn chế rủi ro gian lận.
creditcarduseexisting|Dùng thẻ hiện có
creditcardnonestored|Chưa có thẻ được lưu
creditcard3dsecure|Vui lòng hoàn tất xác minh Verified by Visa hoặc Mastercard SecureCode.<br /><br />Không tải lại hoặc quay lại trang trước trong quá trình xác minh.
creditcardconfirmation|Thông tin thẻ đã được chấp nhận và khoản thanh toán đầu tiên đã được thực hiện. Email xác nhận đã được gửi.
days|Ngày
disable|Tắt
disabled|Đã tắt
diskSpace|Dung lượng lưu trữ
doToday|Bạn muốn thực hiện thao tác nào?
enable|Bật
enabled|Đã bật
error|Lỗi
success|Thành công
submitpayment|Thanh toán
thankYou|Cảm ơn bạn
thereisaproblem|Có thông tin cần kiểm tra
problemgoback|Quay lại và thử lại
pleasechooseone|Vui lòng chọn...
print|In
readmore|Đọc thêm
returnclient|Về khu vực khách hàng
returnhome|Về trang chủ
top|Lên đầu trang
withselected|Với các mục đã chọn
visitwebsite|Truy cập website
primaryIP|Địa chỉ IP chính
resourceUsage|Tài nguyên sử dụng
recurringamount|Phí định kỳ
paymentstodate|Đã thanh toán
registered|Đã đăng ký
registerCreateAccount|Để tạo tài khoản, vui lòng
registerCreateAccountOrder|đặt dịch vụ tại đây
submitticketdescription|Gửi yêu cầu hỗ trợ
supportticketclosedmsg|Yêu cầu này đã đóng. Bạn có thể gửi phản hồi để mở lại.
supportticketinvalid|Không tìm thấy yêu cầu hỗ trợ hoặc bạn không có quyền truy cập.
supportticketsheader|Chọn bộ phận phù hợp bên dưới để tạo yêu cầu hỗ trợ.
supportticketsticketcreateddesc|Yêu cầu đã được tạo thành công. Bạn có thể mở yêu cầu để theo dõi và gửi thêm thông tin.
ticketinfo|Thông tin yêu cầu
ticketreatinggiven|Bạn đã đánh giá phản hồi này
supportAndUpdatesClickHereToRenew|Nhấn để gia hạn
supportAndUpdatesExpiredLicense|Thời hạn hỗ trợ và cập nhật của giấy phép này đã hết.
supportAndUpdatesRenewalRequired|Vui lòng gia hạn hỗ trợ và cập nhật trước khi tải tệp này.
suspendreason|Lý do tạm ngừng
pwresetsecurityquestionrequired|Vui lòng trả lời câu hỏi bảo mật của tài khoản bên dưới.
passwordtips|<strong>Gợi ý đặt mật khẩu</strong><br />Dùng cả chữ hoa và chữ thường<br />Thêm ký tự đặc biệt (# $ ! % &amp;...)<br />Tránh từ phổ biến, dễ đoán
registersecurityquestionblurb|Câu hỏi bảo mật giúp xác minh khi thay đổi thông tin tài khoản.
twofactorauth|Xác thực hai bước
twofaenable|Bật xác thực hai bước
twofadisable|Tắt xác thực hai bước
twofaenableclickhere|Nhấn để bật
twofadisableclickhere|Nhấn để tắt
twofasetupgetstarted|Bắt đầu thiết lập
twofaenforced|Bạn cần bật xác thực hai bước trước khi tiếp tục. Vui lòng làm theo hướng dẫn để thiết lập.
twofaactivationmultichoice|Chọn phương thức xác thực hai bước.
twofadisableintro|Nhập mật khẩu để xác nhận tắt xác thực hai bước.
twofaactivationerror|Không thể bật xác thực hai bước. Vui lòng thử lại sau.
twofamoduleerror|Không thể tải phương thức xác thực. Vui lòng thử lại.
twofadisableconfirmation|Đã tắt xác thực hai bước cho tài khoản.
twofabackupcode|Mã dự phòng
twofabackupcodeintro|Dùng mã dự phòng nếu bạn không thể hoàn tất xác thực hai bước.
twofabackupcodeis|Mã dự phòng của bạn là
twofanewbackupcodeis|Mã dự phòng mới của bạn là
twofabackupcodelogin|Nhập mã dự phòng để đăng nhập
twofabackupcodeexpl|Giữ mã dự phòng an toàn như mật khẩu, nên lưu trong trình quản lý mật khẩu.
twofaconfirmpw|Nhập mật khẩu
twofa2ndfactorreq|Vui lòng hoàn tất bước xác thực thứ hai để đăng nhập.
twofa2ndfactorincorrect|Mã xác thực không chính xác. Vui lòng thử lại.
twofabackupcodereset|Đăng nhập bằng mã dự phòng thành công.<br />Mã chỉ dùng một lần và sẽ được thay mới.
twofacantaccess2ndfactor|Không thể truy cập thiết bị xác thực?
twofaloginusingbackupcode|Đăng nhập bằng mã dự phòng
twofageneralerror|Không thể tải phương thức xác thực. Vui lòng thử lại.
twofanowenabled|Đã bật xác thực hai bước
twofacurrently|Xác thực hai bước hiện đang
domainCannotBeManagedUnlessActive|Tên miền chưa hoạt động nên chưa thể quản lý.
domainContactUs|Liên hệ tư vấn
domainalternatives|Thử các tên miền sau:
domainavailable|Có thể đăng ký. Đăng ký ngay
domainavailable1|Chúc mừng!
domainavailable2|hiện có thể đăng ký!
domainavailableexplanation|Nhấn liên kết bên dưới để đăng ký tên miền.
domaincontactinfo|Thông tin liên hệ
domaincurrentrenewaldate|Ngày gia hạn hiện tại
domaindnsaddress|Địa chỉ
domaindnshostname|Tên bản ghi
domaindnsrecordtype|Loại bản ghi
domainemailforwarding|Chuyển tiếp email
domainemailforwardingforwardto|Chuyển tiếp đến
domainemailforwardingprefix|Tiền tố
domaineppcode|Mã EPP
domaineppcodedesc|Lấy mã này từ nhà đăng ký hiện tại để xác thực chuyển tên miền.
domaineppcoderequired|Vui lòng nhập mã EPP cho
domainerror|Không thể kết nối nhà đăng ký tên miền. Vui lòng thử lại sau.
domainerrornodomain|Vui lòng nhập tên miền hợp lệ.
domainerrortoolong|Tên miền quá dài. Độ dài tối đa là 67 ký tự.
domaingeteppcode|Lấy mã EPP
domainaddons|Dịch vụ bổ sung
domainaddonsbuynow|Đăng ký ngay với giá
domainaddonscancelareyousure|Bạn có chắc muốn tắt và hủy dịch vụ bổ sung này?
domainaddonscancelfailed|Không thể tắt dịch vụ bổ sung. Vui lòng liên hệ hỗ trợ.
domainaddonscancelsuccess|Đã tắt dịch vụ bổ sung.
domainaddonsconfirm|Xác nhận hủy
domainaddonsdnsmanagement|Quản lý bản ghi DNS
domainaddonsdnsmanagementinfo|Quản lý DNS để cấu hình kết nối của tên miền với các dịch vụ của bạn.
domainaddonsemailforwardinginfo|Chuyển email đến địa chỉ bạn chọn để theo dõi tại một nơi.
domainaddonsidprotectioninfo|Ẩn thông tin cá nhân để giảm thư rác và bảo vệ chủ sở hữu tên miền.
domainaddonsinfo|Các dịch vụ bổ sung có thể dùng cho tên miền:
domainaddonsperyear|/năm
domainautorenewinfo|Khi bật tự động gia hạn, hệ thống sẽ gửi hóa đơn trước khi tên miền hết hạn và thực hiện gia hạn khi thanh toán thành công.
domainautorenewrecommend|Nên bật tự động gia hạn để tránh mất tên miền.
domainautorenewstatus|Trạng thái tự động gia hạn
changeDomainNS|Đổi máy chủ tên miền
changeRegLock|Thay đổi trạng thái khóa chuyển tên miền
changenameservers|Đổi máy chủ tên miền
changessavedsuccessfully|Đã lưu thay đổi thành công.
registerdomain|Đăng ký tên miền
transferdomain|Chuyển tên miền
transferinadomain|Chuyển tên miền về
renewYourDomain|Gia hạn tên miền
domainprivatenameservers|Máy chủ tên miền riêng
domainsgotocheckout|Tiến hành thanh toán
domainssearchresults|Kết quả tìm kiếm
domainssuggestions|Tên miền gợi ý
domainsothersuggestions|Bạn có thể quan tâm các tên miền sau
domainsmoresuggestions|Xem thêm gợi ý
domainssuggestionswarnings|Tình trạng tên miền có thể thay đổi và sẽ được kiểm tra lại khi thêm vào giỏ hàng.
domainsActive|Đang hoạt động
domainsExpired|Đã hết hạn
domainsCancelled|Đã hủy
domainsFraud|Gian lận
domainsPending|Chờ xử lý
domainsPendingRegistration|Chờ đăng ký
domainsPendingTransfer|Chờ chuyển
domainsTransferredAway|Đã chuyển đi
domainsExpiringSoon|Sắp hết hạn
domaincheckeravailable|Có thể đăng ký
domaincheckertransferable|Có thể chuyển về
domaincheckertaken|Đã được đăng ký
domaincheckeradding|Đang thêm
domaincheckeradded|Đã thêm
domaincheckerunabletooffertld|Hiện chưa hỗ trợ đăng ký đuôi tên miền này.
domaincheckernomoresuggestions|Đã hiển thị hết kết quả. Hãy thử tên hoặc từ khóa khác.
domainchecker.suggestiontakentitle|Tên miền không khả dụng
domainchecker.suggestiontakenmsg|Tên miền đã được đăng ký. Vui lòng quay lại và chọn tên miền khác.
domainchecker.suggestiontakenchooseanother|Chọn tên miền khác
domainchecker.alreadyincarttitle|Đã có trong giỏ hàng
domainchecker.alreadyincartmsg|Tên miền đã có trong giỏ hàng. Bạn có thể tiếp tục thanh toán.
domainchecker.alreadyincartcheckoutnow|Thanh toán ngay
domainChecker.additionalPricingOptions|Tùy chọn giá bổ sung cho :domain
domainCheckerSalesGroup.sale|Ưu đãi
domainCheckerSalesGroup.hot|Nổi bật
domainCheckerSalesGroup.new|Mới
domainChecker.contactSupport|Liên hệ để đăng ký
domainRenewal.availablePeriods|Thời hạn gia hạn hiện có
domainRenewal.unavailable|Chưa thể gia hạn tên miền
domainRenewal.renewingDomains|Gia hạn tên miền
domainRenewal.graceFee|Phí gia hạn trong thời gian ân hạn
domainRenewal.redemptionFee|Phí khôi phục
domainRenewal.hasExpired|Tên miền này đã hết hạn.
domainRenewal.expiringIn|Hết hạn sau :days ngày
domainRenewal.expiredDaysAgo|Đã hết hạn :days ngày trước
domainRenewal.noDomains|Bạn chưa có tên miền đủ điều kiện gia hạn.
domainRenewal.showingDomains|Hiển thị :showing trên :totalCount tên miền
domainRenewal.showAll|Hiển thị tất cả
domainRenewal.maximumAdvanceRenewal|Thời gian gia hạn trước tối đa: :days ngày
invoicesdue|Hóa đơn đến hạn
invoicesduemsg|Bạn có %s hóa đơn chưa thanh toán với tổng số tiền %s.
invoicelineitems|Chi tiết hóa đơn
invoicesPaymentPending|Chờ xác nhận thanh toán
invoicePaymentPendingCleared|Thanh toán đang được xử lý và sẽ tự động cập nhật sau khi được xác nhận.
invoicePaymentAutoWhenDue|Hệ thống sẽ tự động yêu cầu thanh toán khi đến hạn.
upgrade|Nâng cấp
upgradeCredit|Số tiền được khấu trừ khi nâng cấp
upgradeNotPossible|Không thể nâng cấp dịch vụ này. Vui lòng kiểm tra lựa chọn hoặc liên hệ hỗ trợ.
upgradechooseconfigoptions|Nâng cấp hoặc hạ cấp các tùy chọn của dịch vụ.
upgradechoosepackage|Chọn gói dịch vụ mới để nâng cấp hoặc hạ cấp.
upgradecurrentconfig|Cấu hình hiện tại
upgradedowngradechooseproduct|Chọn dịch vụ
upgradenewconfig|Cấu hình mới
upgradenochange|Không thay đổi
upgradeproductlogic|Giá nâng cấp được tính bằng phí gói mới trừ phần phí chưa sử dụng của gói hiện tại trong cùng thời gian.
upgradeerroroverdueinvoice|Đã có hóa đơn cho kỳ gia hạn kế tiếp. Vui lòng thanh toán hóa đơn trước khi nâng cấp hoặc hạ cấp.
upgradeexistingupgradeinvoice|Dịch vụ đang có yêu cầu nâng cấp hoặc hạ cấp. Vui lòng thanh toán hóa đơn liên quan trước khi tiếp tục hoặc liên hệ hỗ trợ.
updateWhoisContact|Cập nhật thông tin liên hệ WHOIS
whoisContactWarning|Hãy cập nhật thông tin liên hệ WHOIS để tránh mất quyền kiểm soát tên miền.
whoisinfo|Thông tin WHOIS
subaccountactivate|Bật tài khoản phụ
subaccountactivatedesc|Cho phép người liên hệ đăng nhập khu vực khách hàng
subaccountallowedperms|Các quyền được phép:
subaccountcontactmaster|Liên hệ chủ tài khoản nếu bạn cho rằng đây là nhầm lẫn.
subaccountpermissiondenied|Bạn không có quyền truy cập trang này.
subaccountpermissions|Quyền của tài khoản phụ
sso.title|Đăng nhập một lần
sso.summary|Ứng dụng bên thứ ba có thể đăng nhập tài khoản qua cơ chế đăng nhập một lần.
sso.enabled|Tài khoản hiện cho phép đăng nhập một lần.
sso.disabled|Tài khoản hiện đã tắt đăng nhập một lần.
sso.disablenotice|Tắt chức năng này nếu không muốn người có quyền truy cập ứng dụng bên thứ ba đăng nhập tài khoản thanh toán.
affiliatesactivate|Kích hoạt tài khoản cộng tác viên
affiliatesamount|Số tiền
affiliatesclicks|Lượt nhấp
affiliatescommission|Hoa hồng
affiliatescommissionsavailable|Hoa hồng có thể rút
affiliatescommissionspending|Hoa hồng chờ duyệt
affiliatesconversionrate|Tỷ lệ chuyển đổi
affiliatesdisabled|Hiện chưa có chương trình cộng tác viên cho tài khoản khách hàng.
affiliatesignupinfo1|Bạn nhận hoa hồng cho các đơn đăng ký qua liên kết giới thiệu riêng.
affiliatesignupinfo2|Lượt giới thiệu được ghi nhận bằng cookie trong tối đa 90 ngày sau lần truy cập đầu tiên. Khách hàng không cần mua ngay để bạn được ghi nhận hoa hồng.
affiliatesignupinfo3|Vui lòng liên hệ nếu bạn cần thêm thông tin.
affiliatesignupintro|Kích hoạt tài khoản cộng tác viên để bắt đầu giới thiệu khách hàng.
affiliatesignuptitle|Nhận hoa hồng khi giới thiệu khách hàng
affiliateslinktous|Liên kết giới thiệu
affiliatesreferallink|Liên kết giới thiệu của bạn
affiliatesreferals|Khách hàng được giới thiệu
affiliatesrequestwithdrawal|Yêu cầu rút tiền
affiliatessignupdate|Ngày đăng ký
affiliatessignups|Lượt đăng ký
affiliatesstatus|Trạng thái
affiliateswithdrawalrequestsuccessful|Yêu cầu rút tiền đã được gửi. Chúng tôi sẽ liên hệ để xử lý.
affiliateswithdrawn|Tổng tiền đã rút
bannedbanexpires|Thời điểm hết chặn
bannedbanreason|Lý do chặn
bannedhasbeenbanned|đã bị chặn
bannedyourip|Địa chỉ IP của bạn
domainbulkmanagementchangeaffect|Thay đổi sẽ áp dụng cho các tên miền sau:
domainbulkmanagementchangesaffect|Các thay đổi bên dưới sẽ áp dụng cho các tên miền sau:
domainbulkmanagementnotpossible|Hiện chưa thể sửa các thiết lập này trong khu vực khách hàng. Vui lòng liên hệ hỗ trợ.
domaincheckerchoosedomain|Chọn tên miền...
domaincontactchoose|Chọn người liên hệ
domaincontactinfoedit|Sửa thông tin liên hệ
domaincontactprimary|Thông tin chủ tài khoản
domaincontactusecustom|Nhập thông tin riêng bên dưới
domaincontactusexisting|Dùng người liên hệ hiện có
domaincurrentlyunlocked|Tên miền hiện chưa khóa chuyển!
domaincurrentlyunlockedexp|Bạn nên bật khóa chuyển, trừ khi đang chuyển tên miền sang nhà đăng ký khác.
domaindnsmanagementdesc|Cấu hình bản ghi DNS để trỏ tên miền đến địa chỉ IP, website hoặc dịch vụ bạn muốn sử dụng.
domaindnsmxonly|Chỉ áp dụng mức ưu tiên cho bản ghi MX
domaindnspriority|Độ ưu tiên
domainemailforwardingdesc|Địa chỉ đích không hợp lệ có thể khiến chuyển tiếp bị tắt tự động. Hãy kiểm tra trước khi bật lại. Thay đổi có thể mất tới một giờ để có hiệu lực.
domaingeteppcodeemailconfirmation|Yêu cầu mã EPP thành công. Mã đã được gửi đến email chủ sở hữu tên miền.
domaingeteppcodeexplanation|Mã EPP dùng để xác thực chủ sở hữu khi chuyển tên miền sang nhà đăng ký khác. Hãy giữ mã này an toàn.
domaingeteppcodefailure|Không thể yêu cầu mã EPP:
domaingeteppcodeis|Mã EPP của tên miền là:
domainidprotection|Bảo vệ thông tin chủ sở hữu
domainlockingexp|Khóa tên miền để ngăn chuyển đi khi chưa được bạn cho phép.
domainmanagens|Quản lý máy chủ tên miền
domainnameserver1|Máy chủ tên miền 1
domainnameserver2|Máy chủ tên miền 2
domainnameserver3|Máy chủ tên miền 3
domainnameserver4|Máy chủ tên miền 4
domainnameserver5|Máy chủ tên miền 5
domainnameservers|Máy chủ tên miền
domainnsexp|Đổi máy chủ tên miền để thay đổi nơi tên miền trỏ đến. Thay đổi có thể mất tới 24 giờ để cập nhật.
domainregisterns|Đăng ký máy chủ tên miền
domainregisternscurrentip|Địa chỉ IP hiện tại
domainregisternsdel|Xóa máy chủ tên miền
domainregisternsexplanation|Tạo và quản lý máy chủ tên miền riêng, ví dụ ns1.example.com hoặc ns2.example.com.
domainregisternsip|Địa chỉ IP
domainregisternsmod|Đổi địa chỉ IP của máy chủ tên miền
domainregisternsnewip|Địa chỉ IP mới
domainregisternsns|Máy chủ tên miền
domainregisternsreg|Đăng ký tên máy chủ tên miền
domainregistrantinfo|Thông tin chủ sở hữu tên miền
domainregistrarlock|Khóa chuyển tên miền
domainreglockdisable|Tắt khóa chuyển
domainreglockenable|Bật khóa chuyển
domainreglockinfo|Khóa chuyển giúp bảo vệ tên miền khỏi việc chuyển đi trái phép.
domainreglockrecommend|Nên bật khóa chuyển, trừ khi bạn đang chuyển tên miền đi.
domainreglockstatus|Trạng thái khóa chuyển
domainregnotavailable|Không khả dụng
domainrelease|Chuyển quyền quản lý tên miền
domainreleasedescription|Nhập TAG của nhà đăng ký mới để chuyển tên miền.
domainreleasetag|TAG của nhà đăng ký mới
domainrenewals|Gia hạn tên miền
domainrenewexp|Bật tự động gia hạn để nhận hóa đơn trước khi tên miền hết hạn.
domains.contactChangePending|Chờ xác nhận thay đổi liên hệ
domains.contactsChanged|Yêu cầu cập nhật WHOIS đã bắt đầu bước xác minh. Email xác nhận đã được gửi đến chủ sở hữu tên miền.
domains.newRegistration|Email xác minh đã được gửi đến chủ sở hữu. Vui lòng hoàn tất xác minh để tránh tên miền bị tạm ngừng.
domains.verificationRequired|Cần xác minh
domainsautorenewdisable|Tắt tự động gia hạn
domainsautorenewdisabled|Đã tắt
domainsautorenewenable|Bật tự động gia hạn
domainsautorenewenabled|Đã bật
domainstransfer|Chuyển tên miền
downloadname|Tải xuống
downloadproductrequired|Bạn cần có dịch vụ sau đang hoạt động để tải tệp này:
downloadscategories|Danh mục
downloadsfiles|Tệp
downloadsfilesize|Dung lượng tệp
downloadsintrotext|Tài liệu hướng dẫn, phần mềm và các tệp hỗ trợ sử dụng dịch vụ.
downloadsnone|Chưa có tệp để tải xuống
downloadspopular|Tệp được tải nhiều
downloadssearch|Tìm tệp tải xuống
edit|Chỉnh sửa
emailviewmessage|Xem nội dung
every|Mỗi
exampledomain|Ví dụ: example.com
existingpassword|Mật khẩu hiện tại
feedbackbest|Tốt nhất
feedbackclickreview|Xem yêu cầu hỗ trợ
feedbackclosed|Bạn có thể đánh giá sau khi yêu cầu đã đóng.
feedbackdesc|Vui lòng đánh giá trải nghiệm làm việc với đội ngũ hỗ trợ qua biểu mẫu bên dưới.
feedbackhandled|đã xử lý yêu cầu này
feedbackimprove|Chúng tôi có thể cải thiện điều gì?
feedbacklastreplied|Phản hồi gần nhất
feedbackopenedat|Thời điểm tạo
feedbackpleasecomment1|Vui lòng nhận xét về
feedbackpleaserate1|Vui lòng đánh giá theo thang điểm 1 đến 10 về
feedbackprovided|Bạn đã gửi đánh giá cho yêu cầu này.
feedbackreceived|Đã nhận đánh giá
feedbackstaffinvolved|Nhân viên tham gia
feedbackthankyou|Cảm ơn bạn đã dành thời gian đánh giá.
feedbacktotalduration|Tổng thời gian
feedbackworst|Kém nhất
findyourdomain|Tìm tên miền mới
firstpaymentamount|Thanh toán lần đầu
go|Thực hiện
goback|Quay lại
homebegin|Bắt đầu tìm tên miền phù hợp với bạn
hostingInfo|Thông tin hosting
howcanwehelp|Bạn cần hỗ trợ gì?
invoicePaymentSuccessAwaitingNotify|Cảm ơn bạn đã thực hiện thanh toán. Hệ thống đang chờ xác nhận và sẽ gửi email khi có kết quả.
invoiceaddcreditamount|Nhập số tiền muốn sử dụng
invoiceaddcreditapply|Dùng số dư
invoiceaddcreditdesc1|Số dư tài khoản của bạn là
invoiceaddcreditdesc2|Bạn có thể dùng số dư để thanh toán hóa đơn bên dưới.
invoiceofflinepaid|Thanh toán thẻ ngoại tuyến được xử lý thủ công.<br />Bạn sẽ nhận email sau khi thanh toán được xử lý.
invoicepaymentfailedconfirmation|Thanh toán chưa thành công.<br />Vui lòng thử lại hoặc liên hệ hỗ trợ.
invoicepaymentpendingreview|Thanh toán đã được gửi và đang chờ 2CheckOut kiểm tra. Hóa đơn sẽ được cập nhật sau khi hoàn tất.<br /><br />Quá trình có thể mất vài giờ.
invoicepaymentsuccessconfirmation|Thanh toán thành công. Cảm ơn bạn!
invoicesbacktoclientarea|&laquo; Về khu vực khách hàng
invoicesbalance|Số tiền còn lại
invoicescollections|Chuyển xử lý công nợ
invoicescredit|Số dư được sử dụng
invoicesdescription|Mô tả
invoicesdownload|Tải xuống
invoicesdraft|Bản nháp
invoiceserror|Đã xảy ra lỗi. Vui lòng thử lại.
invoicesinvoicedto|Thông tin người nhận hóa đơn
invoicesnotes|Ghi chú
invoicespartialpayments|Thanh toán một phần
invoicespayto|Đơn vị nhận thanh toán
invoicessubtotal|Tạm tính
invoicestaxindicator|Mục chịu thuế
invoicestotal|Tổng cộng
invoicestransamount|Số tiền
invoicestransdate|Ngày giao dịch
invoicestransgateway|Cổng thanh toán
invoicestransid|Mã giao dịch
invoicestransnonefound|Chưa có giao dịch liên quan.
jobtitle|Chức danh
jobtitlereqforcompany|(Bắt buộc nếu có tên tổ chức)
jumpto|Đi đến
kbsuggestions|Bài viết gợi ý
kbsuggestionsexplanation|Các bài viết sau có thể giải đáp câu hỏi của bạn. Hãy tham khảo trước khi gửi yêu cầu.
kbviewingarticlestagged|Bài viết có thẻ
knowledgebasearticles|Bài viết
knowledgebasecategories|Danh mục
knowledgebasehelpful|Câu trả lời có hữu ích không?
knowledgebaseno|Không
knowledgebasenoarticles|Chưa có bài viết.
knowledgebasepopular|Bài viết được xem nhiều
knowledgebaserating|Đánh giá:
knowledgebaseratingtext|người thấy hữu ích
knowledgebaserelated|Bài viết liên quan
knowledgebasevotes|Lượt đánh giá
knowledgebaseyes|Có
logoutcontinuetext|Nhấn để tiếp tục...
makepayment|Thanh toán
managedomain|Quản lý tên miền
manageproduct|Quản lý dịch vụ
masspaymakepayment|Thanh toán
masspaymentselectgateway|Chọn cổng thanh toán tổng hợp
moduleactionfailed|Thao tác thất bại
moduleactionsuccess|Thao tác hoàn tất thành công!
navregisterdomain|Đăng ký tên miền mới
networkissuesaffecting|Ảnh hưởng đến
networkissuesdate|Ngày
networkissueslastupdated|Cập nhật gần nhất
networkissuespriority|Độ ưu tiên
networkissuestypeserver|Máy chủ
newpassword|Mật khẩu mới
news|Tin tức
newsletterremoved|Bạn đã hủy đăng ký nhận email.
newsletterresubscribe|Bạn có thể đăng ký lại trong mục %sThông tin tài khoản%s bất cứ lúc nào.
newslettersubscribed|Bạn đã đăng ký nhận email thành công.
noannouncements|Chưa có thông báo.
nosupportdepartments|Chưa có bộ phận hỗ trợ. Vui lòng thử lại sau.
nschoicecustom|Dùng máy chủ tên miền riêng (nhập bên dưới)
nschoicedefault|Dùng máy chủ tên miền mặc định
oops|Có lỗi xảy ra
orderForm.domainAddedToCart|Đã thêm tên miền vào giỏ hàng.
orderForm.domainAlternativeContact|Bạn có thể nhập thông tin chủ sở hữu khác nếu đăng ký tên miền thay người hoặc tổ chức khác. Bỏ qua mục này nếu không cần.
orderForm.domainAvailabilityCached|Kết quả tìm kiếm được lưu tạm nên tên miền vừa được đăng ký có thể vẫn hiển thị còn trống.
orderForm.findNewDomain|Nhập tên hoặc từ khóa bên dưới để tìm tên miền có thể đăng ký.
orderForm.promotionAccepted|Đã áp dụng mã khuyến mãi và cập nhật tổng tiền.
orderForm.registerLongerAndSave|Đăng ký thời hạn dài hơn để tiết kiệm!
orderForm.removeItem|Xóa mục này
orderForm.reviewDomainAndAddons|Kiểm tra tên miền và dịch vụ bổ sung đã chọn.
orderForm.transferExistingDomain|Chuyển tên miền hiện có về quản lý tại đây.
orderForm.tryRegisteringInstead|Thử đăng ký tên miền này.
orderForm.updateTotals|Cập nhật tổng tiền
orderaddon|Dịch vụ bổ sung
ordercompletebutnotpaid|Đơn hàng đã tạo nhưng chưa thanh toán nên dịch vụ chưa được kích hoạt.<br />Mở hóa đơn bên dưới để thanh toán.
orderconfigpackage|Tùy chọn cấu hình
orderconfigure|Cấu hình
orderconfirmation|Xác nhận đơn hàng
ordercontinuebutton|Tiếp tục &raquo;
orderdesc|Mô tả
orderdomainregistration|Đăng ký tên miền
orderdomaintransfer|Chuyển tên miền
orderdontusepromo|Không dùng mã khuyến mãi
ordererroraccepttos|Bạn cần đồng ý với điều khoản dịch vụ.
orderfinalinstructions|Nếu cần hỗ trợ về đơn hàng, vui lòng tạo yêu cầu trong khu vực khách hàng và cung cấp mã đơn hàng.
orderfreedomainappliesto|chỉ áp dụng với các đuôi tên miền sau
orderfreedomainregistration|Đăng ký tên miền miễn phí
ordernotesdescription|Nhập ghi chú hoặc thông tin bổ sung cho đơn hàng...
ordernumberis|Mã đơn hàng của bạn:
orderpromotioncode|Mã khuyến mãi
orderreceived|Cảm ơn bạn đã đặt hàng. Bạn sẽ nhận email xác nhận sau khi đơn được xử lý.
orderregperiod|Thời hạn đăng ký
ordersecure|Để bảo vệ giao dịch, địa chỉ IP hiện tại của bạn
ordersecure2|được ghi nhận.
ordertos|Điều khoản dịch vụ
ordertosagreement|Tôi đã đọc và đồng ý với
orderyears|Năm
organizationname|Tên tổ chức
overview|Tổng quan
page|Trang
paymentMethods.actions|Thao tác
paymentMethods.addFailed|Không thể thêm phương thức thanh toán. Vui lòng thử lại.
paymentMethods.addNewBank|Thêm tài khoản ngân hàng
paymentMethods.addNewCC|Thêm thẻ thanh toán
paymentMethods.addedSuccess|Đã thêm phương thức thanh toán.
paymentMethods.areYouSure|Bạn có chắc chắn không?
paymentMethods.cardDescription|Mô tả thẻ
paymentMethods.close|Đóng
paymentMethods.default|Mặc định
paymentMethods.defaultUpdateFailed|Không thể đổi phương thức mặc định. Vui lòng thử lại.
paymentMethods.defaultUpdateSuccess|Đã cập nhật phương thức thanh toán mặc định.
paymentMethods.delete|Xóa
paymentMethods.deleteFailed|Không thể xóa phương thức thanh toán. Vui lòng thử lại.
paymentMethods.deletePaymentMethodConfirm|Bạn có chắc muốn xóa phương thức thanh toán này? Thao tác không thể hoàn tác.
paymentMethods.deleteSuccess|Đã xóa phương thức thanh toán.
paymentMethods.description|Mô tả
paymentMethods.descriptionInput|Nhập tên nhận biết cho thẻ
paymentMethods.edit|Chỉnh sửa
paymentMethods.fieldRequired|Vui lòng nhập thông tin này.
paymentMethods.intro|Các phương thức và thiết lập thanh toán của bạn.
paymentMethods.name|Tên
paymentMethods.noPaymentMethodsCreated|Bạn chưa thêm phương thức thanh toán.
paymentMethods.saveChanges|Lưu thay đổi
paymentMethods.saveFailed|Không thể lưu phương thức thanh toán. Vui lòng thử lại.
paymentMethods.setAsDefault|Đặt làm mặc định
paymentMethods.status|Trạng thái
paymentMethods.type|Loại
paymentMethods.updateSuccess|Đã cập nhật phương thức thanh toán.
paymentMethodsManage.accountHolderName|Tên chủ tài khoản
paymentMethodsManage.accountNumber|Số tài khoản
paymentMethodsManage.accountNumberNotValid|Số tài khoản ngân hàng không hợp lệ.
paymentMethodsManage.accountType|Loại tài khoản
paymentMethodsManage.addNewAddress|Thêm địa chỉ
paymentMethodsManage.addNewBillingAddress|Thêm địa chỉ thanh toán
paymentMethodsManage.addPaymentMethod|Thêm phương thức thanh toán
paymentMethodsManage.bankAccount|Tài khoản ngân hàng
paymentMethodsManage.bankName|Tên ngân hàng
paymentMethodsManage.cardNumberNotValid|Số thẻ không hợp lệ.
paymentMethodsManage.checking|Tài khoản thanh toán
paymentMethodsManage.creditCard|Thẻ thanh toán
paymentMethodsManage.cvcNumberNotValid|Mã CVC không hợp lệ.
paymentMethodsManage.editPaymentMethod|Sửa phương thức thanh toán
paymentMethodsManage.expiryDateNotValid|Ngày hết hạn không hợp lệ.
paymentMethodsManage.invalidCardDetails|Thông tin thẻ không hợp lệ. Vui lòng thử lại.
paymentMethodsManage.optional|(Không bắt buộc)
paymentMethodsManage.routingNumberNotValid|Mã định tuyến ngân hàng không hợp lệ.
paymentMethodsManage.savings|Tài khoản tiết kiệm
paymentMethodsManage.sortCodeRoutingNumber|Mã ngân hàng / mã định tuyến
promoappliedbutnodiscount|Mã khuyến mãi đã được nhận nhưng chưa có sản phẩm đủ điều kiện giảm giá. Vui lòng kiểm tra điều kiện áp dụng.
quoteacceptagreetos|Vui lòng đồng ý với điều khoản dịch vụ để chấp nhận báo giá.
quoteacceptbtn|Chấp nhận báo giá
quoteacceptcontractwarning|Chấp nhận báo giá đồng nghĩa với việc giao kết hợp đồng và không thể hủy sau khi chấp nhận.
quotedatecreated|Ngày tạo
quotediscountheading|Giảm giá (%)
quotedownload|Tải xuống
quotelineitems|Chi tiết báo giá
quotelinetotal|Tổng cộng
quotenumber|Mã báo giá
quoteproposal|Nội dung đề xuất
quoterecipient|Người nhận
quotestage|Trạng thái
quotestageaccepted|Đã chấp nhận
quotestagedead|Đã hết hạn
quotestagedelivered|Đã gửi
quotestagelost|Đã hết hạn
quotestageonhold|Tạm giữ
quotesubject|Tiêu đề
quotevaliduntil|Có hiệu lực đến
quoteview|Xem
recurringpromodesc|Mã này bao gồm giảm %s cho các kỳ thanh toán tiếp theo.<br />(Áp dụng khi gia hạn trên tổng giá của dịch vụ)
serverstatusheadingtext|Tổng quan trạng thái máy chủ và các sự cố đang được ghi nhận.
serverstatusnoservers|Chưa có máy chủ được theo dõi.
serverstatusphpinfo|Thông tin PHP
serverstatusserverload|Tải máy chủ
serverstatustitle|Trạng thái máy chủ
serverstatusuptime|Thời gian hoạt động
sslState.expiryDate|Ngày hết hạn SSL
sslState.issuerName|Đơn vị cấp SSL
sslState.sslStatus|Trạng thái SSL
sslState.startDate|Ngày bắt đầu SSL
ssladmininfo|Thông tin liên hệ quản trị
ssladmininfodetails|Thông tin này dùng để liên hệ về đơn hàng và không hiển thị trên chứng chỉ. Chứng chỉ cùng thông báo gia hạn sẽ được gửi đến email bên dưới.
sslcertapproveremail|Email xác nhận chứng chỉ
sslcertapproveremaildetails|Chọn địa chỉ nhận email xác nhận cấp chứng chỉ.
sslconfigcomplete|Hoàn tất cấu hình
sslconfigcompletedetails|Thông tin cấu hình SSL đã gửi đến đơn vị cấp chứng chỉ để xác minh. Vui lòng kiểm tra email để phê duyệt.
sslinvalidlink|Liên kết không hợp lệ. Vui lòng quay lại và thử lại.
sslnoconfigurationpossible|Cấu hình đã hoàn tất. Vui lòng liên hệ hỗ trợ nếu gặp sự cố.
sslserverinfo|Thông tin máy chủ
sslserverinfodetails|Bạn cần mã CSR hợp lệ từ máy chủ sẽ cài SSL. Nếu chưa có, hãy tạo CSR hoặc yêu cầu đơn vị cung cấp hosting hỗ trợ.
sslservertype|Loại máy chủ web
twitterfollowus|Theo dõi chúng tôi
twitterfollowuswhy|để nhận tin tức và ưu đãi mới
twitterlatesttweets|Bài đăng mới nhất
ordererrordomainalreadyexists|Tên miền đã được đăng ký trong hệ thống. Vui lòng kiểm tra dịch vụ hiện có trước khi đặt lại.
ordererrordomaininvalid|Tên miền không hợp lệ.
ordererrordomainnotld|Vui lòng nhập đuôi tên miền.
ordererrordomainnotregistered|Không thể chuyển tên miền chưa được đăng ký.
ordererrordomainregistered|Tên miền đã được đăng ký.
ordererrornodomain|Vui lòng nhập tên miền.
ordererrorpassword|Vui lòng nhập mật khẩu.
ordererrorsubdomaintaken|Tên miền phụ đã được sử dụng. Vui lòng chọn tên khác.
ordererrortransfersecret|Vui lòng nhập mã xác thực chuyển tên miền.
ordererroruserexists|Đã có tài khoản sử dụng địa chỉ email này.
orderinvalidcodeforbillingcycle|Mã khuyến mãi không áp dụng cho chu kỳ thanh toán đã chọn.
orderpromoinvalid|Mã khuyến mãi không áp dụng cho các mục trong đơn hàng.
ordererrorsoccurred|Vui lòng kiểm tra các thông tin sau trước khi tiếp tục:
ordererrortermsofservice|Vui lòng đồng ý với điều khoản dịch vụ.
ordererrorsbudomainbanned|Tiền tố tên miền phụ không được phép sử dụng. Vui lòng chọn tên khác.
orderErrorServerHostnameInvalid|Tên máy chủ không hợp lệ.
orderErrorServerNameserversInvalid|Tiền tố máy chủ tên miền không hợp lệ.
customfieldvalidationerror|không đáp ứng định dạng yêu cầu.
customfieldinvalidurl|phải là địa chỉ URL hợp lệ.
customfieldinvalidoption|có lựa chọn không hợp lệ.
customfieldinvalidvalue|có giá trị không hợp lệ.
clientregisterverifyinvalid|Mã xác nhận hình ảnh không chính xác.
loginforgotten|Quên mật khẩu?
loginforgotteninstructions|Yêu cầu đặt lại mật khẩu
loginintrotext|Vui lòng đăng nhập để truy cập trang này. Tài khoản này khác với tài khoản bảng điều khiển hosting của bạn.
loginrequired|Yêu cầu đăng nhập
please|Vui lòng
pwresetsecurityquestionincorrect|Câu trả lời bảo mật không chính xác.
dlinvalidlink|Liên kết không hợp lệ. Vui lòng liên hệ hỗ trợ.
creditcardexpirydateinvalid|Ngày hết hạn phải theo định dạng MM/YY và chưa hết hạn.
unsubscribehashinvalid|Liên kết không hợp lệ. Vui lòng thử lại.
invalidchars|Vui lòng bỏ khoảng trắng hoặc ký tự đặc biệt không hợp lệ.
orderForm.domainInvalid|Tên miền không hợp lệ.
orderForm.domainInvalidCheckEntry|Vui lòng kiểm tra thông tin và thử lại.
support.invalidEmail|Địa chỉ email không hợp lệ.
tax.errorInvalid|Thông tin :taxLabel không hợp lệ.
validation.accepted|Vui lòng chấp nhận :attribute.
validation.active_url|:attribute phải là URL hợp lệ.
validation.after|:attribute phải là ngày sau :date.
validation.alpha|:attribute chỉ được chứa chữ.
validation.alpha_dash|:attribute chỉ được chứa chữ, số và dấu gạch ngang.
validation.alpha_num|:attribute chỉ được chứa chữ và số.
validation.array|:attribute phải là một danh sách.
validation.before|:attribute phải là ngày trước :date.
validation.between.numeric|:attribute phải nằm trong khoảng :min đến :max.
validation.between.file|:attribute phải có dung lượng từ :min đến :max kilobyte.
validation.between.string|:attribute phải có từ :min đến :max ký tự.
validation.between.array|:attribute phải có từ :min đến :max mục.
validation.boolean|:attribute phải là giá trị đúng hoặc sai.
validation.confirmed|Xác nhận :attribute không khớp.
validation.date|:attribute phải là ngày hợp lệ.
validation.date_format|:attribute phải theo định dạng :format.
validation.different|:attribute phải khác :other.
validation.digits|:attribute phải có :digits chữ số.
validation.digits_between|:attribute phải có từ :min đến :max chữ số.
validation.email|:attribute phải là địa chỉ email hợp lệ.
validation.exists|:attribute đã chọn không hợp lệ.
validation.filled|Vui lòng nhập :attribute.
validation.image|:attribute phải là tệp hình ảnh.
validation.in|:attribute đã chọn không hợp lệ.
validation.integer|:attribute phải là số nguyên.
validation.ip|:attribute phải là địa chỉ IP hợp lệ.
validation.json|:attribute phải là chuỗi JSON hợp lệ.
validation.max.numeric|:attribute không được lớn hơn :max.
validation.max.file|:attribute không được lớn hơn :max kilobyte.
validation.max.string|:attribute không được dài quá :max ký tự.
validation.max.array|:attribute không được có quá :max mục.
validation.mimes|:attribute phải là tệp có định dạng :values.
validation.min.numeric|:attribute phải lớn hơn hoặc bằng :min.
validation.min.file|:attribute phải có dung lượng tối thiểu :min kilobyte.
validation.min.string|:attribute phải có ít nhất :min ký tự.
validation.min.array|:attribute phải có ít nhất :min mục.
validation.not_in|:attribute đã chọn không hợp lệ.
validation.numeric|:attribute phải là số.
validation.present|Vui lòng cung cấp :attribute.
validation.regex|:attribute không đúng định dạng.
validation.required|Vui lòng nhập :attribute.
validation.required_if|Vui lòng nhập :attribute khi :other là :value.
validation.required_unless|Vui lòng nhập :attribute trừ khi :other thuộc :values.
validation.required_with|Vui lòng nhập :attribute khi có :values.
validation.required_with_all|Vui lòng nhập :attribute khi có đầy đủ :values.
validation.required_without|Vui lòng nhập :attribute khi thiếu :values.
validation.required_without_all|Vui lòng nhập :attribute khi thiếu toàn bộ :values.
validation.same|:attribute phải khớp với :other.
validation.size.numeric|:attribute phải bằng :size.
validation.size.file|:attribute phải có dung lượng :size kilobyte.
validation.size.string|:attribute phải có :size ký tự.
validation.size.array|:attribute phải có :size mục.
validation.string|:attribute phải là chuỗi ký tự.
validation.timezone|:attribute phải là múi giờ hợp lệ.
validation.unique|:attribute đã được sử dụng.
validation.url|:attribute phải là URL hợp lệ.
generatePassword.copyAndInsert|Sao chép và điền
generatePassword.generateNew|Tạo mật khẩu mới
generatePassword.generatedPw|Mật khẩu được tạo
generatePassword.lengthValidationError|Vui lòng nhập độ dài mật khẩu từ 8 đến 64.
generatePassword.pwLength|Độ dài mật khẩu
generatePassword.title|Tạo mật khẩu
emailAddressVerified|Cảm ơn bạn đã xác minh địa chỉ email.
emailKeyExpired|Liên kết xác minh email đã hết hạn. Vui lòng yêu cầu liên kết mới.
googleRecaptchaIncorrect|Vui lòng hoàn tất mã xác nhận và thử lại.
logoutandreturntoadminarea|Đăng xuất và trở về khu vực quản trị
noPasswordResetWhenLoggedIn|Vui lòng đăng xuất trước khi yêu cầu đặt lại mật khẩu.
pwdoesnotmatch|Mật khẩu nhập lại không khớp.
resendEmail|Gửi lại email xác minh
sso.redirectafterlogin|Bạn sẽ được chuyển trang sau khi đăng nhập.
tableloading|Đang tải...
tablepagesfirst|Đầu
tablepageslast|Cuối
tableprocessing|Đang xử lý...
verificationKeyExpired|Liên kết xác minh email đã hết hạn. Vui lòng đăng nhập để yêu cầu liên kết mới.
verifyEmailAddress|Vui lòng kiểm tra email và mở liên kết để xác minh địa chỉ email.
LANG;
foreach (explode("\n", $cloudytekVietnamese) as $cloudytekLine) {
    if (!$cloudytekLine) continue;
    list($cloudytekKey, $cloudytekValue) = explode('|', $cloudytekLine, 2);
    $cloudytekParts = explode('.', $cloudytekKey); $cloudytekTarget =& $_LANG;
    foreach ($cloudytekParts as $cloudytekPart) {
        if (!is_array($cloudytekTarget)) $cloudytekTarget = array();
        $cloudytekTarget =& $cloudytekTarget[$cloudytekPart];
    }
    $cloudytekTarget = $cloudytekValue; unset($cloudytekTarget);
}
unset($cloudytekVietnamese,$cloudytekLine,$cloudytekKey,$cloudytekValue,$cloudytekParts,$cloudytekPart);
$_LANG['portalCheckoutReview'] = 'Kiểm tra thông tin tài khoản và chọn phương thức thanh toán để hoàn tất đơn hàng.';
$_LANG['portalCheckoutNoGateway'] = 'Hiện chưa có phương thức thanh toán khả dụng.';
$_LANG['ordertotalduetoday'] = 'Thanh toán';
$_LANG['ctkDomain_name'] = 'Tên miền';
$_LANG['ctkDomain_title'] = 'Tên miền cho ý tưởng của bạn';
$_LANG['ctkDomain_intro'] = 'Tìm tên miền phù hợp và bắt đầu xây dựng thương hiệu của bạn.';
$_LANG['ctkDomain_explore'] = 'Tìm tên miền';
$_LANG['ctkDomain_mode'] = 'Dịch vụ tên miền';
$_LANG['ctkDomain_new'] = 'Đăng ký tên miền mới';
$_LANG['ctkDomain_transfer'] = 'Chuyển tên miền về';
$_LANG['ctkDomain_inputLabel'] = 'Tên miền hoặc từ khóa';
$_LANG['ctkDomain_placeholder'] = 'Nhập tên miền hoặc từ khóa, ví dụ thuonghieu.com';
$_LANG['ctkDomain_check'] = 'Kiểm tra';
$_LANG['ctkDomain_checking'] = 'Đang kiểm tra tên miền…';
$_LANG['ctkDomain_registered'] = 'Đã được đăng ký';
$_LANG['ctkDomain_unregistered'] = 'Chưa tìm thấy bản ghi đăng ký';
$_LANG['ctkDomain_available'] = 'Có thể đăng ký';
$_LANG['ctkDomain_reserved'] = 'Tên miền được giữ chỗ';
$_LANG['ctkDomain_unknown'] = 'Chưa kiểm tra được';
$_LANG['ctkDomain_contact'] = 'Liên hệ tư vấn';
$_LANG['ctkDomain_transferContact'] = 'Tư vấn chuyển tên miền';
$_LANG['ctkDomain_register'] = 'Đăng ký tên miền';
$_LANG['ctkDomain_pricePending'] = 'Liên hệ báo giá';
$_LANG['ctkDomain_year'] = '/năm';
$_LANG['ctkDomain_suggestions'] = 'Các tên miền phù hợp với bạn';
$_LANG['ctkDomain_more'] = 'Xem thêm';
$_LANG['ctkDomain_note'] = 'Kết quả phản ánh thời điểm tra cứu. Tên miền chưa có bản ghi đăng ký vẫn cần được nhà đăng ký xác nhận khả dụng trước khi đặt mua.';
$_LANG['ctkDomain_related'] = 'Dịch vụ đồng hành cùng tên miền';
$_LANG['ctkDomain_details'] = 'Xem chi tiết';
$_LANG['ctkDomain_invalid'] = 'Nhập tên miền hợp lệ, ví dụ thuonghieu.com; không nhập URL, khoảng trắng hoặc tên miền con.';
$_LANG['ctkDomain_failed'] = 'Chưa tra cứu được tên miền. Vui lòng thử lại sau ít phút.';
$_LANG['ctkDomain_rate'] = 'Bạn đã tra cứu nhiều lần. Vui lòng đợi một phút rồi thử lại.';
$_LANG['ctkDomain_session'] = 'Phiên làm việc đã hết hạn. Vui lòng tải lại trang và thử lại.';
