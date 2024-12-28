<?php
require '01-database.php';
use Sing\Database;
$db1 = Database::getInstance();


// একটি কোয়েরি চালানোর পর
$query = $conn->query("SELECT * FROM users WHERE id = 1");
$results = $query->fetchAll(PDO::FETCH_ASSOC);


// p($results); 

?>