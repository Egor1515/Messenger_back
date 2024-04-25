<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test';

$mysqli = new mysqli($db_host, $db_user, $db_password);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Создание базы данных test, если ее не существует
$create_db_sql = "CREATE DATABASE IF NOT EXISTS $db_db";
if ($mysqli->query($create_db_sql) === TRUE) {
    echo "Database '$db_db' created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $mysqli->error . "<br>";
}

// Подключение к базе данных test
$mysqli->select_db($db_db);

// Создание таблицы accounts, если она не существует
$create_table_sql = "CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    imageUrl VARCHAR(255) NOT NULL,
    followers INT DEFAULT 0
)";
if ($mysqli->query($create_table_sql) === TRUE) {
    echo "Table 'accounts' created successfully or already exists.<br>";

    // Вставка начальных записей, если таблица создана или уже существует
    $insert_sql = "INSERT INTO accounts (name, imageUrl, followers) VALUES
        ('John Doe', 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg', 1000),
        ('Alice Smith', 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg', 500),
        ('Bob Johnson', 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg', 750)";
    
    if ($mysqli->query($insert_sql) === TRUE) {
        echo "Initial records inserted successfully<br>";
    } else {
        echo "Error inserting records: " . $mysqli->error . "<br>";
    }
} else {
    echo "Error creating table: " . $mysqli->error . "<br>";
}

$mysqli->close();
?>
