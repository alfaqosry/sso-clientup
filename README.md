# alfaqosry/sso-clientup

Package Laravel untuk integrasi Single Sign-On (SSO).

---

## 📦 Instalasi

1. Pastikan Composer sudah terupdate:

```bash
composer self-update
```

2. Install package via Composer:

```bash
composer require alfaqosry/sso-clientup:^1.0
```

3. (Opsional) Publish konfigurasi package jika ada:

```bash
php artisan vendor:publish --provider="Alfaqosry\SsoClientup\SsoClientupServiceProvider"
```

4. Cek file konfigurasi di `config/sso-clientup.php` (jika ada) dan sesuaikan dengan kebutuhan.

---

## 🛠️ Konfigurasi

Tambahkan konfigurasi di `.env` jika package membutuhkan:

```env
SSO_URL=https://sso.example.com
SSO_CLIENT_ID=your_client_id
SSO_CLIENT_SECRET=your_client_secret
```

---

## 🚀 Cara Penggunaan

### 1. Menggunakan class utama

```php
use Alfaqosry\SsoClientup\SsoClient;

$sso = new SsoClient();

// Login user
$response = $sso->login('username', 'password');

if ($response->success) {
    echo "Login berhasil!";
} else {
    echo "Login gagal: " . $response->message;
}
```

### 2. Mengambil data user setelah login

```php
$userData = $sso->getUserData();

echo "Nama: " . $userData->nama;
echo "Email: " . $userData->email;
```

---

## 📌 Contoh Route / Controller di Laravel

```php
Route::get('/test-sso', function() {
    $sso = new \Alfaqosry\SsoClientup\SsoClient();
    $result = $sso->login('testuser', 'testpass');

    dd($result);
});
```

---

## ⚙️ Notes

* Pastikan namespace PSR-4 sesuai dengan `composer.json` package.
* Package sudah support **auto-discovery** Laravel, tidak perlu register manual provider kecuali package tidak mendukung auto-discovery.
* Gunakan **Personal Access Token** jika package mengakses repo GitHub privat.

---

## 📄 Lisensi

MIT License
