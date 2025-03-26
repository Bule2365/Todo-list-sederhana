<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = trim($_POST['task']);

    // Validasi input
    if (empty($task)) {
        setFlashMessage('danger', 'Task tidak boleh kosong!');
        header("Location: index.php");
        exit();
    } elseif (strlen($task) > 255) {
        setFlashMessage('danger', 'Task terlalu panjang! Maksimal 255 karakter.');
        header("Location: index.php");
        exit();
    }

    // Tambahkan tugas
    if (addTask($task)) {
        setFlashMessage('success', 'Task berhasil ditambahkan!');
    } else {
        setFlashMessage('danger', 'Gagal menambahkan task.');
    }
    header("Location: index.php");
    exit();
}
?>