<?php

class Mailer {
    private static $instance = null;

    private function __construct() {
        // Initialize the mailer (e.g., PHPMailer, etc.)
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Mailer();
        }
        return self::$instance;
    }

    public function sendMail($to, $subject, $message) {
        // Example: Using PHP's mail() function
        mail($to, $subject, $message);
    }

    private function __clone() {}
    public function __wakeup() {}
}

// Usage Example:
$mailer = Mailer::getInstance();
$mailer->sendMail('recipient@example.com', 'Test Email', 'This is a test message.');
?>
