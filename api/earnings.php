<?php
header("Access-Control-Allow-Origin: *");

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test';

$conn = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT service, earning, status FROM earnings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $earningData = array();

    while($row = $result->fetch_assoc()) {
        $earningData[] = array(
            "service" => $row["service"],
            "earning" => (int)$row["earning"],
            "status" => $row["status"]
        );
    }

    header('Content-Type: application/json');
    echo json_encode($earningData);
} else {
    echo json_encode(array());
}

$conn->close();
?>
