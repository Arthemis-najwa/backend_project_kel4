
## Langkah-langkah Set up database
1. Buat database baru 

2. Import cipta_karir.sql

3. Sesuaikan file .env dengan database anda

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cipta_karir
DB_USERNAME=root
DB_PASSWORD=
```
4. Jalankan perintah berikut untuk membuat appkey :
```bash
php artisan key:generate
```
5. jalankan perintah berikut di direktori project
```bash
composer install
```
6. Akses melalui - http://127.0.0.1:8000

## Data Login Default
`username: Najwa Alya`
`password: najwa204`


## ✉️ Setup Fitur Ganti Password (WAJIB DILAKUKAN SEKALI)
1. Masuk ke database, buka tabel `admins` lalu ubah kolom email menjadi email aktif anda (atau bisa membuat data admins baru)

2. Daftarkan email tersebut pada website `Mailtrap.io`

3. Setelah login, klik tab `sandboxes` lalu klik `My Sandbox`

4. Klik `SMTP Settings` dan salin kredensialnya.

5. Buka file .env anda dan sesuaikan dengan kredensialnya

```bash
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=f5ead36fee4acb
MAIL_PASSWORD=5d69cdccde2682
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@yourapp.com
MAIL_FROM_NAME="Cipta Karir"
```

