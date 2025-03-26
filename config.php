<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Sesuaikan dengan username database
define('DB_PASS', '');     // Sesuaikan dengan password database
define('DB_NAME', 'todo_list');

// Menghubungkan ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set default timezone (Opsional)
date_default_timezone_set('Asia/Jakarta');

// Tampilkan error (Opsional - untuk debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mulai session
session_start();
?>