<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$sql_create_table = "CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    imageUrl VARCHAR(255) NOT NULL,
    followers INT DEFAULT 0
  )";

$sql_insert_account = "INSERT INTO accounts (name, imageUrl, followers) VALUES ('John Doe', 'https://example.com/avatar.jpg', 1000)";

$sql_insert_accounts = "INSERT INTO accounts (name, imageUrl, followers) VALUES
                        ('Alice Smith', 'https://example.com/alice.jpg', 500),
                        ('Bob Johnson', 'https://example.com/bob.jpg', 750)";
$sql_select_accounts = "SELECT id, name, imageUrl, followers FROM accounts";
$result = $mysqli->query($sql_select_accounts);

if ($result->num_rows > 0) {
    $accounts = array();
    while ($row = $result->fetch_assoc()) {
        $accounts[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($accounts);
} else {
    echo "No accounts found";
}

$mysqli->close();
?>
