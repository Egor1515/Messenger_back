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

$createTableSql = "CREATE TABLE IF NOT EXISTS user_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    avatarUrl VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    postedAt DATETIME NOT NULL,
    postText TEXT NOT NULL,
    content TEXT NOT NULL,
    liked TINYINT(1) NOT NULL,
    likesCount INT NOT NULL
)";
if ($mysqli->query($createTableSql) === TRUE) {

    $insertDataSql = "INSERT INTO user_posts (avatarUrl, name, postedAt, postText, content, liked, likesCount)
    VALUES ('https://example.com/avatar.jpg', 'John Doe', NOW(), 'Post text', 'Content goes here', 0, 0)";


} else {
    echo "Error creating table: " . $mysqli->error . "<br>";
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
            "content" => $row['content'],
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
