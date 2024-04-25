<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$database_name = 'test';

$mysqli = new mysqli($db_host, $db_user, $db_password);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (!$mysqli->select_db($database_name)) {
    $sql_create_database = "CREATE DATABASE $database_name";

    if ($mysqli->query($sql_create_database) === TRUE) {
        echo "Database '$database_name' created successfully<br>";
        $mysqli->select_db($database_name);
    } else {
        echo "Error creating database: " . $mysqli->error . "<br>";
    }
}

$sql_create_table = "CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    imageUrl VARCHAR(255) NOT NULL,
    followers INT DEFAULT 0
)";

if ($mysqli->query($sql_create_table) === TRUE) {
    echo "Table 'accounts' created successfully<br>";
} else {
    echo "Error creating table: " . $mysqli->error . "<br>";
}

$mysqli->close();
?>
