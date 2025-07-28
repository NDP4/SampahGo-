# SampahGo! - Waste Management System

## Overview
SampahGo! adalah sistem manajemen sampah dengan role-based authentication yang dibangun menggunakan Laravel 12, Jetstream, Livewire, dan Daisy UI.

## Features
- **Role-based Authentication**: SuperAdmin, RW, RT, FO, Warga
- **Custom Authentication**: Menggunakan kolom `nama` dan `kata_sandi`
- **Modern UI**: Tailwind CSS + Daisy UI dengan dark mode support
- **Wire Navigation**: SPA-like navigation dengan Livewire 3
- **Responsive Design**: Mobile-first design dengan drawer navigation

## Tech Stack
- **Backend**: Laravel 12, PHP 8.2
- **Frontend**: Livewire 3, Tailwind CSS, Daisy UI
- **Database**: MySQL 8.0
- **Authentication**: Laravel Jetstream + Fortify
- **CI/CD**: GitHub Actions

## Installation

### Prerequisites
- PHP 8.2+
- Node.js 18+
- MySQL 8.0+
- Composer

### Setup Steps
1. Clone repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Configure environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Setup database and run migrations:
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class=TestDataSeeder
   ```

5. Build assets:
   ```bash
   npm run build
   ```

6. Run server:
   ```bash
   php artisan serve
   ```

## Test Accounts
- **SuperAdmin**: 
  - Username: `Super Admin`
  - Password: `password`

- **RW Admin**:
  - Username: `Admin RW 01`
  - Password: `password`

- **RT Admin**:
  - Username: `Admin RT 01`
  - Password: `password`

- **Field Officer**:
  - Username: `Field Officer`
  - Password: `password`

- **Warga**:
  - Username: `Warga Test`
  - Password: `password`

## Database Schema

### Main Tables
- **rws**: Data RW (Rukun Warga)
- **rts**: Data RT (Rukun Tetangga)
- **users**: Data user dengan role-based access
- **kategoris**: Kategori sampah
- **transaksis**: Transaksi sampah
- **item_transaksis**: Detail item transaksi
- **persetujuans**: Data persetujuan transaksi
- **pendapatans**: Data pendapatan

### User Roles
1. **SuperAdmin**: Full system access
2. **RW**: Manajemen RT, persetujuan transaksi, laporan pendapatan
3. **RT**: Input transaksi, manajemen warga
4. **FO**: Approval transaksi
5. **Warga**: Riwayat transaksi

## UI Themes
Aplikasi mendukung 2 tema:
- **sampahgo_light**: Tema terang dengan aksen hijau
- **sampahgo_dark**: Tema gelap dengan aksen hijau

Toggle tema tersedia di header aplikasi.

## Development

### Build untuk Production
```bash
npm run build
php artisan optimize
```

### Watch untuk Development
```bash
npm run dev
```

### Testing
```bash
php artisan test
```

## CI/CD
GitHub Actions workflow tersedia di `.github/workflows/sampahgo.yml` untuk:
- Testing otomatis
- Code formatting dengan Laravel Pint
- Security auditing
- Build verification

## Contributing
1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## License
MIT License
