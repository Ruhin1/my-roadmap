<?php
namespace App\Repositories;

interface TaskRepositoryInterface {
    public function getAllTasks();
    public function getTaskById($id);
    public function createTask($task);
    public function updateTask($id, $task);
    public function deleteTask($id);
}
