# SOFTWARE REQUIREMENTS SPECIFICATION (SRS)
## Website Bán Game

---

# AUTH-01: Đăng nhập hệ thống (Login)

**Mã chức năng:** AUTH-01  
**Trạng thái:** Draft  
**Người soạn:** Nguyễn Trọng Phúc, Nguyễn Hữu Thành, Nguyễn Trung Hiếu

---

## 1. Mô tả tổng quan
Chức năng cho phép người dùng đăng nhập vào hệ thống bằng email và mật khẩu.  
Đảm bảo xác thực an toàn và phân quyền người dùng.

---

## 2. Luồng nghiệp vụ

| Bước | Hành động người dùng | Phản hồi hệ thống |
|------|---------------------|------------------|
| 1 | Truy cập `/login` | Hiển thị form đăng nhập |
| 2 | Nhập email + password | Validate dữ liệu |
| 3 | Nhấn Login | Kiểm tra DB |
| 4 | Đúng | Chuyển vào trang chính |
| 5 | Sai | Hiển thị lỗi |

---

## 3. Yêu cầu dữ liệu

### 3.1 Input
- Email: string, bắt buộc  
- Password: string, ≥ 8 ký tự  

### 3.2 Database
- email (unique)  
- password (hashed)  
- last_login  

---

## 4. Ràng buộc & bảo mật
- HTTPS  
- CSRF Token  
- Hash password (bcrypt)  
- Giới hạn đăng nhập sai  

---

## 5. Xử lý lỗi
- Sai email → báo lỗi  
- Sai mật khẩu → báo lỗi  
- Tài khoản bị khóa → thông báo  

---

## 6. Giao diện
- Form đơn giản  
- Responsive  
- Nhấn Enter để login  

---

# AUTH-02: Đăng ký

**Mã chức năng:** AUTH-02  

---

## 1. Mô tả
Cho phép người dùng tạo tài khoản mới.

---

## 2. Luồng nghiệp vụ

| Bước | Người dùng | Hệ thống |
|------|----------|----------|
| 1 | Truy cập `/register` | Hiển thị form |
| 2 | Nhập thông tin | Validate |
| 3 | Submit | Lưu DB |
| 4 | Thành công | Chuyển sang login |

---

## 3. Dữ liệu
- Email  
- Password  
- Confirm password  

---

## 4. Bảo mật
- Hash password  
- Validate email unique  

---

## 5. Xử lý lỗi
- Email trùng  
- Password không khớp  

---

# GAME-01: Xem danh sách game

---

## 1. Mô tả
Hiển thị toàn bộ game trong hệ thống.

---

## 2. Luồng

| Bước | Người dùng | Hệ thống |
|------|-----------|----------|
| 1 | Truy cập trang chủ | Load danh sách game |
| 2 | Cuộn trang | Phân trang |

---

## 3. Dữ liệu
- name  
- price  
- image  

---

## 4. Xử lý lỗi
- Không có dữ liệu → hiển thị thông báo  

---

# GAME-02: Tìm kiếm game

---

## 1. Mô tả
Cho phép người dùng tìm kiếm game theo tên.

---

## 2. Luồng

| Bước | Người dùng | Hệ thống |
|------|-----------|----------|
| 1 | Nhập keyword | Thực hiện tìm kiếm |
| 2 | Nhấn Enter | Hiển thị kết quả |

---

## 3. Input
- keyword  

---

## 4. Xử lý lỗi
- Không tìm thấy → hiển thị danh sách rỗng  

---

# CART-01: Giỏ hàng

---

## 1. Mô tả
Quản lý danh sách game mà người dùng muốn mua.

---

## 2. Luồng

| Bước | Người dùng | Hệ thống |
|------|-----------|----------|
| 1 | Thêm game vào giỏ | Lưu vào cart |
| 2 | Xem giỏ hàng | Hiển thị danh sách |
| 3 | Xóa game | Cập nhật lại giỏ |

---

## 3. Dữ liệu
- user_id  
- game_id  

---

# ORDER-01: Thanh toán

---

## 1. Mô tả
Thực hiện quá trình mua game từ giỏ hàng.

---

## 2. Luồng

| Bước | Người dùng | Hệ thống |
|------|-----------|----------|
| 1 | Nhấn checkout | Hiển thị form |
| 2 | Xác nhận | Tạo đơn hàng |
| 3 | Thành công | Lưu vào database |

---

## 3. Dữ liệu
- order_id  
- user_id  
- total_price  

---

## 4. Xử lý lỗi
- Giỏ hàng rỗng  

---

# USER-01: Quản lý tài khoản

---

## 1. Mô tả
Cho phép người dùng xem và cập nhật thông tin cá nhân.

---

## 2. Luồng
- Xem thông tin  
- Chỉnh sửa  
- Lưu thay đổi  

---

# ADMIN-01: Quản lý user

---

## 1. Mô tả
Admin quản lý tài khoản người dùng.

---

## 2. Chức năng
- Xem danh sách user  
- Xóa user  
- Khóa tài khoản  

---

# ADMIN-02: Quản lý game

---

## 1. Mô tả
Admin quản lý thông tin game.

---

## 2. Chức năng
- Thêm game  
- Sửa game  
- Xóa game  

---

# ADMIN-03: Thống kê

---

## 1. Mô tả
Hiển thị thông tin thống kê hệ thống.

---

## 2. Nội dung
- Doanh thu  
- Số lượng đơn hàng  
