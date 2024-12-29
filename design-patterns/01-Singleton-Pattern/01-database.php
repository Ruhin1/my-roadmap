<?php
namespace Sing;
use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;
    private $close = false;

    private function __construct() {
       
        try {
            $this->connection = new PDO(
                "mysql:host=localhost;dbname=testdb",
                "root",
                ""
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    private function __clone() {}
    public function __wakeup() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    
}

//রেজাল্ট চেক করা
// function p($a = []) {
//     echo "<pre>";
//     var_dump($a);
//     echo "</pre>";
// }

// Usage Example:

$db1 = Database::getInstance();
$conn = $db1->getConnection();

// একটি কোয়েরি চালানোর পর
$query = $conn->query("SELECT * FROM users");
$results = $query->fetchAll(PDO::FETCH_ASSOC);


// p($results);


