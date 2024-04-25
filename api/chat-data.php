<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$sql = "SELECT * FROM chat_data";
$result = $mysqli->query($sql);

if ($result) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "id" => $row["id"],
            "name" => $row["name"],
            "message" => $row["message"],
            "time" => $row["time"],
            "delivered" => (bool) $row["delivered"]
        ];
    }
    $result->free();
    echo json_encode($data); 
} else {
    echo json_encode(array("error" => "Error: " . $mysqli->error));
}

$mysqli->close();
?>
