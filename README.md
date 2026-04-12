# 🎮 Website Kinh Doanh Trò Chơi Trực Tuyến - MIXIGaming Shop

---

## 👥 Thành viên nhóm

| STT | Họ và tên             | MSSV        | Vai trò dự kiến              |
| :-- | :-------------------- | :---------- | :--------------------------- |
| 1   | **Nguyễn Trung Hiếu** | 23810310387 | Nhóm trưởng (Lead/Backend)   |
| 2   | Nguyễn Trọng Phúc     | 23810310391 | Thành viên (Fullstack/Admin) |
| 3   | Nguyễn Hữu Thành      | 23810310389 | Thành viên (Frontend/UI-UX)  |

---

## 🚀 Công nghệ sử dụng

| Thành phần         | Công nghệ chi tiết                                         |
| :----------------- | :--------------------------------------------------------- |
| **Backend**        | **Laravel 11.x**                                           |
| **Authentication** | **Laravel Breeze** (Xác thực người dùng & Khách hàng)      |
| **Admin Panel**    | **Filament v3** (Hệ thống quản trị CRUD chuyên nghiệp)     |
| **Authorization**  | **Spatie Laravel Permission** (Phân quyền Role/Permission) |
| **Frontend**       | Blade Engine, Tailwind CSS, JavaScript                     |
| **Database**       | MySQL                                                      |
| **Payment**        | **VNPay API** (Cổng thanh toán điện tử chính)              |

---

## 📋 Tài liệu Đặc tả Yêu cầu Phần mềm (SRS)

Tất cả tài liệu SRS được lưu trong tập tin `SRS.md`.

| Mã | Tên Chức Năng | Tài Liệu | Trạng Thái |
| :--- | :--- | :--- | :--- |
| AUTH-01 | Xác thực & Phân quyền | SRS.md | Đang thực hiện |
| AUTH-02 | Đăng ký tài khoản | SRS.md | Đang thực hiện |
| GAME-01 | Xem danh sách game | SRS.md | Đang thực hiện |
| GAME-02 | Tìm kiếm game | SRS.md | Đang thực hiện |
| CART-01 | Quản lý giỏ hàng | SRS.md | Đang thực hiện |
| ORDER-01 | Đặt hàng & Thanh toán | SRS.md | Đang thực hiện |
| USER-01 | Quản lý tài khoản cá nhân | SRS.md | Đang thực hiện |
| ADMIN-01 | Quản trị người dùng | SRS.md | Đang thực hiện |
| ADMIN-02 | Quản trị hệ thống Game | SRS.md | Đang thực hiện |
| ADMIN-03 | Thống kê & Báo cáo | SRS.md | Đang thực hiện |

---

## 🗓️ Kế hoạch thực hiện (4 Tuần)

| Tuần  | Mục tiêu chính            | **Hiếu (Lead/Backend)**                                                | **Phúc (Admin/Fullstack)**                                             | **Thành (Frontend/UI-UX)**                                            |
| :---- | :------------------------ | :--------------------------------------------------------------------- | :--------------------------------------------------------------------- | :-------------------------------------------------------------------- |
| **1** | **Khởi tạo & Database**   | Khởi tạo Project, thiết kế ERD, tạo Migrations & thiết lập GitHub.     | Cài đặt Filament PHP, Spatie Permissions. Tạo Role & Seed dữ liệu mẫu. | Thiết kế Mockup, xây dựng Layout chính (Header/Footer/Navbar).        |
| **2** | **Admin & Hiển thị**      | Xử lý logic Giỏ hàng, xây dựng chức năng Tìm kiếm & Lọc sản phẩm.      | Xây dựng Filament Resources (Game, Category). Quản lý kho Key game.    | Code giao diện Trang chủ, Trang danh sách game & Chi tiết game.       |
| **3** | **Thanh toán & Đơn hàng** | Tích hợp **VNPay API**. Xử lý logic trừ kho Key và gửi Email xác nhận. | Tạo OrderResource quản lý đơn hàng. Thiết lập Dashboard Widgets.       | Làm giao diện Giỏ hàng, Checkout & Trang lịch sử mua hàng cá nhân.    |
| **4** | **Tối ưu & Hoàn thiện**   | Xử lý Login Social, tối ưu bảo mật SQL Injection & hiệu năng DB.       | Kiểm tra phân quyền Spatie. Xử lý logic hoàn tiền/khóa tài khoản.      | Tối ưu Responsive (Mobile). Làm trang Tin tức/Review (Filament Blog). |

---

## 🗂️ Cấu trúc thư mục dự án

```text
game-store/
├── app/
│   ├── Filament/           # Cấu hình Admin Panel (Resources, Pages, Widgets)
│   ├── Models/             # Eloquent Models (User, Game, Order, Category, Key)
│   └── Http/Controllers/   # Logic phía Client side
├── config/                 # Cấu hình VNPay, Permission, Filament
├── database/
│   ├── migrations/         # Cấu trúc bảng (Schema database)
│   └── seeders/            # Dữ liệu mẫu (Tài khoản admin, game mẫu)
├── public/                 # Tài nguyên công khai (CSS, JS, Images)
├── resources/
│   └── views/              # Giao diện Blade templates (Tailwind CSS)
├── routes/
│   ├── web.php             # Route cho khách hàng mua game
│   └── admin.php           # Route tùy chỉnh cho quản trị
├── .env.example            # File mẫu cấu hình môi trường
└── README.md
```

---

## ⚙️ Hướng dẫn cài đặt

```bash
# 1. Clone repository
git clone https://github.com/TrungHieu163/LTWNC_Selling-Game-Website.git
cd LTWNC_Selling-Game-Website

# 2. Cài đặt các thư viện PHP và JS
composer install
npm install && npm run dev

# 3. Cấu hình môi trường
cp .env.example .env
# Lưu ý: Cập nhật DB_DATABASE và thông tin VNPay (TmnCode, HashSecret) trong .env
php artisan key:generate

# 4. Chạy Migration và tạo dữ liệu mẫu
php artisan migrate --seed

# 5. Khởi chạy server
php artisan serve
```

- **Giao diện người dùng:** `http://localhost:8000`
- **Trang quản trị (Admin):** `http://localhost:8000/admin`

---

## 📝 Ghi chú

- **Bảo mật:** Hệ thống sử dụng Middleware của Spatie để chặn các truy cập trái phép vào vùng Admin.
- **Quản lý:** Mọi thay đổi về Database hoặc Logic nghiệp vụ cần cập nhật lại tài liệu SRS tương ứng trong tập tin `SRS.md`.
- **Hỗ trợ:** Liên hệ nhóm trưởng **Nguyễn Trung Hiếu** nếu gặp vấn đề khi cài đặt hoặc xung đột code.

---
