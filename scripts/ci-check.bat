@echo off
REM Simple CI check script for Windows
REM Runs the same checks as GitHub Actions locally

echo 🚀 Starting Local CI Checks...

REM Check if we're in Laravel project root
if not exist "artisan" (
    echo ❌ Error: artisan file not found. Make sure you're in Laravel project root.
    exit /b 1
)

echo 📦 Installing Composer dependencies...
composer install --prefer-dist --no-progress
if %errorlevel% neq 0 exit /b %errorlevel%

echo 📦 Installing NPM dependencies...
npm ci
if %errorlevel% neq 0 exit /b %errorlevel%

echo 🔧 Setting up environment...
if not exist ".env" (
    copy .env.example .env
    php artisan key:generate
)

echo 🏗️ Building assets...
npm run build
if %errorlevel% neq 0 exit /b %errorlevel%

echo 🧹 Checking code formatting...
vendor\bin\pint --test
if %errorlevel% neq 0 exit /b %errorlevel%

echo 🔒 Running security audit...
composer audit
if %errorlevel% neq 0 exit /b %errorlevel%

echo 🧪 Running tests...
if not exist "database" mkdir database
if not exist "database\database.sqlite" type nul > database\database.sqlite
set DB_CONNECTION=sqlite
set DB_DATABASE=database/database.sqlite
php artisan migrate --force
vendor\bin\phpunit --coverage-text
if %errorlevel% neq 0 exit /b %errorlevel%

echo ✅ All checks passed! Ready to push to repository.
