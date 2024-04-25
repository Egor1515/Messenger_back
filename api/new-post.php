<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents("php://input"), true);

    if (isset($postData['name'], $postData['avatarUrl'], $postData['postText'], $postData['content'], $postData['likesCount'], $postData['liked'])) {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = 'root';
        $db_db = 'test';

        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        $postedAt = date('Y-m-d H:i:s');

        $stmt = $mysqli->prepare("INSERT INTO user_posts (name, avatarUrl, postText, postedAt, content, likesCount, liked) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die('Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error);
        }

        $stmt->bind_param("sssssid", $postData['name'], $postData['avatarUrl'], $postData['postText'], $postedAt, $postData['content'], $postData['likesCount'], $postData['liked']);

        if ($stmt->execute()) {
            $newPostId = $mysqli->insert_id;
            $newPost = [
                'id' => $newPostId,
                'name' => $postData['name'],
                'avatarUrl' => $postData['avatarUrl'],
                'postText' => $postData['postText'],
                'postedAt' => $postedAt,
                'content' => $postData['content'],
                'likesCount' => $postData['likesCount'],
                'liked' => $postData['liked']
            ];
            echo json_encode(['message' => 'New post created successfully', 'newPost' => $newPost]);
        } else {
            echo json_encode(['error' => 'Error creating new post: ' . $stmt->error]);
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo json_encode(['error' => 'Not all required fields are provided']);
    }   
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
