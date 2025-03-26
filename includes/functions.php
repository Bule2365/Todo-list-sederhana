<?php
session_start();
require_once 'db.php';

// Fungsi untuk menambahkan pesan flash
function setFlashMessage($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

// Fungsi untuk menampilkan pesan flash
function displayFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $flash = $_SESSION['flash_message'];
        echo '<div class="alert alert-' . htmlspecialchars($flash['type']) . '">' . htmlspecialchars($flash['message']) . '</div>';
        unset($_SESSION['flash_message']); // Hapus pesan setelah ditampilkan
    }
}

// Fungsi untuk mendapatkan semua tugas
function getAllTasks($filter = 'all') {
    $conn = getConnection();
    if (!$conn) {
        die("Database connection error!");
    }

    if ($filter !== 'all') {
        $sql = "SELECT * FROM tasks WHERE status = ? ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Query preparation failed: " . $conn->error);
        }
        $stmt->bind_param('s', $filter);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    } else {
        $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
        $result = $conn->query($sql);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $result = $result->fetch_all(MYSQLI_ASSOC);
    }
    return $result;
}

// Fungsi untuk menambahkan tugas
function addTask($task) {
    $conn = getConnection();
    $status = 'pending';
    $stmt = $conn->prepare("INSERT INTO tasks (task, status) VALUES (?, ?)");
    $stmt->bind_param('ss', $task, $status);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

// Fungsi untuk menghapus tugas
function deleteTask($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

// Fungsi untuk mendapatkan detail tugas
function getTaskById($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $result;
}

// Fungsi untuk memperbarui tugas
function updateTask($id, $task, $status) {
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE tasks SET task = ?, status = ? WHERE id = ?");
    $stmt->bind_param('ssi', $task, $status, $id);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}
?>