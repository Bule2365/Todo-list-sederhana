# ✅ To-Do List - PHP & MySQL Task Manager

Sebuah aplikasi manajemen tugas sederhana berbasis **PHP & MySQL** dengan fitur CRUD, filtering tugas, konfirmasi modal yang interaktif, serta mode gelap dan terang yang dapat disesuaikan.

---

## 🚀 Fitur Utama
- **CRUD Lengkap**: Tambah, Edit, Hapus, dan Perbarui tugas.
- **Status Tugas**: Tandai tugas sebagai "Selesai" atau "Belum Selesai".
- **Filter Tugas**: Pilih untuk menampilkan semua tugas, hanya yang selesai, atau hanya yang belum selesai.
- **Flash Messages**: Notifikasi dinamis untuk umpan balik pengguna.
- **Konfirmasi Modal**: Popup interaktif untuk memastikan aksi pengguna.
- **Dark & Light Mode**: Mode tampilan yang bisa diubah sesuai preferensi pengguna dengan **localStorage**.
- **Desain Responsif**: Antarmuka modern dengan **Bootstrap**.

---

## 📂 Struktur Direktori
```plaintext
📁 includes/       → Koneksi database & fungsi utama
📁 views/          → Header, footer, dan elemen UI lainnya
📁 assets/         → Styles.css & Scripts.js untuk tampilan dan interaksi
📁 sql/            → Skrip SQL untuk pembuatan database
index.php         → Halaman utama untuk menampilkan daftar tugas
tambah_task.php   → Menambahkan tugas baru
edit_task.php     → Mengedit tugas yang sudah ada
update_task.php   → Memperbarui status tugas
delete_task.php   → Menghapus tugas
```

---

## 🔧 Instalasi & Konfigurasi
1. **Clone Repository**
   ```bash
   git clone https://github.com/username/todo-list.git
   cd todo-list
   ```

2. **Konfigurasi Database**
   - Buat database baru di **phpMyAdmin** dengan nama `todo_list`.
   - Import file `database.sql` yang tersedia di folder `sql/`.

3. **Sesuaikan Konfigurasi di `includes/db.php`**
   ```php
   $host = 'localhost';
   $dbname = 'todo_list';
   $username = 'root';
   $password = '';
   ```

4. **Jalankan di Browser**
   Buka `http://localhost/todo-list/` atau `http://localhost:8080/todo-list` di browser untuk mulai menggunakan aplikasi.

---

## 📸 Tampilan Aplikasi
![Screenshot](assets/Screenshot%20(248).png)
![Screenshot](assets/Screenshot%20(249).png)
![Screenshot](assets/Screenshot%20(250).png)

---

## 🤝 Kontribusi
Pull request sangat dipersilakan! Pastikan kode tetap bersih, terdokumentasi, dan mengikuti standar yang sudah ada. 🚀

---

## 📜 Lisensi
Proyek ini berlisensi **MIT License** - silakan gunakan, modifikasi, dan kembangkan sesuai kebutuhan Anda!

---
