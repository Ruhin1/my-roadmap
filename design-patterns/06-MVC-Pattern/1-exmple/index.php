<?php


use App\Controllers\TaskController;

// Autoload Classes (PSR-4 Standard)
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
 
// Simple Routing
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controller = new TaskController();

if ($uri === '/' && $method === 'GET') {
    $controller->index();
} elseif ($uri === '/add-task' && $method === 'POST') {
    $controller->addTask();
} elseif($uri === '/delete-all' && $method === 'POST'){
    $controller->deleteAll();
} else {
    echo "404 Not Found";
}
