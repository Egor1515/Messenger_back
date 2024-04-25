<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = json_decode(file_get_contents("php://input"), true);

    if (isset($postData['name'], $postData['avatarUrl'], $postData['postText'], $postData['content'], $postData['likesCount'], $postData['liked'])) {

        $postedAt = date('Y-m-d H:i:s');
        $newPost = [
            'avatarUrl' => $postData['avatarUrl'],
            'name' => $postData['name'],
            'postedAt' => $postedAt,
            'postText' => $postData['postText'],
            'content' => $postData['content'],
            'liked' => $postData['liked'],
            'likesCount' => $postData['likesCount']
        ];

        require_once('user-posts-data.php');
        $mockUserPosts[] = $newPost;
        file_put_contents('user-posts-data.php', '<?php $mockUserPosts = ' . var_export($mockUserPosts, true) . ';');
        echo json_encode(['message' => 'New post created successfully', 'newPost' => $newPost]);
    } else {
        echo json_encode(['error' => 'Not all required fields are provided']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
