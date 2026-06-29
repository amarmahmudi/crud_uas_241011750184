# Aplikasi CRUD Data Pemain Olahraga (UAS)

Aplikasi ini merupakan sistem manajemen (CRUD) data pemain olahraga yang dikembangkan menggunakan **Laravel 11** dan database **MySQL**. Aplikasi ini juga telah dideploy secara live dan dapat diakses langsung secara online.

---

## 🔗 Link Demo Aplikasi (Live on Vercel)
Website dapat diakses secara langsung tanpa instalasi lokal di:
👉 **[https://cruduas241011750184.vercel.app](https://cruduas241011750184.vercel.app)**

### 🔑 Kredensial Login Admin
Untuk mengakses fitur admin (Dashboard, Tambah, Edit, Hapus, Export PDF):
*   **Username / Email:** `admin` atau `admin@example.com`
*   **Password:** `admin123`

---

## 🛠️ Panduan Menjalankan Aplikasi di Localhost

Jika ingin menjalankan aplikasi ini di komputer lokal (misalnya menggunakan Laragon/XAMPP), ikuti langkah-langkah di bawah ini:

### 1. Prasyarat (Prerequisites)
Pastikan komputer Anda sudah terinstall:
*   PHP >= 8.2
*   Composer
*   MySQL Server (bisa lewat Laragon/XAMPP)
*   Git

### 2. Langkah Instalasi

1.  **Clone Repository:**
    ```bash
    git clone https://github.com/amarmahmudi/crud_uas_241011750184.git
    cd crud_uas_241011750184
    ```

2.  **Install Dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Salin File Environment Configuration:**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    copy .env.example .env
    ```

4.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database:**
    Buka file `.env` di text editor Anda, lalu sesuaikan bagian database sesuai setting MySQL lokal Anda. Contoh (untuk Laragon/XAMPP default):
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_uas_241011750184
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *Catatan: Pastikan Anda sudah membuat database kosong bernama `db_uas_241011750184` di MySQL lokal.*

6.  **Jalankan Migrasi & Database Seeder:**
    Perintah ini akan membuat tabel dan mengisi data atlet dummy awal:
    ```bash
    php artisan migrate --seed
    ```

7.  **Jalankan Storage Link:**
    Untuk memastikan gambar profil atlet dapat diakses secara lokal:
    ```bash
    php artisan storage:link
    ```

8.  **Jalankan Server Lokal:**
    ```bash
    php artisan serve
    ```
    Buka peramban (browser) dan akses **`http://127.0.0.1:8000`**.

---

## 📂 Fitur Utama Aplikasi
1.  **Halaman Utama Publik:** Menampilkan list kartu (cards) profil atlet yang rapi dan terurut berdasarkan ID (`id_pemain`).
2.  **Detail Atlet:** Menampilkan spesifikasi data lengkap atlet beserta jersey dan posisinya.
3.  **Autentikasi Admin:** Login & logout aman untuk admin.
4.  **Dashboard Admin:** Tabel interaktif manajemen data atlet (Create, Read, Update, Delete) yang responsif dengan Dark Mode.
5.  **Validasi Form:** Validasi data input form pemain yang ketat (misal: ID Pemain harus diawali `#` diikuti 4 digit angka).
6.  **Export PDF:** Tombol cetak PDF instan untuk seluruh data pemain dengan layout formal dan rapi.
