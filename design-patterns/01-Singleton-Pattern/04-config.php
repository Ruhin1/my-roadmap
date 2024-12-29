<?php

class Config {
    private static $instance = null;
    private $settings = [];

    private function __construct() {
        // Load settings from a file
        $this->settings = parse_ini_file(__DIR__ . '/config.ini', true);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get($key, $default = null) {
        return $this->settings[$key] ?? $default;
    }

    private function __clone() {}
    public function __wakeup() {}
}



$config = Config::getInstance();
echo $config->get('database.host');
?>
