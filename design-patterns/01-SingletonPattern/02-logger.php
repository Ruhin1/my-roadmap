<?php

class Logger {
    private static $instance = null;
    private $logFile;

    private function __construct($file = 'app.log') {
        $this->setLogFile($file);
    }

    public static function getInstance($file = 'app.log') {
        if (self::$instance === null) {
            self::$instance = new Logger($file);
        } else {
            self::$instance->setLogFile($file); // Update the file dynamically
        }
        return self::$instance;
    }

    public function setLogFile($file) {
        $this->logFile = __DIR__ . '/' . $file;
    }

    public function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$timestamp] $message\n", FILE_APPEND);
    }

    private function __clone() {}
    public function __wakeup() {}
}

// Usage Example:

// Log into the default app.log file
$logger = Logger::getInstance();
$logger->log("This is a log message in app.log");

// Log into a different file (e.g., error.log)
$errorLogger = Logger::getInstance('error.log');
$errorLogger->log("This is an error message in error.log");

