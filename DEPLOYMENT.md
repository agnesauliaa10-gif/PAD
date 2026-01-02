# Panduan Deployment Gratis untuk Portfolio (Laravel)

Ini adalah panduan untuk men-deploy aplikasi Warehouse System secara gratis agar bisa dipajang di portfolio.

## 1. Persiapan Database (TiDB Cloud - MySQL Gratis)
Layanan gratis biasanya tidak menyediakan database di server yang sama, atau jika ada (seperti Render PostgreSQL), datanya akan hilang setelah 90 hari. **TiDB Cloud** memberikan database MySQL Serverless gratis seumur hidup (hingga 5GB).

1. Buka [TiDB Cloud](https://tidbcloud.com/) dan daftar.
2. Buat Cluster baru: "Serverless Tier" (Free).
3. Setelah jadi, klik "Connect" untuk mendapatkan kredensial:
   - **Host**
   - **Port** (biasanya 4000)
   - **Username**
   - **Password**
   - **Database Name**
4. Simpan data ini, kita akan memakainya nanti.

## 2. Upload Kode ke GitHub
Pastikan project ini sudah ada di repository GitHub kamu.

1. Buat repository baru di GitHub.
2. Push source code kamu:
   ```bash
   git init
   git add .
   git commit -m "First commit"
   git branch -M main
   git remote add origin https://github.com/USERNAME/NAMAREPO.git
   git push -u origin main
   ```

## 3. Deployment ke Render.com
Render adalah alternatif Heroku yang memiliki free tier cukup bagus.

1. Daftar di [Render.com](https://render.com/).
2. Klik **New +** -> **Web Service**.
3. Hubungkan akun GitHub kamu dan pilih repository project ini.
4. Setting konfigurasi:
   - **Name**: (bebas, misal: `warehouse-portfolio`)
   - **Region**: Singapore (biar dekat) kalau ada, atau US.
   - **Branch**: `main`
   - **Root Directory**: (kosongkan)
   - **Runtime**: `PHP`
   - **Build Command**: `composer install --no-dev --optimize-autoloader && npm install && npm run build`
   - **Start Command**: `php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT`
   
   *Catatan: Start command di atas menggunakan `php artisan serve` yang cukup untuk traffic portfolio kecil. Untuk production serius biasanya pakai Nginx/Apache, tapi setup-nya lebih rumit.*

5. **Environment Variables** (Wajib Diisi):
   Scroll ke bawah ke bagian "Environment Variables" dan masukkan data dari file `.env` dan Database TiDB tadi:

   | Key | Value |
   | --- | --- |
   | `APP_NAME` | `WMS Portfolio` |
   | `APP_ENV` | `production` |
   | `APP_KEY` | (Copy dari .env lokal kamu atau generate baru) |
   | `APP_DEBUG` | `false` |
   | `APP_URL` | `https://nama-web-service-kamu.onrender.com` (isi nanti setelah URL jadi) |
   | `DB_CONNECTION` | `mysql` |
   | `DB_HOST` | (Host dari TiDB) |
   | `DB_PORT` | `4000` |
   | `DB_DATABASE` | (Nama DB TiDB) |
   | `DB_USERNAME` | (User TiDB) |
   | `DB_PASSWORD` | (Pass TiDB) |
   | `DB_SSL_MODE` | `verify_identity` (Penting untuk TiDB) |
   | `BROADCAST_DRIVER` | `log` |
   | `CACHE_DRIVER` | `file` |
   | `FILESYSTEM_DISK` | `local` (Lihat catatan di bawah tentang gambar!) |
   | `QUEUE_CONNECTION` | `sync` |
   | `SESSION_DRIVER` | `cookie` atau `file` |

6. Klik **Create Web Service**.

## 4. Masalah Gambar (PENTING!)
Pada layanan gratis seperti Render, file yang diupload (gambar produk) ke folder `storage` **AKAN HILANG** setiap kali kamu melakukan deploy ulang atau server restart (karena sistem filenya *ephemeral*).

Untuk Portfolio yang professional, solusi terbaiknya adalah menggunakan **Cloudinary** (Gratis).

**Cara Setup Cloudinary di Laravel:**

1. Daftar di [Cloudinary](https://cloudinary.com/).
2. Ambil `Cloud Name`, `API Key`, dan `API Secret`.
3. Di project lokal, install package:
   ```bash
   composer require cloudinary-labs/cloudinary-laravel
   ```
4. Ubah di kode `ProductController` dll untuk upload ke Cloudinary, atau gunakan filesystem driver Cloudinary.

**Cara Cepat (Tanpa Cloudinary - Resiko Gambar Hilang):**
Jika hanya untuk demo sesaat, kamu bisa tetap pakai `local` storage. Tapi kamu perlu menjalankan perintah ini di "Start Command" Render agar link storage terbuat setiap deploy:
`php artisan storage:link && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT`

## 5. Testing
Tunggu proses build di Render selesai (mungkin 5-10 menit). Jika sukses, kamu akan mendapatkan URL `.onrender.com`.

Buka URL tersebut, dan Voila! Warehouse System kamu sudah online.

---
**Tips Portfolio:**
- Di deskripsi portfolio, tuliskan *Tech Stack*: Laravel 11, Tailwind CSS, Alpine.js, MySQL (TiDB), Render Cloud.
- Sebutkan fitur-fitur utama: Real-time Stock Calculation, Inbound/Outbound Tracking, Mobile Responsive Landing Page.
