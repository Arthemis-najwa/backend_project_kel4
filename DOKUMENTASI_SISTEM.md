# DOKUMENTASI SISTEM CIPTA KARIR

**Versi:** 1.0  
**Tanggal Pembuatan:**  03 September 2025  
**Framework:** Laravel 12.0  
**Database:** MySQL  
**PHP Version:** ^8.2

---

## DAFTAR ISI
1. [Pendahuluan](#pendahuluan)
2. [Tujuan Sistem](#tujuan-sistem)
3. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
4. [Arsitektur Sistem](#arsitektur-sistem)
5. [Struktur Database](#struktur-database)
6. [Struktur Project](#struktur-project)
7. [Deskripsi Modul/Fitur](#deskripsi-modul--fitur)
8. [Model & Relasi](#model--relasi)
9. [Routes & API Endpoints](#routes--api-endpoints)
10. [Controllers](#controllers)
11. [Middleware](#middleware)
12. [Alur Proses Bisnis](#alur-proses-bisnis)
13. [Fitur Utama](#fitur-utama)
14. [Instalasi & Setup](#instalasi--setup)
15. [Troubleshooting](#troubleshooting)

---

## PENDAHULUAN

**Cipta Karir** adalah sebuah sistem manajemen penempatan kerja dan perekrutan yang dirancang untuk menghubungkan pelamar kerja dengan perusahaan yang memiliki lowongan pekerjaan. Sistem ini memungkinkan administrasi untuk mengelola data pelamar, perusahaan, lowongan pekerjaan, dan proses pencocokan otomatis antara kualifikasi pelamar dengan kebutuhan pekerjaan.

---

## TUJUAN SISTEM

1. **Manajemen Data Pelamar**: Mengelola data lengkap pelamar kerja termasuk latar belakang pendidikan, pengalaman, dan skill
2. **Manajemen Perusahaan**: Menyimpan informasi perusahaan yang membuka lowongan pekerjaan
3. **Manajemen Lowongan Pekerjaan**: Mengelola posisi yang tersedia di setiap perusahaan dengan spesifikasi kualifikasi
4. **Pencocokan Otomatis**: Sistem otomatis mencocokkan kualifikasi pelamar dengan kebutuhan lowongan
5. **Arsip & Riwayat**: Menyimpan riwayat dan arsip data pelamar yang sudah diproses
6. **Export Data**: Kemampuan untuk mengekspor data pelamar sesuai lowongan yang dituju
7. **Autentikasi Admin**: Sistem login aman untuk admin dengan manajemen password

---

## TEKNOLOGI YANG DIGUNAKAN

### Backend
- **Framework**: Laravel 12.0
- **PHP Version**: ^8.2
- **Database**: MySQL
- **ORM**: Eloquent

### Frontend
- **CSS Framework**: Tailwind CSS 3.4.18
- **CSS Utilities**: @tailwindcss/forms, @tailwindcss/vite
- **Build Tool**: Vite 7.0.4
- **JavaScript Library**: Alpine.js 3.4.2, jQuery 3.7.1
- **HTTP Client**: Axios 1.11.0

### Development Tools
- **Package Manager**: Composer (PHP), NPM (Node.js)
- **CSS Processing**: PostCSS, Autoprefixer

### Libraries
- **Excel**: Maatwebsite/Excel 3.1 (untuk import/export)
- **ORM Utilities**: Phiki 2.0

---

## ARSITEKTUR SISTEM

```
┌─────────────────┐
│   User (Admin)  │
└────────┬────────┘
         │
    ┌────▼────────────────────────────────────┐
    │    Laravel Web Application               │
    │  ┌──────────────────────────────────┐  │
    │  │  Routes (web.php, auth.php)     │  │
    │  │  - Authentication Routes        │  │
    │  │  - CRUD Routes                  │  │
    │  │  - Export Routes                │  │
    │  └──────────────────────────────────┘  │
    │                                        │
    │  ┌──────────────────────────────────┐  │
    │  │  Controllers                     │  │
    │  │  - AuthController               │  │
    │  │  - ApplicantController          │  │
    │  │  - CompanyController            │  │
    │  │  - VacancyController            │  │
    │  │  - DashboardController          │  │
    │  │  - PageController               │  │
    │  │  - ArchiveController            │  │
    │  │  - ProfileController            │  │
    │  └──────────────────────────────────┘  │
    │                                        │
    │  ┌──────────────────────────────────┐  │
    │  │  Models (Eloquent)               │  │
    │  │  - Admin, User, Applicant        │  │
    │  │  - Company, Vacancy              │  │
    │  │  - Qualification, Archive        │  │
    │  │  - ApplicantFile                 │  │
    │  │  - ApplicantRecommendation       │  │
    │  └──────────────────────────────────┘  │
    │                                        │
    │  ┌──────────────────────────────────┐  │
    │  │  Middleware                      │  │
    │  │  - CSRF Protection               │  │
    │  │  - Authentication                │  │
    │  │  - Authorization                 │  │
    │  └──────────────────────────────────┘  │
    └────┬──────────────────────────────────┘
         │
    ┌────▼─────────────────────────────────┐
    │      MySQL Database                  │
    │  ┌────────────────────────────────┐ │
    │  │ Tables:                        │ │
    │  │ - admins                       │ │
    │  │ - users                        │ │
    │  │ - applicants                   │ │
    │  │ - companies                    │ │
    │  │ - vacancies                    │ │
    │  │ - qualifications               │ │
    │  │ - applicant_files              │ │
    │  │ - applicant_recommendations    │ │
    │  │ - archives                     │ │
    │  │ - password_reset_tokens        │ │
    │  │ - sessions                     │ │
    │  │ - cache                        │ │
    │  └────────────────────────────────┘ │
    └────────────────────────────────────┘
```

---

## STRUKTUR DATABASE

### 1. Tabel ADMINS
Menyimpan data administrator sistem

```sql
CREATE TABLE admins (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
)
```

### 2. Tabel APPLICANTS
Menyimpan data pelamar kerja

```sql
CREATE TABLE applicants (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(255) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    usia INT NOT NULL,
    jenis_kelamin CHAR(1) NOT NULL,
    status_pernikahan VARCHAR(255) NOT NULL,
    alamat VARCHAR(255) NOT NULL,
    no_telp VARCHAR(13) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    pendidikan_terakhir VARCHAR(255) NOT NULL,
    jurusan VARCHAR(255) NOT NULL,
    tahun_lulus INT NOT NULL,
    pengalaman_kerja TEXT,
    skill_teknis TEXT,
    skill_non_teknis TEXT,
    status_vaksinasi VARCHAR(255),
    perusahaan_tujuan VARCHAR(255),
    status VARCHAR(255) DEFAULT 'active',
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP (Soft Delete)
)
```

**Soft Delete**: Menggunakan fitur soft delete Laravel untuk menghapus data secara logis tanpa menghapus fisik dari database

---

### 3. Tabel COMPANIES
Menyimpan data perusahaan

```sql
CREATE TABLE companies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_perusahaan VARCHAR(255) NOT NULL,
    alamat VARCHAR(255) NOT NULL,
    kontak VARCHAR(255) NOT NULL,
    bidang_usaha VARCHAR(255) NOT NULL,
    status_lowongan VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
)
```

### 4. Tabel VACANCIES
Menyimpan lowongan pekerjaan dari perusahaan

```sql
CREATE TABLE vacancies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id BIGINT UNSIGNED NOT NULL,
    qualification_id BIGINT UNSIGNED,
    posisi VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES companies(id)
    FOREIGN KEY (qualification_id) REFERENCES qualifications(id)
)
```

### 5. Tabel QUALIFICATIONS
Menyimpan kualifikasi yang dipersyaratkan untuk suatu lowongan

```sql
CREATE TABLE qualifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    vacancy_id BIGINT UNSIGNED,
    status_vaksinasi VARCHAR(255),
    status_pernikahan VARCHAR(255),
    jenis_kelamin CHAR(1),
    usia_minimum INT,
    usia_maksimum INT,
    pendidikan_terakhir VARCHAR(255),
    jurusan VARCHAR(255),
    tahun_lulus INT,
    pengalaman_kerja TEXT,
    skill_teknis TEXT,
    skill_non_teknis TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (vacancy_id) REFERENCES vacancies(id)
)
```

### 6. Tabel APPLICANT_FILES
Menyimpan dokumen/file pelamar (link dokumen)

```sql
CREATE TABLE applicant_files (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    applicant_id BIGINT UNSIGNED NOT NULL,
    link_dokumen VARCHAR(255),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (applicant_id) REFERENCES applicants(id)
)
```

### 7. Tabel APPLICANT_RECOMMENDATIONS
Menyimpan rekomendasi lowongan yang cocok untuk pelamar

```sql
CREATE TABLE applicant_recommendations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    applicant_id BIGINT UNSIGNED NOT NULL,
    vacancy_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (applicant_id) REFERENCES applicants(id),
    FOREIGN KEY (vacancy_id) REFERENCES vacancies(id)
)
```

### 8. Tabel ARCHIVES
Menyimpan arsip data pelamar yang sudah diproses

```sql
CREATE TABLE archives (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    applicant_id BIGINT UNSIGNED,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (applicant_id) REFERENCES applicants(id)
)
```

### 9. Tabel PASSWORD_RESET_TOKENS
Menyimpan token reset password

```sql
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP
)
```

---

### 10. Tabel SESSIONS
Menyimpan session pengguna

```sql
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    ip_address VARCHAR(45),
    user_agent TEXT,
    payload LONGTEXT,
    last_activity INT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
)
```

---

### 11. Tabel CACHE
Cache table untuk performa

```sql
CREATE TABLE cache (
    key VARCHAR(255) PRIMARY KEY,
    value LONGTEXT,
    expiration INT
)
```

---

## STRUKTUR PROJECT

```
backend_project_kel4/
├── app/
│   ├── Exports/
│   │   └── ApplicantsExport.php          # Export applicants ke Excel
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php         # Controller autentikasi
│   │   │   ├── ApplicantController.php    # Controller data pelamar
│   │   │   ├── CompanyController.php      # Controller data perusahaan
│   │   │   ├── VacancyController.php      # Controller data lowongan
│   │   │   ├── DashboardController.php    # Controller dashboard
│   │   │   ├── PageController.php         # Controller halaman statis
│   │   │   ├── ArchiveController.php      # Controller arsip
│   │   │   ├── ProfileController.php      # Controller profil admin
│   │   │   ├── Controller.php             # Base controller
│   │   │   └── Auth/                      # Laraveler Breeze auth
│   │   │       ├── AuthenticatedSessionController.php
│   │   │       ├── ConfirmablePasswordController.php
│   │   │       ├── EmailVerificationNotificationController.php
│   │   │       ├── EmailVerificationPromptController.php
│   │   │       ├── NewPasswordController.php
│   │   │       ├── PasswordResetLinkController.php
│   │   │       ├── RegisteredUserController.php
│   │   │       └── VerifyEmailController.php
│   │   ├── Middleware/
│   │   │   ├── EncryptCookies.php
│   │   │   ├── PreventRequestsDuringMaintenance.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustProxies.php
│   │   │   └── VerifyCsrfToken.php
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── Admin.php                      # Model admin
│   │   ├── Applicant.php                  # Model pelamar
│   │   ├── ApplicantFile.php              # Model file pelamar
│   │   ├── ApplicantRecommendation.php    # Model rekomendasi
│   │   ├── Archive.php                    # Model arsip
│   │   ├── Company.php                    # Model perusahaan
│   │   ├── Qualification.php              # Model kualifikasi
│   │   ├── User.php                       # Model user (dari Breeze)
│   │   └── Vacancy.php                    # Model lowongan
│   ├── Providers/
│   │   ├── AppServiceProvider.php         # Service provider utama
│   │   └── RouteServiceProvider.php       # Route service provider
│   └── View/
│       └── Components/                    # View components
├── bootstrap/
│   ├── app.php                            # Bootstrap aplikasi
│   ├── providers.php                      # Register providers
│   └── cache/
│       ├── packages.php
│       └── services.php
├── config/
│   ├── app.php                            # Konfigurasi aplikasi
│   ├── auth.php                           # Konfigurasi autentikasi
│   ├── cache.php                          # Konfigurasi cache
│   ├── database.php                       # Konfigurasi database
│   ├── filesystems.php                    # Konfigurasi file storage
│   ├── logging.php                        # Konfigurasi logging
│   ├── mail.php                           # Konfigurasi email
│   ├── queue.php                          # Konfigurasi queue
│   ├── services.php                       # Konfigurasi services
│   └── session.php                        # Konfigurasi session
├── database/
│   ├── factories/
│   │   └── UserFactory.php                # Factory untuk testing
│   ├── migrations/
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 2025_09_25_073024_create_admins_table.php
│   │   ├── 2025_09_25_073211_create_companies_table.php
│   │   ├── 2025_09_25_073254_create_applicants_table.php
│   │   ├── 2025_09_25_073340_create_archives_table.php
│   │   ├── 2025_09_25_073532_create_applicant_files_table.php
│   │   ├── 2025_09_25_073613_create_placements_table.php
│   │   ├── 2025_10_08_022634_create_password_reset_tokens_table.php
│   │   ├── 2025_10_08_033551_create_sessions_table.php
│   │   ├── 2025_10_16_072345_create_qualifications_table.php
│   │   └── 2025_10_21_070622_alter_qualifications_make_applicant_id_nullable.php
│   └── seeders/
│       └── DatabaseSeeder.php             # Database seeding
├── public/
│   ├── index.php                          # Entry point aplikasi
│   ├── robots.txt
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   ├── img/
│   │   └── vendor/
│   ├── build/
│   │   ├── manifest.json
│   │   └── assets/
│   ├── css/style.css                      # Custom CSS
│   ├── fonts/
│   ├── imgs/
│   ├── js/
│   ├── libs/
│   ├── scss/
│   └── sneat-1.0.0/                       # Template Sneat UI Kit
├── resources/
│   ├── css/                               # CSS untuk Vite
│   ├── js/                                # JavaScript untuk Vite
│   └── views/                             # Blade templates
├── routes/
│   ├── auth.php                           # Routes autentikasi (Breeze)
│   ├── web.php                            # Routes utama aplikasi
│   └── console.php                        # Console commands
├── storage/
│   ├── app/                               # File storage
│   ├── framework/                         # Framework cache
│   └── logs/                              # Log files
├── tests/
│   ├── TestCase.php                       # Base test case
│   ├── Feature/                           # Feature tests
│   └── Unit/                              # Unit tests
├── vendor/                                # Composer dependencies
├── artisan                                # Laravel CLI
├── composer.json                          # Composer dependencies
├── package.json                           # NPM dependencies
├── phpunit.xml                            # PHPUnit configuration
├── tailwind.config.js                     # Tailwind CSS configuration
├── vite.config.js                         # Vite configuration
├── postcss.config.js                      # PostCSS configuration
└── cipta_karir.sql                        # Database backup/dump

```

---

## DESKRIPSI MODUL / FITUR

### 1. **Module Autentikasi (Authentication)**
Modul untuk login dan manajemen session admin

**Files:**
- `routes/web.php` - Routes login/logout
- `routes/auth.php` - Routes dari Laravel Breeze
- `app/Http/Controllers/AuthController.php` - Logic autentikasi
- `app/Models/Admin.php` - Model admin

**Fitur:**
- Login dengan username dan password
- Logout admin
- Reset password dengan OTP
- Session management
- CSRF protection

**Routes:**
```
GET  /login                    - Tampilkan form login
POST /login                    - Process login
GET  /logout                   - Logout
POST /forgot-password          - Send OTP ke email
GET  /verify-otp              - Tampilkan form verifikasi OTP
POST /verify-otp              - Verifikasi OTP
GET  /reset-password          - Tampilkan form reset password
POST /reset-password          - Process reset password
```

---

### 2. **Module Manajemen Data Pelamar (Applicant Management)**
Modul untuk CRUD data pelamar kerja

**Files:**
- `app/Http/Controllers/ApplicantController.php`
- `app/Models/Applicant.php`
- `app/Models/ApplicantFile.php`
- `app/Models/ApplicantRecommendation.php`
- `app/Exports/ApplicantsExport.php`

**Fitur:**
- Tambah data pelamar baru
- Edit data pelamar
- Hapus data pelamar (soft delete)
- Tampilkan daftar pelamar
- Automatic matching dengan lowongan pekerjaan
- Update status pelamar
- Archive pelamar
- Export data pelamar ke Excel
- Upload/simpan file dokumen pelamar

**Routes:**
```
GET  /pelamar                        - Tampilkan daftar pelamar
POST /applicants/store              - Tambah pelamar baru
PUT  /applicants/{id}               - Update pelamar
DELETE /applicants/{id}             - Hapus pelamar (soft delete)
POST /applicants/update-status/{id} - Update status pelamar
POST /applicants/{id}/archive       - Archive pelamar
POST /applicants/{id}/restore       - Restore pelamar dari arsip
DELETE /applicants/{id}/permanent-delete - Hapus permanen
POST /applicants/{id}/kirim         - Kirim rekomendasi ke perusahaan
GET /vacancies/{id}/export          - Export pelamar untuk lowongan
```

**Business Logic:**
- Validasi email unik
- Validasi usia minimum 17 tahun
- Automatic matching dengan vacancy berdasarkan kualifikasi
- Soft delete untuk audit trail
- Relasi dengan file, rekomendasi, dan kualifikasi

---

### 3. **Module Manajemen Perusahaan (Company Management)**
Modul untuk CRUD data perusahaan

**Files:**
- `app/Http/Controllers/CompanyController.php`
- `app/Models/Company.php`

**Fitur:**
- Tambah perusahaan baru
- Edit data perusahaan
- Hapus perusahaan
- Tampilkan daftar perusahaan
- Update status lowongan
- Relasi dengan lowongan pekerjaan

**Routes:**
```
GET  /perusahaan               - Tampilkan daftar perusahaan
GET  /perusahaan/data         - Get data perusahaan (API)
GET  /companies               - Tampilkan companies (index)
POST /companies/store         - Tambah perusahaan
GET  /companies/{id}/edit     - Form edit perusahaan
PUT  /companies/{id}          - Update perusahaan
DELETE /companies/{id}        - Hapus perusahaan
PUT  /companies/{id}/status   - Update status lowongan
```

**Business Logic:**
- Setiap perusahaan dapat memiliki banyak lowongan
- Tracking status lowongan aktif/nonaktif
- Informasi kontak perusahaan

---

### 4. **Module Manajemen Lowongan Pekerjaan (Vacancy Management)**
Modul untuk CRUD lowongan pekerjaan

**Files:**
- `app/Http/Controllers/VacancyController.php`
- `app/Models/Vacancy.php`
- `app/Models/Qualification.php`

**Fitur:**
- Tambah lowongan pekerjaan baru
- Edit lowongan
- Hapus lowongan
- Tampilkan daftar lowongan
- Set kualifikasi untuk lowongan
- Export pelamar yang sesuai
- Relasi dengan company dan qualification

**Routes:**
```
GET  /lowongan-pekerjaan        - Tampilkan daftar lowongan
GET  /vacancies                 - Tampilkan vacancies (index)
POST /vacancies/store           - Tambah lowongan baru
GET  /vacancies/{id}/edit       - Form edit lowongan
PUT  /vacancies/{id}            - Update lowongan
DELETE /vacancies/{id}          - Hapus lowongan
GET  /vacancies/{id}/export     - Export pelamar untuk lowongan
```

**Business Logic:**
- Setiap lowongan linked ke satu perusahaan
- Setiap lowongan memiliki satu set kualifikasi
- Kualifikasi berisi requirement spesifik untuk posisi
- Matching algorithm menggunakan tabel qualifications

---

### 5. **Module Dashboard Admin (Dashboard)**
Modul untuk dashboard/overview sistem

**Files:**
- `app/Http/Controllers/DashboardController.php`

**Routes:**
```
GET /admin/dashboard  - Tampilkan dashboard
GET /dashboard        - Redirect ke dashboard
```

**Fitur:**
- Overview statistik data
- Quick access ke fitur utama
- Monitoring data

---

### 6. **Module Arsip Data (Archive)**
Modul untuk manajemen arsip data pelamar

**Files:**
- `app/Http/Controllers/ArchiveController.php`
- `app/Models/Archive.php`

**Fitur:**
- Tampilkan daftar arsip pelamar
- Restore arsip (kembalikan ke daftar aktif)
- Hapus permanen arsip
- Tracking pelamar yang sudah selesai diproses

**Routes:**
```
GET /arsip-data-pelamar          - Tampilkan daftar arsip
POST /archives/{id}/restore      - Restore dari arsip
DELETE /archives/{id}/hapus      - Hapus permanen dari arsip
```

**Business Logic:**
- Menggunakan relasi belongsTo ke Applicant dengan withTrashed()
- Memungkinkan recovery data yang di-soft delete
- Permanen delete untuk data yang tidak lagi diperlukan

---

### 7. **Module Profile Admin (Profile)**
Modul untuk manajemen profil admin

**Files:**
- `app/Http/Controllers/ProfileController.php`

**Fitur:**
- Edit password admin
- Ganti password dengan validasi

**Routes:**
```
GET  /ganti-password  - Form ganti password
POST /ganti-password  - Process ganti password
```

---

### 8. **Module Halaman Statis (Pages)**
Modul untuk menampilkan halaman-halaman view

**Files:**
- `app/Http/Controllers/PageController.php`

**Routes:**
```
GET /pelamar              - Halaman data pelamar
GET /lowongan-pekerjaan   - Halaman lowongan
GET /perusahaan           - Halaman perusahaan
GET /arsip-data-pelamar   - Halaman arsip
```

---

## MODEL & RELASI

### Model Relationship Diagram

```
Admin (1) ─────── (Many) Session
    │
    └─── No relationship (standalone)

User (1) ─────── (Many) Session
    │
    └─── No relationship (standalone)

Company (1) ─────── (Many) Vacancy
    │
    └─── Melalui Vacancy ────── Qualification

Vacancy (1) ─────── (Many) Applicant
    │
    └─── (Many) ApplicantRecommendation
    │
    └─── (1) Qualification
         │
         └─── No direct relationship (contains requirements)

Applicant (1) ─────── (Many) ApplicantFile
    │
    ├─── (Many) ApplicantRecommendation
    │
    ├─── (1) Archive
    │
    └─── (1) ApplicantQualification (proposal)

ApplicantRecommendation (Many) ─────── (1) Applicant
    │
    └─── (Many) ─────── (1) Vacancy
```

### Detail Setiap Model

#### **Admin Model**
```php
class Admin extends Authenticatable {
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password'];
}
```
- Extends Authenticatable untuk login
- Username unik
- Password hashed
- No relationships

#### **User Model**
```php
class User extends Authenticatable {
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
```
- Model default dari Laravel Breeze
- Email verified at column
- Password hashed

#### **Applicant Model**
```php
class Applicant extends Model {
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'nama_lengkap', 'tanggal_lahir', 'usia', 'jenis_kelamin',
        'status_pernikahan', 'alamat', 'no_telp', 'email',
        'pendidikan_terakhir', 'jurusan', 'tahun_lulus',
        'pengalaman_kerja', 'skill_teknis', 'skill_non_teknis',
        'status_vaksinasi', 'perusahaan_tujuan', 'status'
    ];
    
    // Relationships
    public function qualification() {
        return $this->hasOne(ApplicantQualification::class);
    }
    public function recommendations() {
        return $this->hasMany(ApplicantRecommendation::class);
    }
    public function files() {
        return $this->hasMany(ApplicantFile::class);
    }
}
```

**Key Features:**
- Soft delete untuk audit trail
- Multiple relationships
- Timestamps included

#### **Company Model**
```php
class Company extends Model {
    use HasFactory;
    
    protected $fillable = [
        'nama_perusahaan', 'alamat', 'kontak', 
        'bidang_usaha', 'status_lowongan'
    ];
    
    public function vacancies() {
        return $this->hasMany(Vacancy::class);
    }
}
```

**Key Features:**
- One-to-many relationship dengan Vacancy
- Business information fields

#### **Vacancy Model**
```php
class Vacancy extends Model {
    use HasFactory;
    
    protected $fillable = [
        'company_id', 'qualification_id', 'posisi'
    ];
    
    public function company() {
        return $this->belongsTo(Company::class);
    }
    public function qualification() {
        return $this->hasOne(Qualification::class);
    }
    public function applicants() {
        return $this->hasMany(Applicant::class);
    }
}
```

**Key Features:**
- Belongs to Company
- Has One Qualification
- Related to Applicants through recommendations

#### **Qualification Model**
```php
class Qualification extends Model {
    use HasFactory;
    
    protected $fillable = [
        'vacancy_id', 'status_vaksinasi', 'status_pernikahan',
        'jenis_kelamin', 'usia_minimum', 'usia_maksimum',
        'pendidikan_terakhir', 'jurusan', 'tahun_lulus',
        'pengalaman_kerja', 'skill_teknis', 'skill_non_teknis'
    ];
    
    public function vacancy() {
        return $this->belongsTo(Vacancy::class);
    }
}
```

**Purpose:**
- Menyimpan requirement spesifik untuk setiap vacancy
- Digunakan untuk matching algorithm

#### **ApplicantFile Model**
```php
class ApplicantFile extends Model {
    protected $fillable = ['applicant_id', 'link_dokumen'];
    
    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }
}
```

**Purpose:**
- Menyimpan link dokumen pelamar
- One-to-many relationship dengan Applicant

#### **ApplicantRecommendation Model**
```php
class ApplicantRecommendation extends Model {
    protected $fillable = ['applicant_id', 'vacancy_id'];
    
    public function applicant() {
        return $this->belongsTo(Applicant::class);
    }
    public function vacancy() {
        return $this->belongsTo(Vacancy::class);
    }
}
```

**Purpose:**
- Menyimpan rekomendasi lowongan untuk pelamar
- Junction table antara Applicant dan Vacancy
- Hasil dari matching algorithm

#### **Archive Model**
```php
class Archive extends Model {
    use HasFactory;
    
    protected $fillable = ['applicant_id'];
    
    public function applicant() {
        return $this->belongsTo(Applicant::class)->withTrashed();
    }
}
```

**Purpose:**
- Menyimpan record arsip pelamar
- withTrashed() memungkinkan akses pelamar yang sudah di-soft delete
- Untuk tracking riwayat pelamar

---

## ROUTES & API ENDPOINTS

### Authentication Routes

#### Login
```
GET  /login
POST /login
```
**Parameters (POST):**
- `username` (required): Username admin
- `password` (required): Password admin

**Response:** Redirect ke dashboard jika sukses, atau kembali ke login dengan error

#### Logout
```
GET /logout
```
**Response:** Redirect ke login page

#### Password Reset Flow
```
POST /forgot-password          - Send OTP
GET  /verify-otp              - Show OTP verification form
POST /verify-otp              - Verify OTP
GET  /reset-password          - Show reset form
POST /reset-password          - Process reset
```

---

### Applicant Routes

#### List Applicants
```
GET /pelamar
```
**Response:** HTML view dengan tabel daftar pelamar

#### Create Applicant
```
POST /applicants/store
```
**Parameters:**
```json
{
    "nama_lengkap": "string (required, max:255)",
    "tanggal_lahir": "date (required)",
    "usia": "integer (required, min:17)",
    "jenis_kelamin": "string (required, max:1)",
    "status_pernikahan": "string (required, max:255)",
    "alamat": "string (required, max:255)",
    "no_telp": "string (required, max:13)",
    "email": "email (required, unique)",
    "pendidikan_terakhir": "string (required, max:255)",
    "jurusan": "string (required, max:255)",
    "tahun_lulus": "integer (required)",
    "pengalaman_kerja": "string (nullable)",
    "skill_teknis": "string (nullable)",
    "skill_non_teknis": "string (nullable)",
    "status_vaksinasi": "string (nullable)",
    "perusahaan_tujuan": "string (nullable)",
    "link_dokumen": "url (nullable)"
}
```
**Response:** Redirect dengan success message

#### Update Applicant
```
PUT /applicants/{id}
```
**Parameters:** Same as create
**Response:** Redirect dengan success message

#### Delete Applicant (Soft Delete)
```
DELETE /applicants/{id}
```
**Response:** Redirect dengan success message

#### Update Applicant Status
```
POST /applicants/update-status/{id}
```
**Parameters:**
```json
{
    "status": "string (active|rejected|approved)"
}
```

#### Archive Applicant
```
POST /applicants/{id}/archive
```
**Response:** Move to archive

#### Restore Applicant
```
POST /applicants/{id}/restore
```
**Response:** Restore from archive

#### Permanent Delete
```
DELETE /applicants/{id}/permanent-delete
```
**Response:** Permanent deletion

#### Send/Kirim Applicant
```
POST /applicants/{id}/kirim
```
**Purpose:** Send applicant recommendation to company

---

### Company Routes

#### List Companies
```
GET /perusahaan
GET /companies
```
**Response:** HTML view dengan daftar perusahaan

#### Get Companies Data (API)
```
GET /perusahaan/data
```
**Response:** JSON array of companies

#### Create Company
```
POST /companies/store
```
**Parameters:**
```json
{
    "nama_perusahaan": "string (required)",
    "alamat": "string (required)",
    "kontak": "string (required)",
    "bidang_usaha": "string (required)",
    "status_lowongan": "string"
}
```

#### Update Company
```
PUT /companies/{id}
```
**Parameters:** Same as create

#### Update Company Status
```
PUT /companies/{id}/status
```
**Parameters:**
```json
{
    "status_lowongan": "string"
}
```

#### Delete Company
```
DELETE /companies/{id}
```

#### Edit Company Form
```
GET /companies/{id}/edit
```
**Response:** HTML form untuk edit perusahaan

---

### Vacancy Routes

#### List Vacancies
```
GET /lowongan-pekerjaan
GET /vacancies
```
**Response:** HTML view dengan daftar lowongan

#### Create Vacancy
```
POST /vacancies/store
```
**Parameters:**
```json
{
    "company_id": "integer (required)",
    "qualification_id": "integer",
    "posisi": "string (required)"
}
```

#### Update Vacancy
```
PUT /vacancies/{id}
```
**Parameters:** Same as create

#### Delete Vacancy
```
DELETE /vacancies/{id}
```

#### Edit Vacancy Form
```
GET /vacancies/{id}/edit
```

#### Export Vacancy Applicants
```
GET /vacancies/{id}/export
```
**Response:** Excel file dengan daftar pelamar yang cocok untuk vacancy

---

### Archive Routes

#### List Archives
```
GET /arsip-data-pelamar
```
**Response:** HTML view dengan daftar arsip

#### Restore from Archive
```
POST /archives/{id}/restore
```
**Response:** Restore to active applicants

#### Delete Archive
```
DELETE /archives/{id}/hapus
```
**Response:** Permanent delete

---

### Profile Routes

#### Change Password Form
```
GET /ganti-password
```
**Response:** HTML form ganti password

#### Update Password
```
POST /ganti-password
```
**Parameters:**
```json
{
    "current_password": "string (required)",
    "password": "string (required, min:8)",
    "password_confirmation": "string (required)"
}
```

---

### Page Routes

#### Dashboard
```
GET /admin/dashboard
GET /dashboard
```
**Response:** Dashboard view

#### Home Page Redirect
```
GET /
```
**Response:** Redirect to /login

---

## CONTROLLERS

### AuthController

**Location:** `app/Http/Controllers/AuthController.php`

**Methods:**

#### `login()`
- **Purpose:** Display login form
- **Return:** View 'new-login'
- **Accessible:** Guest only (middleware 'guest')

#### `login_post(Request $request)`
- **Purpose:** Process login request
- **Validation:**
  - username: required, string, exists in admins table
  - password: required
- **Logic:**
  1. Validate input
  2. Find admin by username
  3. Check password with Hash::check()
  4. Login with Auth::login()
- **Return:** Redirect to dashboard on success, back with errors on failure

#### `logout()`
- **Purpose:** Logout admin
- **Logic:**
  1. Call Auth::logout()
  2. Redirect to login
- **Return:** Redirect to login page

#### `verifyOtp(Request $request)`
- **Purpose:** Verify OTP for password reset
- **Parameters:** email, otp
- **Logic:** Custom OTP verification (incomplete in codebase)

#### `resetPassword(Request $request)`
- **Purpose:** Reset password after OTP verification
- **Parameters:** email, password, password_confirmation
- **Logic:** Update admin password

#### `showResetForm()`
- **Purpose:** Display password reset form

---

### ApplicantController

**Location:** `app/Http/Controllers/ApplicantController.php`

**Key Methods:**

#### `index()`
```php
public function index() {
    $title = "Data Pelamar";
    $applicants = Applicant::with('recommendations.vacancy.company')
        ->whereNull('deleted_at')
        ->get();
    return view('admin.pelamar', compact('applicants', 'title'));
}
```
- Load applicants dengan relationships
- Exclude soft-deleted records
- Return view dengan data

#### `store(Request $request)`
- **Validation:** All required fields validated
- **Logic:**
  1. Create applicant with validated data
  2. Create ApplicantFile if link provided
  3. Call matchVacancies() untuk automatic matching
- **Return:** Redirect dengan success message

#### `update(Request $request, $id)`
- **Logic:** Similar to store dengan transaction handling
- **Transaction:** Use DB::beginTransaction() for data integrity
- **Matching:** Update recommendations otomatis

#### `destroy($id)`
- Soft delete aplikant
- Relationships maintained untuk audit

#### `updateStatus($id)`
- Update status field (active/rejected/approved)

#### `archive($id)`
- Move applicant ke archive table
- Soft delete record

#### `restore($id)`
- Restore soft-deleted applicant dari archive

#### `permanentDelete($id)`
- Force delete untuk permanent removal

#### `matchVacancies(Applicant $applicant)`
- **Purpose:** Automatic matching algorithm
- **Logic:** Compare applicant qualifications dengan vacancy requirements
- **Output:** Create ApplicantRecommendation records

#### `kirim($id)`
- **Purpose:** Send applicant to company
- **Logic:** Process sending data ke perusahaan tujuan

---

### CompanyController

**Location:** `app/Http/Controllers/CompanyController.php`

**Key Methods:**

#### `index()`
- Display list of companies

#### `store(Request $request)`
- Create new company
- Validation: nama_perusahaan, alamat, kontak, bidang_usaha

#### `update(Request $request, $id)`
- Update company data

#### `destroy($id)`
- Delete company
- Cascade: delete related vacancies

#### `updateStatus(Request $request, $id)`
- Update status_lowongan field

#### `data()`
- Return JSON data untuk API/AJAX
- Used untuk dropdown/select options

---

### VacancyController

**Location:** `app/Http/Controllers/VacancyController.php`

**Key Methods:**

#### `index()`
- Display list of vacancies dengan related company dan qualification

#### `store(Request $request)`
- Create vacancy dengan qualification
- Linked ke company

#### `update(Request $request, $id)`
- Update vacancy information

#### `edit($id)`
- Return edit form

#### `destroy($id)`
- Delete vacancy

#### `export($id)`
- **Purpose:** Export matching applicants untuk vacancy
- **Return:** Excel file dengan ApplicantsExport::class
- **Data:** Filtered applicants berdasarkan recommendations

---

### DashboardController

**Location:** `app/Http/Controllers/DashboardController.php`

#### `index()`
- Display admin dashboard
- Likely contains statistics dan quick access
- Requires authentication

---

### PageController

**Location:** `app/Http/Controllers/PageController.php`

**Purpose:** Serve static/view-only pages

**Methods:**
- `pelamar()` - List view halaman pelamar
- `lowongan_pekerjaan()` - List view halaman lowongan
- `perusahaan()` - List view halaman perusahaan
- `arsip_data_pelamar()` - List view halaman arsip

---

### ArchiveController

**Location:** `app/Http/Controllers/ArchiveController.php`

#### `index()`
- Display archived applicants

#### `restore($id)`
- **Logic:**
  1. Get archive record
  2. Restore associated applicant dari soft delete
  3. Delete archive record
- **Return:** Redirect dengan success

#### `destroy($id)`
- Permanent delete archive record

---

### ProfileController

**Location:** `app/Http/Controllers/ProfileController.php`

#### `editPassword()`
- Display password change form

#### `updatePassword(Request $request)`
- **Validation:**
  - current_password: required, valid current password
  - password: required, min:8, confirmed
- **Logic:**
  1. Verify current password
  2. Hash dan update password
  3. Logout user setelah password change (optional)

---

## MIDDLEWARE

### Global Middleware (Applied to all requests)

1. **TrustProxies** - Untuk trusted proxies configuration
2. **HandleCors** - CORS handling
3. **PreventRequestsDuringMaintenance** - Maintenance mode
4. **ValidatePostSize** - POST size validation
5. **TrimStrings** - Trim whitespace dari input
6. **ConvertEmptyStringsToNull** - Convert empty strings to NULL

### Web Middleware Group (Applied to web routes)

1. **EncryptCookies** - Encrypt cookies
2. **AddQueuedCookiesToResponse** - Queue cookies to response
3. **StartSession** - Start session
4. **ShareErrorsFromSession** - Share session errors ke views
5. **VerifyCsrfToken** - CSRF protection
6. **SubstituteBindings** - Route model binding

### Custom Middleware

**VerifyCsrfToken** (`app/Http/Middleware/VerifyCsrfToken.php`)
- CSRF token validation untuk state-changing requests
- POST, PUT, DELETE, PATCH requests harus include CSRF token

---

## ALUR PROSES BISNIS

### 1. Flow Pendaftaran Admin Baru

```
Admin Baru
    ↓
Insert ke tabel admins (manual/seeder)
    ↓
Admin dapat login dengan username/password
    ↓
Access dashboard & features
```

### 2. Flow Tambah Data Pelamar

```
Admin Input Data Pelamar
    ↓
Controller Validasi Input
    ↓
Create Applicant Record di DB
    ↓
Create ApplicantFile (jika ada link dokumen)
    ↓
Trigger matchVacancies()
    ↓
Sistem Cocokkan Qualification vs Vacancy
    ↓
Create ApplicantRecommendation Records
    ↓
Success Message ke Admin
```

### 3. Automatic Matching Algorithm

```
New Applicant Added/Updated
    ↓
Get all active Vacancies
    ↓
For each Vacancy:
    ├─ Get Qualification untuk vacancy
    ├─ Check:
    │  ├─ Status Vaksinasi Match?
    │  ├─ Status Pernikahan Match?
    │  ├─ Jenis Kelamin Match?
    │  ├─ Usia dalam range (min-max)?
    │  ├─ Pendidikan >= min requirement?
    │  ├─ Jurusan relevan?
    │  ├─ Pengalaman kerja sufficient?
    │  ├─ Skill teknis match?
    │  └─ Skill non-teknis match?
    │
    └─ If ALL match → Create ApplicantRecommendation
         Else → No recommendation untuk vacancy ini

Result: ApplicantRecommendation records dengan matching vacancies
```

### 4. Flow Archive Pelamar

```
Admin Click "Archive" Pelamar
    ↓
Update Applicant.deleted_at (soft delete)
    ↓
Create Archive Record (referensi ke applicant_id)
    ↓
Pelamar tidak muncul di list aktif
    ↓
Archive tersimpan di tabel archives
```

### 5. Flow Export Pelamar untuk Vacancy

```
Admin Request Export untuk Vacancy X
    ↓
System Query Applicants yang recommend untuk Vacancy X
    ↓
Filter dari ApplicantRecommendation table
    ↓
Use ApplicantsExport class (Maatwebsite Excel)
    ↓
Generate Excel File
    ↓
Download File ke Admin
```

### 6. Flow Ubah Password

```
Admin Input Current Password & New Password
    ↓
Controller Validasi
    ├─ Current password cocok?
    ├─ New password min 8 char?
    └─ Confirmation match?
    ↓
Update password di tabel admins
    ↓
Password di-hash dengan bcrypt
    ↓
Success Message
```

---

## FITUR UTAMA

### 1. **Automatic Candidate Matching**
- Sistem otomatis mencocokkan kualifikasi pelamar dengan requirements lowongan
- Menggunakan algoritma matching berbasis field-by-field comparison
- Menghasilkan ApplicantRecommendation untuk pelamar yang sesuai

### 2. **Soft Delete & Audit Trail**
- Menggunakan soft delete untuk data pelamar
- Maintains data integrity untuk audit
- Archive table untuk tracking riwayat

### 3. **Relationship Management**
- Complex relationships antara Applicant, Vacancy, Company, Qualification
- Many-to-many melalui ApplicantRecommendation
- Support untuk cascading operations

### 4. **Data Export**
- Export pelamar ke Excel per vacancy
- Menggunakan Maatwebsite/Excel package
- Custom export class ApplicantsExport

### 5. **Authentication & Authorization**
- Role-based access (Admin only)
- Session management
- Password reset dengan OTP
- CSRF protection untuk form submissions

### 6. **File Management**
- Storage dokumen/CV pelamar (via link)
- ApplicantFile table untuk tracking dokumen
- Integration dengan storage system

### 7. **Multi-level Status Management**
- Applicant status: active, rejected, approved
- Company status: active/inactive lowongan
- Vacancy status tracking

---

## INSTALASI & SETUP

### Prerequisites
- PHP >= 8.2
- MySQL >= 5.7
- Composer
- Node.js & npm

### Step-by-step Installation

#### 1. Clone Repository
```bash
git clone <repository>
cd backend_project_kel4
```

#### 2. Install PHP Dependencies
```bash
composer install
```

#### 3. Install JavaScript Dependencies
```bash
npm install
```

#### 4. Setup Environment File
```bash
cp .env.example .env
```

#### 5. Generate Application Key
```bash
php artisan key:generate
```

#### 6. Configure Database
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cipta_karir
DB_USERNAME=root
DB_PASSWORD=
```

#### 7. Run Migrations
```bash
php artisan migrate
```

#### 8. Seed Database (Optional)
```bash
php artisan db:seed
```

#### 9. Build Frontend Assets
```bash
npm run build
```

#### 10. Create Admin User (Manual)
Insert ke tabel admins:
```sql
INSERT INTO admins (username, password, created_at, updated_at) 
VALUES ('admin', '$2y$12$...hashedpassword...', NOW(), NOW());
```

Or via tinker:
```bash
php artisan tinker
App\Models\Admin::create(['username' => 'admin', 'password' => bcrypt('password')]);
```

#### 11. Start Development Server
```bash
php artisan serve
```

Access: http://localhost:8000

---

### Development Setup

#### Watch Frontend Changes
```bash
npm run dev
```

#### Access Tinker Console
```bash
php artisan tinker
```

#### Generate Test Data
```bash
php artisan db:seed
```

---

## TROUBLESHOOTING

### 1. **Database Connection Error**
```
Error: SQLSTATE[HY000] [2002] Connection refused
```

**Solution:**
- Pastikan MySQL server running
- Check `.env` database configuration
- Verify MySQL credentials

### 2. **Migration Issues**
```
Error: SQLSTATE[42S01]: Base table or view already exists
```

**Solution:**
```bash
php artisan migrate:refresh  # Rollback & re-run
php artisan migrate:reset    # Reset all migrations
```

### 3. **Permission Denied Storage**
```
Error: The storage directory is not writable
```

**Solution:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache  # For Linux
```

### 4. **Composer Autoload Issues**
```bash
composer dump-autoload
```

### 5. **NPM Build Issues**
```bash
rm -rf node_modules package-lock.json
npm install
npm run build
```

### 6. **CSRF Token Mismatch**
**Cause:** Form tidak include CSRF token

**Solution:** Ensure Blade forms include:
```blade
@csrf
```

### 7. **Session Not Working**
```bash
php artisan session:table
php artisan migrate
```

### 8. **Login Always Fails**
- Check admin exists di database
- Verify password hashed correctly
- Check session/cookie configuration in `.env`

### 9. **Export to Excel Not Working**
```bash
composer require maatwebsite/excel
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

### 10. **Cache Issues**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## FILE REFERENCES CHEATSHEET

### Key Controllers
- **Auth**: `app/Http/Controllers/AuthController.php`
- **Applicants**: `app/Http/Controllers/ApplicantController.php`
- **Companies**: `app/Http/Controllers/CompanyController.php`
- **Vacancies**: `app/Http/Controllers/VacancyController.php`
- **Dashboard**: `app/Http/Controllers/DashboardController.php`
- **Archive**: `app/Http/Controllers/ArchiveController.php`

### Key Models
- **Admin**: `app/Models/Admin.php`
- **Applicant**: `app/Models/Applicant.php`
- **Company**: `app/Models/Company.php`
- **Vacancy**: `app/Models/Vacancy.php`
- **Qualification**: `app/Models/Qualification.php`

### Routes
- **Web**: `routes/web.php`
- **Auth**: `routes/auth.php`

### Database
- **Migrations**: `database/migrations/`
- **Seeders**: `database/seeders/`

### Configuration
- **App**: `config/app.php`
- **Database**: `config/database.php`
- **Auth**: `config/auth.php`

---

## KESIMPULAN

Sistem Cipta Karir adalah aplikasi Laravel modern yang dirancang untuk memudahkan manajemen proses rekrutmen dan penempatan kerja. Dengan fitur automatic matching, sistem ini dapat merekomendasikan lowongan yang sesuai untuk setiap pelamar baru secara otomatis.

Dokumentasi ini mencakup seluruh aspek sistem dari database schema, model relationships, controllers, routes, hingga business logic. Untuk pertanyaan atau modifikasi lebih lanjut, silahkan referensi file-file spesifik yang telah disebutkan dalam dokumentasi ini.

---

**Terakhir Diupdate:** 30 Desember 2025  
**Versi Dokumentasi:** 1.0  
