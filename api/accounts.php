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
