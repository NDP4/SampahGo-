# SampahGo! - Database Schema & CI/CD

## Database Schema

Aplikasi ini menggunakan skema database yang terdiri dari 8 tabel utama berdasarkan ERD yang telah didefinisikan:

### 1. RW (Rukun Warga)

-   `id` (Primary Key)
-   `nama` (string)
-   `created_at`, `updated_at` (timestamps)

### 2. RT (Rukun Tetangga)

-   `id` (Primary Key)
-   `nama` (string)
-   `rw_id` (Foreign Key ke RW)
-   `created_at`, `updated_at` (timestamps)

### 3. Users (Pengguna)

-   `id` (Primary Key)
-   `nama` (string)
-   `email` (string, unique)
-   `kata_sandi` (string, hashed)
-   `peran` (enum: SuperAdmin, RW, RT, FO, Warga)
-   `rt_id` (Foreign Key ke RT, nullable)
-   `rw_id` (Foreign Key ke RW, nullable)
-   `aktif` (boolean)
-   `created_at`, `updated_at` (timestamps)

### 4. Kategori

-   `id` (Primary Key)
-   `nama` (string)
-   `deskripsi` (text)
-   `harga_per_kg` (decimal 10,2)
-   `created_at`, `updated_at` (timestamps)

### 5. Transaksi

-   `id` (Primary Key)
-   `rt_id` (Foreign Key ke RT)
-   `rw_id` (Foreign Key ke RW)
-   `dibuat_oleh` (Foreign Key ke Users)
-   `status` (enum: pending, approved, rejected, adjusted)
-   `created_at`, `updated_at` (timestamps)

### 6. ItemTransaksi

-   `id` (Primary Key)
-   `transaksi_id` (Foreign Key ke Transaksi)
-   `kategori_id` (Foreign Key ke Kategori)
-   `berat_input` (decimal 8,2)
-   `berat_disetujui` (decimal 8,2, nullable)
-   `harga_total` (decimal 10,2, nullable)
-   `created_at`, `updated_at` (timestamps)

### 7. Persetujuan

-   `id` (Primary Key)
-   `item_transaksi_id` (Foreign Key ke ItemTransaksi)
-   `disetujui_oleh` (Foreign Key ke Users)
-   `tindakan` (enum: approve, reject, adjust)
-   `komentar` (text, nullable)
-   `pada_pukul` (timestamp)
-   `created_at`, `updated_at` (timestamps)

### 8. Pendapatan

-   `id` (Primary Key)
-   `rt_id` (Foreign Key ke RT)
-   `item_transaksi_id` (Foreign Key ke ItemTransaksi)
-   `jumlah_uang` (decimal 10,2)
-   `created_at`, `updated_at` (timestamps)

## Model Relationships

### RW

-   `hasMany(RT::class)` - Satu RW memiliki banyak RT
-   `hasMany(User::class)` - Satu RW mengelola banyak Pengguna
-   `hasMany(Transaksi::class)` - Satu RW memiliki banyak Transaksi

### RT

-   `belongsTo(RW::class)` - RT milik satu RW
-   `hasMany(User::class)` - RT mencakup banyak Pengguna
-   `hasMany(Transaksi::class)` - RT memiliki banyak Transaksi
-   `hasMany(Pendapatan::class)` - RT mengakumulasi banyak Pendapatan

### User

-   `belongsTo(RT::class)` - Pengguna milik satu RT
-   `belongsTo(RW::class)` - Pengguna milik satu RW
-   `hasMany(Transaksi::class, 'dibuat_oleh')` - Pengguna membuat banyak Transaksi
-   `hasMany(Persetujuan::class, 'disetujui_oleh')` - Pengguna melakukan banyak Persetujuan

### Kategori

-   `hasMany(ItemTransaksi::class)` - Kategori mengklasifikasi banyak ItemTransaksi

### Transaksi

-   `belongsTo(RT::class)` - Transaksi milik satu RT
-   `belongsTo(RW::class)` - Transaksi milik satu RW
-   `belongsTo(User::class, 'dibuat_oleh')` - Transaksi dibuat oleh satu Pengguna
-   `hasMany(ItemTransaksi::class)` - Transaksi berisi banyak ItemTransaksi

### ItemTransaksi

-   `belongsTo(Transaksi::class)` - ItemTransaksi milik satu Transaksi
-   `belongsTo(Kategori::class)` - ItemTransaksi dikategorikan oleh satu Kategori
-   `hasMany(Persetujuan::class)` - ItemTransaksi ditinjau oleh banyak Persetujuan
-   `hasMany(Pendapatan::class)` - ItemTransaksi menghasilkan banyak Pendapatan

### Persetujuan

-   `belongsTo(ItemTransaksi::class)` - Persetujuan untuk satu ItemTransaksi
-   `belongsTo(User::class, 'disetujui_oleh')` - Persetujuan dilakukan oleh satu Pengguna

### Pendapatan

-   `belongsTo(RT::class)` - Pendapatan milik satu RT
-   `belongsTo(ItemTransaksi::class)` - Pendapatan dari satu ItemTransaksi

## Migrasi Database

File migrasi tersedia di `database/migrations/`:

1. `2025_07_28_000001_create_rws_table.php`
2. `2025_07_28_000002_create_rts_table.php`
3. `0001_01_01_000000_create_users_table.php`
4. `2025_07_28_000003_create_kategoris_table.php`
5. `2025_07_28_000004_create_transaksis_table.php`
6. `2025_07_28_000005_create_item_transaksis_table.php`
7. `2025_07_28_000006_create_persetujuans_table.php`
8. `2025_07_28_000007_create_pendapatans_table.php`

Jalankan migrasi dengan:

```bash
php artisan migrate
```

## CI/CD Pipeline

### GitHub Actions Workflows

1. **CI/CD Pipeline** (`.github/workflows/ci.yml`)

    - Berjalan pada setiap push/PR ke master/main
    - Menjalankan test dengan PHPUnit
    - Build assets dengan Node.js/Vite
    - Security audit
    - Code coverage reporting

2. **Quality Gates** (`.github/workflows/quality-gates.yml`)

    - Berjalan pada setiap Pull Request
    - Code formatting check dengan Laravel Pint
    - Static analysis (jika PHPStan tersedia)
    - Security vulnerability check
    - Test coverage threshold check (minimum 70%)

3. **Deploy to Production** (`.github/workflows/deploy.yml`)
    - Berjalan setelah CI/CD Pipeline berhasil
    - Membuat deployment artifacts
    - Siap untuk deploy ke server

### Composer Scripts

```bash
# Menjalankan test
composer test

# Test dengan coverage
composer test-coverage

# Format kode
composer format

# Check format tanpa mengubah
composer format-test

# Security check
composer security-check

# Menjalankan semua CI checks
composer ci
```

### Requirements

-   PHP 8.2+
-   MySQL 8.0 atau SQLite
-   Node.js 18+
-   Composer
-   NPM

### Local Development Setup

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate

# Build assets
npm run build

# Run tests
php artisan test
```

## Branch Protection

Untuk memastikan kualitas kode, konfigurasikan branch protection rules di GitHub:

1. Require pull request reviews
2. Require status checks to pass (CI/CD Pipeline, Quality Gates)
3. Require branches to be up to date
4. Restrict pushes to matching branches

Dengan konfigurasi ini, push atau merge ke master akan gagal jika:

-   Tests tidak passing
-   Code coverage di bawah threshold
-   Code formatting tidak sesuai standard
-   Terdapat security vulnerabilities
