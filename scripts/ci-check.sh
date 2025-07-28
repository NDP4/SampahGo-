#!/bin/bash

# Simple CI check script
# Runs the same checks as GitHub Actions locally

set -e

echo "🚀 Starting Local CI Checks..."

# Check if we're in Laravel project root
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Make sure you're in Laravel project root."
    exit 1
fi

echo "📦 Installing Composer dependencies..."
composer install --prefer-dist --no-progress

echo "📦 Installing NPM dependencies..."
npm ci

echo "🔧 Setting up environment..."
if [ ! -f ".env" ]; then
    cp .env.example .env
    php artisan key:generate
fi

echo "🏗️ Building assets..."
npm run build

echo "🧹 Checking code formatting..."
vendor/bin/pint --test

echo "🔒 Running security audit..."
composer audit

echo "🧪 Running tests..."
mkdir -p database
touch database/database.sqlite
DB_CONNECTION=sqlite DB_DATABASE=database/database.sqlite php artisan migrate --force
vendor/bin/phpunit --coverage-text

echo "✅ All checks passed! Ready to push to repository."
