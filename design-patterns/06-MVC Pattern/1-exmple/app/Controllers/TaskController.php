<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController {
    public function index() {
        // Get all tasks
        $tasks = Task::getAllTasks();

        // Pass data to the view
        $this->view('tasks', ['tasks' => $tasks]);
    }

    public function addTask() {
        
        // Get task from POST data
        $task = $_POST['task'] ?? null;

        if ($task) {
            // Add task to the model
            Task::addTask($task);
        }

        // Redirect to the task list
        header('Location: /');
    }
    public function deleteAll() {
        
        Task::deleteAll();
        // Redirect to the task list
        header('Location: /');
    }
    
    private function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../Views/{$view}.php";
    }
}
