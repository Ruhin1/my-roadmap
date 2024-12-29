<?php
// Real-Life Example: Logger System

// Step 1: Logger Interface

interface Logger {
    public function log($message);
}

// Step 2: Concrete Loggers

class FileLogger implements Logger {
    public function log($message) {
        echo "Logging to a file: $message\n";
    }
}

class DatabaseLogger implements Logger {
    public function log($message) {
        echo "Logging to a database: $message\n";
    }
}

// Step 3: Main Class

class UserService {
    private $logger;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function createUser($name) {
        // Simulating user creation
        echo "User $name created successfully.\n";

        // Log the operation
        $this->logger->log("User $name has been created.");
    }
}

// Step 4: ব্যবহার করা

// Use File Logger
$fileLogger = new FileLogger();
$userService = new UserService($fileLogger);
$userService->createUser('Ruhin');

// Use Database Logger
$dbLogger = new DatabaseLogger();
$userService = new UserService($dbLogger);
$userService->createUser('Tonmoy');
?>






