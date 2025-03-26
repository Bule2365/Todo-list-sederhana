<?php
include 'includes/db.php';
include 'includes/functions.php';
include 'views/header.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $task = getTaskById($id);

    if (!$task) {
        setFlashMessage('danger', 'Task tidak ditemukan!');
        header("Location: index.php");
        exit();
    }
} else {
    setFlashMessage('danger', 'ID Task tidak valid!');
    header("Location: index.php");
    exit();
}
?>

<h2>Edit Task</h2>

<!-- Flash Message -->
<?php displayFlashMessage(); ?>

<form action="update_task.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="mb-3">
        <label class="form-label">Task</label>
        <input type="text" name="task" class="form-control"
            value="<?= htmlspecialchars($task['task'], ENT_QUOTES, 'UTF-8'); ?>" required maxlength="255">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="pending" <?= ($task['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
            <option value="completed" <?= ($task['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
        </select>
    </div>
    <button type="submit" name="update" class="btn btn-success">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

<?php include 'views/footer.php'; ?>