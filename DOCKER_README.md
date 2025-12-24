# 🐳 Hướng Dẫn Sử Dụng Docker - Quản Lý Nhân Sự

## Giới thiệu

Docker giúp chuẩn hóa môi trường phát triển, đảm bảo dự án chạy giống nhau trên mọi máy tính.

## Yêu cầu

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (Windows/Mac)
- Hoặc Docker Engine + Docker Compose (Linux)

## Cấu trúc Docker

```
├── Dockerfile              # Build PHP image
├── docker-compose.yml      # Orchestrate services
├── .env.docker             # Environment cho Docker
└── docker/
    ├── nginx/
    │   └── default.conf    # Nginx configuration
    ├── php/
    │   └── local.ini       # PHP configuration
    └── mysql/
        └── my.cnf          # MySQL configuration
```

## Services

| Service     | Container Name   | Port (Host:Container) | Mô tả                    |
|-------------|------------------|----------------------|--------------------------|
| app         | qlns-app         | 9000                 | PHP-FPM Application      |
| nginx       | qlns-nginx       | 8000:80              | Web Server               |
| mysql       | qlns-mysql       | 3307:3306            | MySQL Database           |
| redis       | qlns-redis       | 6380:6379            | Cache & Session          |
| phpmyadmin  | qlns-phpmyadmin  | 8080:80              | Database Management UI   |
| node        | qlns-node        | 5173:5173            | Vite Dev Server (dev)    |

## 🚀 Khởi động nhanh

### Bước 1: Copy file environment

```bash
# Windows PowerShell
Copy-Item .env.docker .env

# Linux/Mac
cp .env.docker .env
```

### Bước 2: Build và khởi động containers

```bash
# Build images và start containers
docker-compose up -d --build

# Hoặc chỉ start (nếu đã build)
docker-compose up -d
```

### Bước 3: Cài đặt dependencies và setup Laravel

```bash
# Cài đặt Composer packages
docker-compose exec app composer install

# Generate application key (nếu chưa có)
docker-compose exec app php artisan key:generate

# Chạy migrations
docker-compose exec app php artisan migrate

# Chạy seeders (nếu có)
docker-compose exec app php artisan db:seed

# Clear và cache config
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

### Bước 4: Cài đặt Frontend (Vite) - nếu fe chỉ dùng boostrap thì không cần 

```bash
# Cài đặt NPM packages
docker-compose exec app npm install

# Build assets cho production
docker-compose exec app npm run build

# HOẶC: Chạy Vite dev server (với hot reload)
docker-compose --profile dev up node -d
```

## 🌐 Truy cập ứng dụng

- **Website**: http://localhost:8000
- **phpMyAdmin**: http://localhost:8080
- **Vite Dev**: http://localhost:5173 (khi chạy với profile dev)

## 📝 Các lệnh thường dùng

### Quản lý Containers

```bash
# Xem trạng thái containers
docker-compose ps

# Dừng containers
docker-compose stop

# Khởi động lại containers
docker-compose restart

# Dừng và xóa containers
docker-compose down

# Xóa hoàn toàn (bao gồm volumes)
docker-compose down -v
```

### Làm việc với Laravel

```bash
# Chạy Artisan commands
docker-compose exec app php artisan <command>

# Ví dụ: Tạo controller
docker-compose exec app php artisan make:controller UserController

# Ví dụ: Tạo model
docker-compose exec app php artisan make:model Product -m

# Ví dụ: Chạy tinker
docker-compose exec app php artisan tinker

# Ví dụ: Clear all caches
docker-compose exec app php artisan optimize:clear
```

### Database

```bash
# Chạy migrations
docker-compose exec app php artisan migrate

# Rollback migrations
docker-compose exec app php artisan migrate:rollback

# Fresh migrate (xóa hết và tạo lại)
docker-compose exec app php artisan migrate:fresh --seed

# Kết nối MySQL CLI
docker-compose exec mysql mysql -u root -p
```

### Logs

```bash
# Xem logs của tất cả containers
docker-compose logs

# Xem logs của container cụ thể
docker-compose logs app
docker-compose logs nginx

# Xem logs realtime
docker-compose logs -f app
```

### Terminal trong Container

```bash
# Vào shell của container app
docker-compose exec app bash

# Vào shell của container mysql
docker-compose exec mysql bash
```

## ⚙️ Cấu hình

### Thay đổi Port

Chỉnh sửa trong `docker-compose.yml`:

```yaml
nginx:
  ports:
    - "8080:80"  # Đổi 8000 thành 8080
```

### Thay đổi PHP Version

Chỉnh sửa `Dockerfile`:

```dockerfile
FROM php:8.3-fpm  # Đổi từ 8.2 sang 8.3
```

### Thay đổi MySQL Version

Chỉnh sửa trong `docker-compose.yml`:

```yaml
mysql:
  image: mysql:8.1  # Đổi version
```

## 🔧 Xử lý sự cố

### Container không khởi động được

```bash
# Xem logs chi tiết
docker-compose logs --tail=50 app

# Rebuild container
docker-compose up -d --build --force-recreate app
```

### Permission denied (Linux/Mac)

```bash
# Fix permissions cho storage và cache
docker-compose exec app chmod -R 775 storage bootstrap/cache
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
```

### Database connection refused

1. Đảm bảo container mysql đang chạy: `docker-compose ps`
2. Kiểm tra `.env` có `DB_HOST=mysql` (không phải `127.0.0.1`)
3. Đợi MySQL khởi động hoàn tất (có thể mất 30-60s lần đầu)

### Port đã được sử dụng

```bash
# Windows: Tìm process đang dùng port
netstat -ano | findstr :8000

# Đổi port trong docker-compose.yml hoặc dừng process đang dùng port
```

### Xóa cache Docker

```bash
# Xóa images không dùng
docker image prune -a

# Xóa volumes không dùng
docker volume prune

# Xóa tất cả cache
docker system prune -a --volumes
```

## 🔄 Workflow phát triển

1. **Khởi động môi trường**: `docker-compose up -d`
2. **Code trên máy local** - thay đổi được sync tự động vào container
3. **Chạy commands** qua `docker-compose exec app <command>`
4. **Xem ứng dụng** tại http://localhost:8000
5. **Dừng khi xong**: `docker-compose stop`

## 📦 Deploy Production

Với production, cần điều chỉnh:

1. Đổi `APP_ENV=production` và `APP_DEBUG=false` trong `.env`
2. Sử dụng SSL/TLS certificate
3. Tắt phpMyAdmin service
4. Optimize Laravel: `php artisan config:cache && php artisan route:cache`
5. Build assets: `npm run build`

---

## Liên hệ hỗ trợ

Nếu gặp vấn đề, vui lòng tạo issue hoặc liên hệ team phát triển.
