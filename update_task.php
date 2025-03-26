<?php
session_start();
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = intval($_POST['id']);
    $task = trim($_POST['task']);
    $status = $_POST['status'];

    // Validasi input
    if (empty($task)) {
        setFlashMessage('danger', 'Task tidak boleh kosong!');
        header("Location: index.php");
        exit();
    }

    // Validasi status hanya boleh 'pending' atau 'completed'
    if (!in_array($status, ['pending', 'completed'])) {
        setFlashMessage('danger', 'Status tidak valid.');
        header("Location: index.php");
        exit();
    }

    // Update status di database
    if (updateTask($id, $task, $status)) {
        setFlashMessage('success', 'Task berhasil diperbarui!');
    } else {
        setFlashMessage('danger', 'Gagal memperbarui task.');
    }

    // Redirect kembali ke index
    header("Location: index.php");
    exit();
} else {
    setFlashMessage('danger', 'Akses tidak valid.');
    header("Location: index.php");
    exit();
}
?>