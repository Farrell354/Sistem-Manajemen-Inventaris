# 📦 Warehouse Management System (Sistem Manajemen Gudang & Logistik)

Aplikasi berbasis web untuk manajemen inventaris gudang, pencatatan peminjaman barang, dan pusat laporan audit logistik. Aplikasi ini dibangun menggunakan framework **Laravel 11**, **Tailwind CSS**, dan **Vite**, serta dilengkapi dengan fitur dynamic **Dark Mode / Light Mode** yang persisten.

---

## ✨ Fitur Utama

- **📊 Dashboard Analytics**: Didukung oleh **Chart.js** untuk menampilkan grafik tren peminjaman barang tahunan secara real-time, statistik total jenis barang, stok tersedia, serta barang yang sedang dipinjam.
- **🚨 Real-time Stock Alert**: Peringatan otomatis di halaman dashboard jika terdapat item logistik yang stoknya menipis ($\le$ 5 unit).
- **📦 Master Data Barang**: Manajemen penuh (CRUD) data aset inventaris gudang, kategori barang, penempatan lokasi rak penyimpanan, kondisi fisik barang, beserta unggah foto/gambar barang.
- **🤝 Modul Peminjaman (Borrowing Management)**: Pencatatan otomatis barang keluar/masuk dengan validasi stok real-time untuk mencegah *overselling* atau *over-borrowing*.
- **📈 Pusat Laporan Audit**: Fitur rekapitulasi data dengan filter rentang tanggal (*date-range picker*) dan jenis laporan operasional.
- **🖨️ Export Dokumen**: Mendukung pencetakan dokumen laporan gudang langsung ke format **PDF** (menggunakan DomPDF) dan **Excel**.
- **👥 Kelola Pengguna (Role-based Access Control)**: Pembagian hak akses akun pegawai yang aman menggunakan level otorisasi:
  - `Super Admin` (Manajemen penuh sistem & pegawai)
  - `Manager` (Audit, rekapitulasi, dan laporan)
  - `Staff Gudang` (Operasional harian & sirkulasi barang)
- **🌙 Dynamic Light/Dark Mode Switcher**: Transisi visual tema gelap-terang yang mulus, terintegrasi dengan Tailwind CSS, dan tersimpan otomatis di browser (`localStorage`).

---

## 🛠️ Spesifikasi Teknologi

- **Backend Framework:** Laravel 11.x
- **Frontend Tools:** Tailwind CSS, Alpine.js, Vite
- **Database:** MySQL / MariaDB
- **Libraries & Packages:**
  - Chart.js (Visualisasi Grafik)
  - Barryvdh Laravel DomPDF (Generator Dokumen PDF)

---

## 🚀 Langkah Instalasi & Menjalankan Proyek

Pastikan Anda sudah menginstal **PHP ($\ge$ 8.2)**, **Composer**, **Node.js**, dan **NPM** di perangkat Anda sebelum memulai.

### 1. Klon Repositori
```bash
git clone https://github.com/Farrell354/Sistem-Manajemen-Inventaris.git
cd nama-repo-kamu

composer install

npm install

cp .env.example .env

Buka file .env baru tersebut, lalu sesuaikan konfigurasi database Anda:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_gudang_kamu
DB_USERNAME=root
DB_PASSWORD=

Generate Application Key
php artisan key:generate

Jalankan Migrasi Database & Seeder
php artisan migrate --seed

Hubungkan Storage Link
php artisan storage:link

Jalankan Aplikasi
php artisan serve
npm run dev


🔒 Hak Akses Uji Coba (Default Akun)
Super Admin: admin@telkomsel.com (Password: 11223344)
Manager: farel@example.com (Password: 11223344)
Staff: mario@example.com (Password: 11223344)
