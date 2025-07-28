# GitHub Actions Configuration

## Overview

This repository uses GitHub Actions for Continuous Integration and Continuous Deployment (CI/CD).

## Workflows

### 1. CI/CD Pipeline (ci.yml)

Runs on every push and pull request to master/main branch.

**Jobs:**

-   **Test**: Runs PHPUnit tests with MySQL database
-   **Build**: Compiles assets and prepares production build
-   **Security**: Performs security audit and vulnerability checks

**Requirements:**

-   PHP 8.2
-   MySQL 8.0 (for testing)
-   Node.js 18
-   Composer dependencies

### 2. Deploy to Production (deploy.yml)

Runs after successful CI/CD pipeline completion.

**Features:**

-   Creates deployment artifacts
-   Uploads build files
-   Ready for server deployment (commented out)

## Environment Variables

Make sure to set the following secrets in your GitHub repository:

### For Production Deployment (if enabled):

-   `HOST`: Server hostname or IP
-   `USERNAME`: SSH username
-   `KEY`: SSH private key
-   `PORT`: SSH port (usually 22)

### For Database (if using external DB):

-   `DB_HOST`: Database host
-   `DB_USERNAME`: Database username
-   `DB_PASSWORD`: Database password
-   `DB_DATABASE`: Database name

## Local Development

To run tests locally:

```bash
# Install dependencies
composer install
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Run tests
php artisan test
# or
vendor/bin/phpunit

# Build assets
npm run build
```

## Code Quality

The CI pipeline includes:

-   PHPUnit testing
-   Laravel Pint code formatting
-   Security vulnerability checking
-   Code coverage reporting

Make sure your code passes all checks before pushing to master/main.
