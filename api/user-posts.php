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

$sql = "SELECT * FROM user_posts ORDER BY postedAt DESC";
$result = $mysqli->query($sql);

if ($result) {
    $userPosts = array();

    while ($row = $result->fetch_assoc()) {
        $userPosts[] = array(
            "avatarUrl" => $row['avatarUrl'],
            "name" => $row['name'],
            "postedAt" => $row['postedAt'],
            "postText" => $row['postText'],
            "images" => $row['images'],
            "liked" => (bool) $row['liked'],
            "likesCount" => (int) $row['likesCount']
        );
    }
    $result->free();
} else {
    die('Error fetching user posts: ' . $mysqli->error);
}

header('Content-Type: application/json');
echo json_encode($userPosts);
$mysqli->close();
?>
