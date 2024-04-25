<?php
header("Access-Control-Allow-Origin: *");

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$sql = "SELECT * FROM statistic";
$result = $mysqli->query($sql);

if ($result) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "users" => $row["users"],
            "subscribes" => $row["subscribes"],
            "downloads" => $row["downloads"],
            "products" => $row["products"]
        ];
    }
    $result->free();
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "Error: " . $mysqli->error;
}

$mysqli->close();
?>
