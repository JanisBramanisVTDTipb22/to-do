<?php
// Include necessary files and configurations
$config = require "../config.php";

// Fetch the task to be edited
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    // Fetch task from the database using your preferred method (PDO, ORM, etc.)
    // Example:
    // $task = fetchTaskFromDatabase($config, $task_id);
    // Ensure $task is properly sanitized to prevent SQL injection
}

// Handle form submission to update task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['deadline']) && isset($_POST['completed'])) {
    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $completed = $_POST['completed'];

    // Update the task in the database using your preferred method (PDO, ORM, etc.)
    // Example:
    // $success = updateTaskInDatabase($config, $task_id, $title, $description, $deadline, $completed);
    // Ensure proper error handling

    // Redirect to clear the form data
    header("Location: /"); // Redirect to the homepage or wherever appropriate
    exit();
}

// Include the view file to render the page
require "../app/views/edit.view.php";
?>
