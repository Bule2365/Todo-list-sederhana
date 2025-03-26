<?php
include 'includes/db.php';
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus tugas
    if (deleteTask($id)) {
        setFlashMessage('success', 'Task berhasil dihapus!');
    } else {
        setFlashMessage('danger', 'Gagal menghapus task.');
    }
    header("Location: index.php");
    exit();
}
?>