<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents("php://input"), true);

    if (isset($postData['name'], $postData['avatarUrl'], $postData['postText'], $postData['content'], $postData['likesCount'], $postData['liked'])) {
        $postedAt = date('Y-m-d H:i:s');
        $newPost = [
            'id' => uniqid(), 
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
        echo json_encode(['error' => 'Not all required fields are provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
