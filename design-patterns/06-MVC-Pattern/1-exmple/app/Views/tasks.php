<?php

$tasks = $data['tasks'] ?? []; // Controller থেকে ডেটা আসবে
// $tasks = ['namaj','gusol','tour',];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
</head>
<body>
    
    <form method="POST" action="/add-task">
        <input type="text" name="task" placeholder="Enter task" required>
        <button type="submit">Add Task</button>
    </form>
    <form method="POST" action="/delete-all">
        <button type="submit">Delete All</button>
    </form>
    <h1>Task List</h1>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li><?= htmlspecialchars($task) ?></li>
            
        <?php endforeach; ?>
    </ul>
</body>
</html>
