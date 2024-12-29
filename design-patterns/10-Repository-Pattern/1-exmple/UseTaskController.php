<?php

namespace App\Controllers;
require __DIR__ .'/TaskRepositoryInterface.php';
require __DIR__ . '/Task.php';
require __DIR__ . '/TaskRepository.php';




use App\Repositories\TaskRepository;
use App\Entities\Task;

class TaskController {
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function index() {
        $tasks = $this->taskRepository->getAllTasks();
        foreach ($tasks as $task) {
            echo "Task ID: {$task->id}, Title: {$task->title}, Status: {$task->status} <br/>";
        }
    }

    public function create($title, $description, $status) {
        $newTask = new Task(rand(100, 999), $title, $description, $status);
        $this->taskRepository->createTask($newTask);
        echo "Task created successfully.<br/>";
    }

    public function update($id, $title, $description, $status) {
        $updatedTask = new Task($id, $title, $description, $status);
        $this->taskRepository->updateTask($id, $updatedTask);
        echo "Task updated successfully.<br/>";
    }

    public function delete($id) {
        $this->taskRepository->deleteTask($id);
        echo "Task deleted successfully.<br/>";
    }
}

// Usage Example
$repository = new TaskRepository();
$controller = new TaskController($repository);

echo "All Tasks:<br>";
$controller->index();
echo "--------------<br>";
echo "\nAdding a New Task:<br>";
$controller->create("Learn Laravel", "Study the basics of Laravel", "pending");
echo "--------------<br>";

echo "\nAll Tasks After Adding:<br>";
$controller->index();
echo "--------------<br>";

echo "\nUpdating Task ID 1:\n";
$controller->update(1, "Learn PHP Advanced", "Study advanced topics in PHP", "in-progress");
echo "--------------<br>";

echo "\nAll Tasks After Update:<br>";
$controller->index();
echo "--------------<br>";

echo "\nDeleting Task ID 2:<br>";
$controller->delete(2);
echo "--------------<br>";

echo "\nAll Tasks After Deletion:<br>";
$controller->index();
echo "--------------<br>";
