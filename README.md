# Sistem Pakar Rekomendasi Obat Pertanian pada Tanaman Cabai

Aplikasi web berbasis Laravel untuk membantu petani mengidentifikasi
kemungkinan penyakit pada tanaman cabai berdasarkan gejala yang dipilih,
kemudian memberikan rekomendasi obat pertanian berdasarkan hasil
perhitungan sistem.

Proyek ini dikembangkan sebagai tugas akhir Program Studi Teknik
Informatika di Politeknik Negeri Jember sekaligus sebagai portofolio
pengembangan backend.

## Gambaran Proyek

Sistem menggabungkan dua pendekatan:

1.  **Rule-Based dengan Forward Chaining** --- mencocokkan gejala yang
    dipilih pengguna dengan aturan pengetahuan untuk memperoleh kandidat
    penyakit.
2.  **Weighted Product (WP)** --- menghitung nilai preferensi kandidat
    berdasarkan bobot gejala dan hasil pencocokan, lalu mengurutkan
    hasil rekomendasi.

Pemisahan kedua proses tersebut membantu menjaga alur diagnosis tetap
terstruktur: aturan digunakan untuk menentukan kandidat, sedangkan
Weighted Product digunakan untuk melakukan pemeringkatan.

## Fitur Utama

### Pengguna / Petani

-   Registrasi dan login.
-   Melakukan diagnosis berdasarkan gejala tanaman cabai.
-   Melihat hasil diagnosis dan rekomendasi yang dihasilkan sistem.
-   Melihat riwayat diagnosis.
-   Mengelola informasi profil.

### Administrator

-   Mengelola data penyakit.
-   Mengelola data gejala.
-   Mengelola data obat pertanian.
-   Mengelola aturan dan basis pengetahuan.
-   Melihat data diagnosis.

### Autentikasi

-   Login dan registrasi pengguna.
-   Fitur lupa kata sandi dan reset kata sandi.
-   Pemisahan akses berdasarkan peran pengguna.

> Ketersediaan pengiriman email untuk reset kata sandi bergantung pada
> konfigurasi mail di lingkungan aplikasi.

## Teknologi

  Area                    Teknologi
  ----------------------- ------------------------------
  Backend                 PHP, Laravel 12
  Database                MySQL
  Frontend                Blade, HTML, CSS, JavaScript
  Styling UI              Tailwind CSS dan CSS
  Dependency management   Composer, npm
  Version control         Git, GitHub

## Alur Diagnosis

1.  Pengguna memilih gejala yang ditemukan pada tanaman cabai.
2.  Sistem memeriksa kecocokan gejala dengan aturan pengetahuan
    menggunakan Rule-Based dan Forward Chaining.
3.  Sistem memperoleh kandidat penyakit berdasarkan aturan yang
    terpenuhi.
4.  Kandidat diproses menggunakan metode Weighted Product untuk
    memperoleh nilai preferensi.
5.  Sistem menampilkan hasil diagnosis dan rekomendasi obat pertanian
    sesuai data yang tersedia pada aplikasi.

### Ringkasan Basis Pengetahuan

Basis pengetahuan pada penelitian ini disusun berdasarkan data yang
dikumpulkan bersama narasumber ahli.

-   **5** penyakit
-   **10** gejala
-   **15** aturan

Nilai dan hasil diagnosis bergantung pada aturan, bobot, serta data yang
tersimpan dalam aplikasi. Sistem ini merupakan alat bantu rekomendasi,
bukan pengganti pemeriksaan langsung oleh ahli pertanian.

## Persyaratan

Pastikan perangkat pengembangan sudah memiliki:

-   PHP 8.2 atau versi yang kompatibel dengan dependensi proyek.
-   Composer.
-   MySQL.
-   Node.js dan npm.
-   Git.

## Instalasi Lokal

### 1. Clone repository

``` bash
git clone https://github.com/renshu25/sistem-pakar-cabai.git
cd sistem-pakar-cabai
```

### 2. Instal dependensi PHP

``` bash
composer install
```

### 3. Siapkan file environment

Salin `.env.example` menjadi `.env`.

Windows PowerShell:

``` powershell
Copy-Item .env.example .env
```

Linux/macOS:

``` bash
cp .env.example .env
```

Buat application key:

``` bash
php artisan key:generate
```

### 4. Konfigurasikan database

Buat database MySQL baru, kemudian sesuaikan konfigurasi berikut di file
`.env`:

``` dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistempakarcabai
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama database, username, dan password dengan konfigurasi
lokal. Jangan mengunggah file `.env` atau kredensial asli ke repository.

### 5. Jalankan migration dan seeder

``` bash
php artisan migrate --seed
```

Perintah ini membuat tabel dan menjalankan seeder yang tersedia.
Jalankan pada database pengembangan yang baru disiapkan, bukan pada
database yang berisi data penting.

### 6. Instal dan build aset frontend

``` bash
npm install
npm run build
```

### 7. Jalankan aplikasi

``` bash
php artisan serve
```

Buka alamat lokal yang ditampilkan oleh Artisan di browser.

> **Catatan:** Petunjuk instalasi ini perlu diuji kembali pada clone
> bersih sebelum dianggap tervalidasi. Jika migration atau seeder
> mengalami error, periksa pesan error dan konfigurasi database terlebih
> dahulu.

## Struktur Backend

Beberapa direktori utama yang digunakan dalam aplikasi Laravel:

``` text
app/
├── Http/
│   └── Controllers/
│       ├── Admin/       # Pengelolaan data oleh administrator
│       ├── Auth/        # Autentikasi dan pemulihan kata sandi
│       └── User/        # Diagnosis, profil, dan riwayat pengguna
├── Models/              # Model dan relasi data
└── Services/
    └── DiagnosaService.php  # Logika proses diagnosis
database/
├── migrations/          # Definisi struktur database
└── seeders/             # Data awal aplikasi
resources/
└── views/               # Tampilan Blade
routes/
└── web.php              # Rute aplikasi web
```

## Fokus Implementasi Backend

-   Mengembangkan alur diagnosis yang memisahkan pencocokan aturan dan
    pemeringkatan hasil.
-   Mengelola data penyakit, gejala, obat, dan basis pengetahuan.
-   Menggunakan model dan relasi untuk menghubungkan data diagnosis.
-   Mengatur rute dan controller untuk fitur administrator dan pengguna.
-   Menyediakan riwayat diagnosis serta pengelolaan profil.
-   Menyiapkan alur autentikasi termasuk pemulihan kata sandi.

## Pengembangan Berikutnya

-   Menambahkan automated test untuk aturan diagnosis dan perhitungan
    Weighted Product.
-   Menambahkan dokumentasi contoh input, bobot, dan perhitungan hasil
    secara terperinci.
-   Menambahkan screenshot antarmuka dan demonstrasi alur diagnosis.
-   Memvalidasi instalasi dari clone bersih dan melengkapi panduan
    konfigurasi email.
-   Meninjau kembali konsistensi migration agar instalasi baru dapat
    direproduksi dengan mudah.

## Batasan

Hasil rekomendasi dipengaruhi oleh kelengkapan basis pengetahuan, bobot
gejala, dan aturan yang digunakan. Pengguna sebaiknya mengonfirmasi
penanganan penyakit tanaman dengan ahli pertanian, terutama sebelum
menggunakan obat atau pestisida.

## Kontribusi dan Lisensi

Repository ini dipublikasikan untuk dokumentasi proyek dan portofolio.
Jika ingin menggunakan, mengadaptasi, atau mendistribusikan ulang kode,
periksa ketentuan lisensi proyek dan atribusi yang berlaku.
