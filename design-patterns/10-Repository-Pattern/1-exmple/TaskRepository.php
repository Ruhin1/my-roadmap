<?php
namespace App\Repositories;

use App\Entities\Task;

class TaskRepository implements TaskRepositoryInterface {
    private $tasks = [];

    public function __construct() {
        // Sample Data
        $this->tasks[] = new Task(1, "Learn PHP", "Study PHP basics", "pending");
        $this->tasks[] = new Task(2, "Write Code", "Complete Repository Pattern example", "completed");
    }

    public function getAllTasks() {
        return $this->tasks;
    }

    public function getTaskById($id) {
        foreach ($this->tasks as $task) {
            if ($task->id == $id) {
                return $task;
            }
        }
        return null;
    }

    public function createTask($task) {
        $this->tasks[] = $task;
    }

    public function updateTask($id, $task) {
        foreach ($this->tasks as &$existingTask) {
            if ($existingTask->id == $id) {
                $existingTask = $task;
                return;
            }
        }
    }

    public function deleteTask($id) {
        $this->tasks = array_filter($this->tasks, function ($task) use ($id) {
            return $task->id != $id;
        });
    }
}
