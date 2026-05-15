# PENJELASAN PROJECT LARAVEL

## PETSHOP MARKET – Sistem Jual Beli Hewan Berbasis Web

### Disusun Oleh:

**Nama:** CALVIN UMARDI
**NIM:** 162023044

---

# Deskripsi Project

Project ini merupakan aplikasi berbasis web yang dibuat menggunakan framework Laravel dengan studi kasus sistem jual beli hewan peliharaan bernama **PetShop Market**.

Aplikasi ini dirancang untuk membantu proses pengelolaan data hewan serta memberikan kemudahan bagi user dalam melihat, mencari, membeli, dan menyimpan hewan favorit ke wishlist.

Project ini dibuat untuk memenuhi tugas mata kuliah Sistem Informasi Berbasis Web dengan menerapkan konsep:

* CRUD Laravel
* Authentication Laravel Breeze
* Middleware
* Upload Gambar
* Role Management
* Blade Template
* Storage Laravel

---

# Tujuan Project

Tujuan dibuatnya aplikasi ini adalah:

1. Memahami penggunaan framework Laravel.
2. Menerapkan sistem autentikasi login dan register.
3. Mengimplementasikan fitur CRUD.
4. Menggunakan middleware untuk pembatasan akses.
5. Membuat sistem role Admin dan User.
6. Mengelola upload gambar menggunakan Laravel Storage.
7. Membuat tampilan website yang interaktif dan responsif.

---

# Teknologi Yang Digunakan

* Laravel
* PHP
* MySQL
* Bootstrap 5
* Laravel Breeze
* Blade Template

---

# Fitur Utama Sistem

## 1. Authentication

Sistem memiliki fitur:

* Login
* Register
* Logout

Authentication dibuat menggunakan Laravel Breeze.

---

## 2. Role Management

Terdapat 2 role pada sistem:

### Admin

Admin memiliki akses:

* Menambah data hewan
* Mengedit data hewan
* Menghapus data hewan
* Mengelola data produk

### User

User hanya dapat:

* Melihat data hewan
* Melihat detail hewan
* Menambahkan wishlist
* Membeli hewan

---

# 3. CRUD Data Hewan

Fitur CRUD meliputi:

* Create
* Read
* Update
* Delete

Data hewan yang dikelola:

* Nama hewan
* Jenis hewan
* Umur
* Harga
* Deskripsi
* Gambar hewan

---

# 4. Upload Gambar

Sistem mendukung upload gambar hewan menggunakan Laravel Storage sehingga gambar dapat tersimpan dan ditampilkan pada website.

---

# 5. Search Hewan

User dapat mencari hewan berdasarkan:

* Nama hewan
* Jenis hewan

Fitur ini memudahkan user dalam menemukan hewan yang diinginkan.

---

# 6. Wishlist

User dapat menyimpan hewan favorit ke wishlist sehingga dapat dilihat kembali nanti.

---

# 7. Pembelian Hewan

Sistem menyediakan tombol beli sehingga user dapat melakukan simulasi pembelian hewan secara langsung.

---

# Struktur Halaman

## Halaman Home

Menampilkan:

* Banner utama
* Daftar hewan
* Harga hewan
* Tombol detail
* Wishlist
* Tombol beli

## Dashboard

Menampilkan:

* Total hewan
* Total user
* Role user

## Halaman Data Hewan

Menampilkan seluruh data hewan dalam bentuk tabel.

## Halaman Detail

Menampilkan detail lengkap hewan.

---

# Kesimpulan

Project PetShop Market berhasil dibuat menggunakan Laravel dengan menerapkan konsep fullstack web development seperti authentication, CRUD, middleware, upload gambar, dan role management.

Sistem ini diharapkan dapat membantu pengguna dalam proses jual beli hewan secara lebih mudah, modern, dan terstruktur.
