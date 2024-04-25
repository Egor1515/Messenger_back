<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

$mockUserPosts = [
    [
        "avatarUrl" => "https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg",
        "name" => "John Doe",
        "postedAt" => date('Y-m-d H:i:s'),
        "postText" => "Post text",
        "content" => "Content goes here",
        "liked" => false,
        "likesCount" => 0
    ],
    [
        "avatarUrl" => "https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg",
        "name" => "Alice Smith",
        "postedAt" => date('Y-m-d H:i:s'),
        "postText" => "Another post",
        "content" => "More content",
        "liked" => true,
        "likesCount" => 10
    ],
    [
        "avatarUrl" => "https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg",
        "name" => "Bob Johnson",
        "postedAt" => date('Y-m-d H:i:s'),
        "postText" => "Yet another post",
        "content" => "Even more content",
        "liked" => false,
        "likesCount" => 5
    ]
];

header('Content-Type: application/json');
echo json_encode($mockUserPosts);
?>
