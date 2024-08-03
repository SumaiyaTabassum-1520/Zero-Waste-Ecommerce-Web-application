<?php
$hostname = 'localhost'; 
$username = 'root'; 
$password = ''; 
$databaseName = 'zerowaste'; 

try {

    $pdo = new PDO("mysql:host=$hostname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS $databaseName";

    $pdo->exec($sql);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
