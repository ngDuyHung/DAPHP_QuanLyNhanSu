# Script khởi động Docker cho dự án Quản Lý Nhân Sự
# Dùng cho Windows PowerShell

Write-Host "🐳 Đang khởi động Docker cho Quản Lý Nhân Sự..." -ForegroundColor Cyan

# Check if Docker is running
$dockerInfo = docker info 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Docker chưa được khởi động. Vui lòng khởi động Docker Desktop." -ForegroundColor Red
    exit 1
}

# Copy .env if not exists
if (-not (Test-Path ".env")) {
    Write-Host "📋 Tạo file .env từ .env.docker..." -ForegroundColor Yellow
    Copy-Item ".env.docker" ".env"
}

# Build and start containers
Write-Host "🔨 Build và khởi động containers..." -ForegroundColor Yellow
docker-compose up -d --build

# Wait for MySQL to be ready
Write-Host "⏳ Đợi MySQL khởi động..." -ForegroundColor Yellow
Start-Sleep -Seconds 15

# Install dependencies
Write-Host "📦 Cài đặt Composer dependencies..." -ForegroundColor Yellow
docker-compose exec -T app composer install --no-interaction

# Generate key if needed
Write-Host "🔑 Kiểm tra Application Key..." -ForegroundColor Yellow
docker-compose exec -T app php artisan key:generate --force

# Run migrations
Write-Host "🗃️ Chạy database migrations..." -ForegroundColor Yellow
docker-compose exec -T app php artisan migrate --force

# Cache config
Write-Host "⚡ Optimize Laravel..." -ForegroundColor Yellow
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

# Install npm and build
Write-Host "🎨 Cài đặt và build frontend..." -ForegroundColor Yellow
docker-compose exec -T app npm install
docker-compose exec -T app npm run build

Write-Host ""
Write-Host "✅ Hoàn tất! Ứng dụng đang chạy tại:" -ForegroundColor Green
Write-Host "   🌐 Website: http://localhost:8000" -ForegroundColor White
Write-Host "   🗄️ phpMyAdmin: http://localhost:8080" -ForegroundColor White
Write-Host ""
Write-Host "📝 Các lệnh hữu ích:" -ForegroundColor Cyan
Write-Host "   docker-compose ps          - Xem trạng thái" -ForegroundColor White
Write-Host "   docker-compose logs -f     - Xem logs" -ForegroundColor White
Write-Host "   docker-compose stop        - Dừng containers" -ForegroundColor White
Write-Host "   docker-compose down        - Xóa containers" -ForegroundColor White
