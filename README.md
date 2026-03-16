# 📊 Hệ Thống Quản Lý Nhân Sự (HRM)
**Giải pháp quản lý nhân sự tổng thể cho doanh nghiệp**

---

## 🚀 Truy Cập Nhanh Hệ Thống

| Kênh | Thông Tin |
|------|-----------|
| 🌐 **Live Demo** | [hrm.duyhung.io.vn](https://hrm.duyhung.io.vn) |
| 👤 **Tài Khoản Demo** | `duyhung456@gmail.com` |
| 🔑 **Mật Khẩu** | `admin456` |

> **Lưu ý:** Tài khoản demo có quyền quản trị viên. Hãy nhấp vào trang web để xem tất cả các tính năng.

---

## 💡 Giới Thiệu Dự Án

Đây là một **hệ thống quản lý nhân sự toàn diện** được xây dựng trên nền tảng **Laravel**, giúp doanh nghiệp:

- ✅ **Quản lý tất cả dữ liệu nhân viên** - Lưu trữ thông tin cá nhân, phòng ban, chức vụ trong một hệ thống tập trung
- ✅ **Tính lương tự động** - Hệ thống tính toán lương cơ bản, phụ cấp, thưởng, phạt một cách độc lập
- ✅ **Theo dõi chấm công** - Ghi nhận giờ vào/ra hàng ngày, tạo báo cáo chấm công chi tiết
- ✅ **Quản lý đơn xin nghỉ** - Tiếp nhận, duyệt/từ chối đơn xin nghỉ từ nhân viên
- ✅ **Quản lý hợp đồng** - Lưu trữ, theo dõi thời hạn, gia hạn hợp đồng nhân viên
- ✅ **Ghi nhận khen thưởng/kỷ luật** - Lưu lại các hành động khen thưởng và kỷ luật của nhân viên
- ✅ **Xuất báo cáo** - Tạo báo cáo Excel/PDF theo phòng ban, tháng/năm, nhân viên

---

## 📋 Các Tính Năng Chính

### 1️⃣ **Quản Lý Nhân Sự**
- Thêm/sửa/xóa thông tin nhân viên
- Xem lịch sử nhân viên theo phòng ban
- Quản lý danh sách phòng ban

### 2️⃣ **Chấm Công**
- Ghi nhận giờ vào/ra hàng ngày
- Báo cáo chấm công chi tiết theo tháng
- Tích hợp với tính lương tự động

### 3️⃣ **Lương & Thanh Toán**
- Nhập lương cơ bản, phụ cấp, thưởng, phạt
- **Tính lương tự động từ chấm công**
- Xuất bảng lương chi tiết
- Lịch sử lương theo tháng/năm

### 4️⃣ **Quản Lý Đơn Xin Nghỉ**
- Nhân viên nộp đơn xin nghỉ
- Admin duyệt/từ chối
- Báo cáo ngày nghỉ phép

### 5️⃣ **Hợp Đồng Lao Động**
- Lưu thông tin hợp đồng
- Theo dõi ngày hết hạn
- Gia hạn hợp đồng

### 6️⃣ **Khen Thưởng & Kỷ Luật**
- Ghi nhận các hành động khen thưởng
- Ghi nhận các hành động kỷ luật
- Liên kết với lương (thưởng/phạt)

### 7️⃣ **Báo Cáo & Xuất Dữ Liệu**
- **Báo cáo nhân viên theo phòng ban** (Excel/PDF)
- **Báo cáo chấm công** - Lọc theo tháng, năm, nhân viên
- **Báo cáo nghỉ phép** - Xem thống kê ngày nghỉ
- **Báo cáo lương** - Xuất bảng lương theo tháng/phòng ban

---

## 🎯 Lợi Ích Cho Phòng HR

| Lợi Ích | Giải Thích |
|---------|-----------|
| ⏱️ **Tiết Kiệm Thời Gian** | Tự động tính lương, không cần tính toán thủ công |
| 📑 **Dữ Liệu Tập Trung** | Tất cả thông tin nhân viên ở một nơi, dễ tìm kiếm |
| 📊 **Báo Cáo Chính Xác** | Xuất báo cáo Excel/PDF chuyên nghiệp |
| 👤 **Quản Lý Dễ Dàng** | Giao diện thân thiện, dễ sử dụng |
| 🔐 **An Toàn Dữ Liệu** | Lưu trữ an toàn trên cloud, sao lưu định kỳ |
| 📱 **Truy Cập Mọi Lúc Mọi Nơi** | Hệ thống web, truy cập từ máy tính, điện thoại |

---

## 🏗️ Kiến Trúc Hệ Thống

```
Backend: Laravel 12 + MySQL
Frontend: Blade Templates (PHP)
Deployment: Docker + Nginx
Reporting: Excel (XLSX) + PDF
```

---

## 👥 Quyền Người Dùng

### 🔴 **Quản Trị Viên (Admin)**
- Toàn quyền quản lý và cấu hình hệ thống
- Quản lý tất cả nhân viên, phòng ban
- Phê duyệt đơn xin nghỉ
- Tính lương, quản lý hợp đồng
- Xuất báo cáo
- Quản lý tài khoản người dùng

### 🔵 **Nhân Viên (Employee)**
- Xem thông tin cá nhân
- Nộp đơn xin nghỉ
- Xem lịch sử chấm công
- Xem bảng lương cá nhân

---

## 🗄️ Cơ Sở Dữ Liệu

### Các Bảng Chính
- **employees** - Thông tin nhân viên
- **departments** - Danh sách phòng ban
- **attendance** - Chấm công
- **leaves** - Đơn xin nghỉ
- **salaries** - Lương nhân viên
- **contracts** - Hợp đồng lao động
- **rewards_discipline** - Khen thưởng và kỷ luật

### Mối Quan Hệ
```
employees (nhiều) ← → (một) departments
employees (nhiều) ← → (nhiều) attendance
employees (nhiều) ← → (nhiều) leaves
employees (nhiều) ← → (nhiều) salaries
employees (nhiều) ← → (nhiều) contracts
employees (nhiều) ← → (nhiều) rewards_discipline
```

---

## 📁 Cấu Trúc Thư Mục

```
app/
├── Models/                    # Eloquent Models
│   ├── Employee, Department, Attendance, Leaves, etc.
├── Http/
│   ├── Controllers/          # Xử lý logic routes
│   └── Middleware/           # Kiểm tra quyền
├── Exports/
│   └── ReportExport.php      # Export Excel/PDF

database/
├── migrations/              # Tạo bảng cơ sở dữ liệu
└── seeders/                 # Dữ liệu mẫu

routes/
├── web.php                  # Routes ứng dụng

resources/
└── views/                   # Giao diện HTML (Blade)
```

---

## 🔧 Hướng Dẫn Nhanh

### Khởi Động Hệ Thống (Local)

```bash
# 1. Clone dự án
git clone <repo-url>
cd DAPHP_QuanLyNhanSu

# 2. Cài đặt dependencies
composer install
npm install

# 3. Tạo file .env
cp .env.example .env
php artisan key:generate

# 4. Chạy migration
php artisan migrate

# 5. Khởi động server
php artisan serve
# Truy cập: http://localhost:8000
```

### Sử Dụng Docker

```bash
# Chạy docker-compose
docker-compose up -d

# Chạy migration
docker-compose exec app php artisan migrate

# Truy cập: http://localhost
```

---

## 📞 Liên Hệ & Hỗ Trợ

| Câu Hỏi | Cách Giải Quyết |
|--------|-----------------|
| Quên mật khẩu? | Liên hệ với quản trị viên để đặt lại |
| Báo lỗi? | Thông báo chi tiết cho dev team |
| Muốn thêm tính năng? | Liên hệ với product team |

---

## 📝 Thông Tin Phiên Bản

- **Framework:** Laravel 12
- **Ngôn Ngữ:** PHP 8.2+
- **Database:** MySQL 8.0+
- **Trạng Thái:** ✅ Sản Xuất (Production Ready)

---

**Đăng Ký Demo Tài Khoản của Bạn Tại:** [hrm.duyhung.io.vn](https://hrm.duyhung.io.vn)

*Phát triển bởi: IT Team - Quản Lý Nhân Sự Số 1*
