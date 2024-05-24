<?php

require_once '../app/models/SearchModel.php';

class YourController {
    public function searchAction() {
        // Assuming $tasks is an array of tasks
        $tasks = []; // Fetch tasks from database or other source
        
        // Check if a search query is present
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = $_GET['query'];
            // Instantiate SearchModel
            $searchModel = new SearchModel();
            // Search tasks using SearchModel
            $filteredTasks = $searchModel->searchTasks($tasks, $query);
        } else {
            // If no search query is present, display all tasks
            $filteredTasks = $tasks;
        }

        // Load the view
        include '../views/your_view.php';
    }
}

