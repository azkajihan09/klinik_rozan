# CI4 mLITE SIMRS Full Starter

Starter aplikasi SIMRS berbasis **CodeIgniter 4** dari database `mlite_db.sql`.

## Modul tersedia

- Login dari tabel `mlite_users`
- Dashboard
- Pasien
- Registrasi / `reg_periksa`
- Rawat Jalan / `pemeriksaan_ralan`
- IGD / Triase
- Rawat Inap
- Laboratorium
- Radiologi
- Hasil Radiologi
- Operasi
- Farmasi / Resep
- Billing / Kasir
- BPJS / SEP
- Rekam Medis / Berkas Digital
- Inventory / Stok Gudang
- Master Dokter, Poli, Bangsal, Kamar, Penjamin, Obat
- User & Role

## Cara instalasi

```bash
composer install
cp env.example .env
php spark serve
```

Import database:

```bash
mysql -u root -p -e "CREATE DATABASE mlite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p mlite < database/mlite_db.sql
```

Edit `.env`:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = mlite
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

## Membuat user admin awal

Jika tabel `mlite_users` kosong, buat admin manual:

```sql
INSERT INTO mlite_users (username, fullname, password, email, role, access)
VALUES ('admin', 'Administrator', '$2y$10$k7u2dGXcz4CUBCAfZSP5ReE6YTX/OQRkVAMgoMEsim7hLxy3P9q5W', 'admin@example.com', 'admin', 'all');
```

Password untuk hash di atas: `admin123`.

## Catatan teknis

Paket ini adalah **starter full module**, bukan aplikasi production final. CRUD dibuat generik agar cepat berjalan di CI4, lalu bisa diperdalam menjadi workflow rumah sakit yang lebih ketat.

Prioritas pengembangan berikutnya:

1. Validasi field sesuai constraint tiap tabel.
2. Dropdown relasi, misalnya dokter, poli, pasien, penjamin, kamar, obat.
3. Permission detail berdasarkan `mlite_crud_permissions`.
4. Perhitungan billing otomatis dari tindakan, obat, kamar, lab, radiologi, dan operasi.
5. Integrasi BPJS VClaim / Aplicare / PCare dengan credential asli.
6. Upload berkas digital menggunakan Storage CI4.
7. Audit log dan hardening keamanan.

## Struktur penting

```text
app/Config/SimrsModules.php   Konfigurasi tabel, field, list, search
app/Controllers/Module.php    Generic CRUD controller
app/Models/GenericModel.php   Generic model CI4
app/Views/crud/*              View list dan form generik
```

Untuk menambah modul baru, cukup tambahkan entry ke `app/Config/SimrsModules.php`.
