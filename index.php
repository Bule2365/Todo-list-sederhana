<?php
include 'includes/db.php';
include 'includes/functions.php';
include 'views/header.php';

// Ambil nilai filter dari URL (default: 'all')
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Dapatkan daftar tugas berdasarkan filter
$tasks = getAllTasks($filter);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">To-Do List</h2>

    <!-- Flash Message -->
    <?php displayFlashMessage(); ?>

    <!-- Filter Form -->
    <form action="index.php" method="GET" class="mb-4">
        <div class="d-flex justify-content-center">
            <select name="filter" class="form-select w-auto" onchange="this.form.submit()">
                <option value="all" <?= ($filter == 'all') ? 'selected' : '' ?>>Semua</option>
                <option value="completed" <?= ($filter == 'completed') ? 'selected' : '' ?>>Selesai</option>
                <option value="pending" <?= ($filter == 'pending') ? 'selected' : '' ?>>Belum Selesai</option>
            </select>
        </div>
    </form>

    <!-- Add Task Form -->
    <form action="add_task.php" method="POST" class="d-flex mb-4">
        <input type="text" name="task" class="form-control me-2" placeholder="Tambah tugas..." required>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Task List -->
    <div class="py-2">
        <!-- Padding vertical besar -->
        <?php if (empty($tasks)): ?>
        <div class="alert alert-info text-center rounded-3 shadow-sm">
            Belum ada tugas. Mulai tambahkan tugas baru!
        </div>
        <?php else: ?>
        <div class="row">
            <?php foreach ($tasks as $row): ?>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100 <?= ($row['status'] == 'completed') ? 'border-success' : 'border-warning' ?>">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5
                                class="card-title <?= ($row['status'] == 'completed') ? 'text-decoration-line-through text-muted' : '' ?>">
                                <?= htmlspecialchars($row['task'], ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <?php if ($row['status'] != 'completed'): ?>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#confirmCompleteModal" data-id="<?= $row['id']; ?>"
                                data-task="<?= htmlspecialchars($row['task'], ENT_QUOTES, 'UTF-8'); ?>">
                                <i class="fas fa-check"></i>
                            </button>
                            <?php endif; ?>
                            <a href="edit_task.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal" data-id="<?= $row['id']; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Konfirmasi Checklist -->
<div class="modal fade" id="confirmCompleteModal" tabindex="-1" aria-labelledby="completeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="completeModalLabel">Konfirmasi Selesai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menandai tugas ini sebagai <b>selesai</b>?
            </div>
            <div class="modal-footer">
                <form id="completeTaskForm" action="update_task.php" method="POST">
                    <input type="hidden" name="id" id="completeTaskId">
                    <input type="hidden" name="task" id="completeTaskText">
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="btn btn-success">Ya, Tandai Selesai</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus tugas ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <a id="deleteTaskLink" href="#" class="btn btn-danger">Ya, Hapus</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Mengisi Data Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Modal Checklist
        let completeModal = document.getElementById('confirmCompleteModal');
        completeModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let taskId = button.getAttribute('data-id');
            let taskText = button.getAttribute('data-task');

            // Set nilai input hidden di form modal
            document.getElementById('completeTaskId').value = taskId;
            document.getElementById('completeTaskText').value = taskText;
        });

        // Modal Hapus
        let deleteModal = document.getElementById('confirmDeleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let taskId = button.getAttribute('data-id');

            // Atur link hapus di modal
            document.getElementById('deleteTaskLink').href = "delete_task.php?id=" + taskId;
        });
    });
</script>

<?php include 'views/footer.php'; ?>