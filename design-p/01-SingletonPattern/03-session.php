<?php

class Session {
    private static $instance = null;

    private function __construct() {
        session_start();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Session();
        }
        return self::$instance;
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    private function __clone() {}
    public function __wakeup() {}
}

// Usage Example:
$session = Session::getInstance();
$session->set('user', 'Ruhin');
echo $session->get('user'); // Outputs: John Doe
?>
