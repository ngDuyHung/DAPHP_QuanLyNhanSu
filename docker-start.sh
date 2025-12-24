#!/bin/bash
# Script khởi động Docker cho dự án Quản Lý Nhân Sự
# Dùng cho Linux/Mac

set -e

echo "🐳 Đang khởi động Docker cho Quản Lý Nhân Sự..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker chưa được khởi động. Vui lòng khởi động Docker Desktop."
    exit 1
fi

# Copy .env if not exists
if [ ! -f .env ]; then
    echo "📋 Tạo file .env từ .env.docker..."
    cp .env.docker .env
fi

# Build and start containers
echo "🔨 Build và khởi động containers..."
docker-compose up -d --build

# Wait for MySQL to be ready
echo "⏳ Đợi MySQL khởi động..."
sleep 10

# Install dependencies
echo "📦 Cài đặt Composer dependencies..."
docker-compose exec -T app composer install --no-interaction

# Generate key if needed
echo "🔑 Kiểm tra Application Key..."
docker-compose exec -T app php artisan key:generate --force

# Run migrations
echo "🗃️ Chạy database migrations..."
docker-compose exec -T app php artisan migrate --force

# Cache config
echo "⚡ Optimize Laravel..."
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

# Install npm and build
echo "🎨 Cài đặt và build frontend..."
docker-compose exec -T app npm install
docker-compose exec -T app npm run build

echo ""
echo "✅ Hoàn tất! Ứng dụng đang chạy tại:"
echo "   🌐 Website: http://localhost:8000"
echo "   🗄️ phpMyAdmin: http://localhost:8080"
echo ""
echo "📝 Các lệnh hữu ích:"
echo "   docker-compose ps          - Xem trạng thái"
echo "   docker-compose logs -f     - Xem logs"
echo "   docker-compose stop        - Dừng containers"
echo "   docker-compose down        - Xóa containers"
