<!-- edit.view.php -->

<?php
$title = "Edit Task";
require "../app/views/components/header.php";
require "../app/views/components/navbar.php";
?>

<div class="container">
    <h1>Edit Task</h1>
    <form method="post" action="/edit.php"> <!-- Make sure the form action is correct -->
        <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($task['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($task['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" class="form-control" value="<?= htmlspecialchars($task['deadline'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-group">
            <label for="completed">Completed:</label>
            <input type="checkbox" id="completed" name="completed" <?= isset($task['completed']) && $task['completed'] ? 'checked' : '' ?>>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>

<?php require "../app/views/components/footer.php"; ?>
