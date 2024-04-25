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

foreach ($chatData as $message) {
    $sender = $message['sender'];
    $timestamp = $message['timestamp'];
    $subject = $message['subject'];
    $messageText = $message['message'];
    $unread = $message['unread'];

    $timestamp = date('Y-m-d H:i:s', strtotime($timestamp));
    $stmt = $mysqli->prepare($sql_insert_messages);
    $stmt->bind_param("ssssi", $sender, $timestamp, $subject, $messageText, $unread);
    $stmt->execute();

    if ($stmt->errno) {
        echo "Ошибка при выполнении запроса: " . $stmt->error;
    }
    $stmt->close();
}

$sql_select_messages = "SELECT * FROM chats";

$result = $mysqli->query($sql_select_messages);

if ($result->num_rows > 0) {
    $chatMessages = array();
    while ($row = $result->fetch_assoc()) {
        $chatMessages[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($chatMessages);
} else {
    echo "No chat messages found";
}

$mysqli->close();
?>
