# Invoice Management System

Laravel-based invoice and quotation management application with:

- Customer management
- Product management
- Quotation creation with per-item discount/tax logic
- Quotation preview and PDF download
- Company settings (used in preview/PDF)
- English/Arabic language switching with RTL support

## Tech Stack

- PHP 8.3+
- Laravel 13
- MySQL 8+
- Blade + AdminLTE
- barryvdh/laravel-dompdf for PDF generation

## Prerequisites

Install these before setup:

1. PHP 8.3 or later
2. Composer 2+
3. Node.js 18+ and npm
4. MySQL 8+

## Project Setup (Step by Step)

### 1. Clone and enter project

Use your own repository URL if needed.

```bash
git clone <your-repo-url>
cd invoice-management
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Environment configuration

Create environment file:

```bash
cp .env.example .env
```

Update database values in .env:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=invoiceDb
DB_USERNAME=root
DB_PASSWORD=
```

Generate app key:

```bash
php artisan key:generate
```

### 4. Create database and run migrations

Create the MySQL database (invoiceDb by default), then run:

```bash
php artisan migrate
```

### 5. Seed dummy data

```bash
php artisan db:seed --force
```

This seeds:

- 1 admin user
- Dummy company settings
- 50 customers
- 50 products

### 6. Build frontend assets

Development:

```bash
npm run dev
```

Production build:

```bash
npm run build
```

### 7. Run application

```bash
php artisan serve
```

Open:

- http://127.0.0.1:8000

## Admin Credentials

After seeding, login using:

- Email: admin@example.com
- Password: password

Seeder source:

- database/seeders/UserSeeder.php

## Company Dummy Data Seeded

Dummy company settings are seeded by:

- database/seeders/SettingSeeder.php

Keys:

- company_name
- company_address
- company_email
- company_phone

## Quotation Calculation Logic

Per item:

1. Base = quantity * unit_price
2. Discount = min(discount, Base)
3. Taxable = max(Base - Discount, 0)
4. Tax = Taxable * (tax_percentage / 100)
5. Item Total = Taxable + Tax

Quotation totals:

1. Subtotal = sum of item Base
2. Discount Total = sum of item Discount
3. Total = Subtotal - Discount Total
4. Tax Total = sum of item Tax
5. Grand Total = Total + Tax Total

## Module Summary (Brief)

### 1. Dashboard

- Displays high-level statistics:
	- customer count
	- quotation count
	- revenue (sum of quotation grand totals)

### 2. Customers

- Add, edit, delete customers
- Search customers
- Soft delete and restore support

### 3. Products

- Add, edit, delete products
- Search by name/SKU
- Active/inactive status
- Used in quotation item selection

### 4. Quotations

- Create quotation for customer/project
- Add multiple product line items
- Auto-fill item price from selected product
- Real-time totals in create form
- View quotation details
- Preview quotation page
- Download quotation as PDF

### 5. Company Settings

- Manage company details shown in quotation preview/PDF:
	- name
	- address
	- email
	- phone

### 6. Localization (EN/AR)

- Switch language from navbar
- Arabic RTL layout support
- Translations stored in lang/ar.json

## Important Routes

- Dashboard: /
- Customers: /customers
- Products: /products
- Quotations: /quotations
- Company Settings: /settings/company
- Quotation Preview: /quotations/{id}/preview
- Quotation Download PDF: /quotations/{id}/download

## Useful Commands

```bash
# Clear app caches
php artisan optimize:clear

# Re-run all migrations and seed from scratch
php artisan migrate:fresh --seed

# Check route list
php artisan route:list

# Check PHP syntax for a file
php -l app/Services/QuotationService.php
```

## Development Notes

- App uses database session driver by default.
- Company settings are key-value records in settings table.
- Quotation preview and PDF use the same computed totals and company setting data.

