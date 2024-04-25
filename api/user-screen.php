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

$sql = "SELECT * FROM user_pers_info";
$result = $mysqli->query($sql);

if ($result) {
    $userData = array();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userData = array(
            "name" => $row["name"],
            "avatarUrl" => $row["avatar_url"],
            "bio" => $row["bio"],
            "job" => $row["job"],
            "location" => $row["location"],
            "email" => $row["email"]
        );
    } else {
        $userData = array(
            "name" => "",
            "avatarUrl" => "",
            "bio" => "",
            "job" => "",
            "location" => "",
            "email" => ""
        );
    }

    $result->free();
} else {
    die("Error: " . $mysqli->error);
}

header('Content-Type: application/json');
echo json_encode($userData);

$mysqli->close();
?>
