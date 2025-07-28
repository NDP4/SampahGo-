# Troubleshooting CI/CD Issues

## Common Issues and Solutions

### 1. ❌ User Factory Error: "table users has no column named name"

**Problem**: Laravel User Factory menggunakan kolom default `name` dan `password`, tetapi database menggunakan `nama` dan `kata_sandi`.

**Solution**:

-   ✅ User Factory sudah diperbaiki untuk menggunakan kolom yang sesuai
-   ✅ User Model sudah dikonfigurasi dengan authentication methods yang tepat

**Files Updated**:

-   `database/factories/UserFactory.php` - Fixed to use `nama` and `kata_sandi`
-   `app/Models/User.php` - Added proper authentication methods

### 2. ❌ GitHub Actions Error: "deprecated version of actions/upload-artifact: v3"

**Problem**: Workflow menggunakan deprecated actions.

**Solution**:

-   ✅ Updated all actions to latest versions:
    -   `actions/upload-artifact@v4`
    -   `actions/cache@v4`
    -   `codecov/codecov-action@v4`

### 3. ❌ NPM Cache Error: "Dependencies lock file is not found"

**Problem**: Project tidak memiliki `package-lock.json`.

**Solution**:

-   ✅ Generated `package-lock.json` dengan menjalankan `npm install`
-   ✅ Updated workflows untuk menggunakan `npm ci` instead of `npm install`
-   ✅ Menggunakan `cache: "npm"` pada setup-node action

**Files Updated**:

-   `.github/workflows/laravel.yml`
-   `.github/workflows/ci.yml`
-   `.github/workflows/deploy.yml`
-   `.github/workflows/quality-gates.yml`

### 4. ❌ Laravel Pint Error: "vendor/bin/pint: No such file or directory"

**Problem**: Laravel Pint tidak ditemukan karena build job menggunakan `--no-dev` flag.

**Solution**:

-   ✅ Updated build job untuk install dependencies dengan dev packages untuk Pint
-   ✅ Created new `main.yml` workflow yang lebih clean
-   ✅ Separated testing dan production build jobs

### 5. ❌ PHPUnit Error: "Unknown option --verbose"

**Problem**: PHPUnit 11.x tidak support `--verbose` flag.

**Solution**:

-   ✅ Removed `--verbose` flag dari PHPUnit commands
-   ✅ Using `--configuration phpunit.xml` untuk run tests

**Scripts tersedia**:

-   `scripts/ci-check.sh` (Linux/Mac)
-   `scripts/ci-check.bat` (Windows)

**Usage**:

```bash
# Linux/Mac
./scripts/ci-check.sh

# Windows
scripts\ci-check.bat

# Or use composer
composer ci
```

## Current Status

### ✅ Fixed Issues:

1. User Factory dan Model authentication methods
2. GitHub Actions deprecated versions
3. NPM package-lock.json dan cache configuration
4. Laravel Pint not found in build job
5. PHPUnit --verbose flag compatibility
6. All workflows updated to latest action versions

### ✅ Test Results:

```
PHPUnit 11.5.27 by Sebastian Bergmann and contributors.
.......                                                             7 / 7 (100%)
Time: 00:00.650, Memory: 40.50 MB
OK (7 tests, 13 assertions)
```

### ✅ Workflow Files Status:

-   `main.yml` - ✅ Main workflow (NEW)
-   `ci.yml` - ✅ Updated and ready
-   `deploy.yml` - ✅ Updated to use main workflow
-   `quality-gates.yml` - ✅ Updated and ready
-   `laravel.yml` - ❌ Removed (replaced by main.yml)

-   `ci.yml` - ✅ Updated and ready
-   `laravel.yml` - ✅ Updated and ready
-   `deploy.yml` - ✅ Updated and ready
-   `quality-gates.yml` - ✅ Updated and ready

## Next Steps

1. **Commit dan Push** semua perubahan
2. **Test workflows** di GitHub Actions
3. **Configure branch protection** rules di GitHub repository
4. **Add repository secrets** jika diperlukan untuk deployment

## Repository Configuration

### Required Secrets (for deployment):

```
HOST=your-server-ip
USERNAME=deploy-user
KEY=private-ssh-key
PORT=22
```

### Branch Protection Rules:

-   ✅ Require pull request reviews
-   ✅ Require status checks to pass before merging
-   ✅ Require branches to be up to date before merging
-   ✅ Include administrators
