<?php
auth();
require "../app/models/Task.php";



$tasksModel = new TaskModel();
$tasks = $tasksModel->getAllTasks();

$title = "home";
require "../app/views/index.view.php";