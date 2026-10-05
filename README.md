# data-sensor-web

Aplikasi web **SensorData** (Laravel) untuk monitoring data sensor **V4** dan **S3**: dashboard real-time, halaman sensor per tipe, dan grafik historis.

## Persyaratan

- PHP 8.x
- Composer
- MySQL / MariaDB (atau sesuai konfigurasi `.env`)

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Salin dan sesuaikan `.env` (koneksi database, dll.) sebelum menjalankan migrasi.

## Lisensi

Proyek aplikasi berbasis Laravel; framework Laravel dilisensikan MIT.
