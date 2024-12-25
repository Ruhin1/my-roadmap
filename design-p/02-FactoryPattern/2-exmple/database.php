<?php

interface DatabaseConnection {
    public function connect();
}


class MySQLConnection implements DatabaseConnection {
    public function connect() {
        try {
            $connection = new PDO("mysql:host=localhost;dbname=testdb", "root", "");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to MySQL successfully.<br>";
            return $connection;
        } catch (PDOException $e) {
            die("MySQL Connection Failed: " . $e->getMessage());
        }
    }
}


class SQLiteConnection implements DatabaseConnection {
    public function connect() {
        try {
            $connection = new PDO("sqlite:" . __DIR__ . "/database.sqlite");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to SQLite successfully.<br>";
            return $connection;
        } catch (PDOException $e) {
            die("SQLite Connection Failed: " . $e->getMessage());
        }
    }
}


class PostgreSQLConnection implements DatabaseConnection {
    public function connect() {
        try {
            $connection = new PDO("pgsql:host=localhost;dbname=testdb", "root", "");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to PostgreSQL successfully.<br>";
            return $connection;
        } catch (PDOException $e) {
            die("PostgreSQL Connection Failed: " . $e->getMessage());
        }
    }
}



class DatabaseFactory {
    public static function createConnection($type) {
        switch ($type) {
            case 'mysql':
                return new MySQLConnection();
            case 'sqlite':
                return new SQLiteConnection();
            case 'postgresql':
                return new PostgreSQLConnection();
            default:
                throw new Exception("Unsupported database type: $type");
        }
    }
}




