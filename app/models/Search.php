<?php

class SearchModel {
    public function searchTasks($tasks, $query) {
        // Filter tasks based on search query
        return array_filter($tasks, function($task) use ($query) {
            // Perform a case-insensitive search for the task title
            return stripos($task->title, $query) !== false;
        });
    }
}