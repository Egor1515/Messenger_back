<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

$mockUserData = [
    "name" => "John Doe",
    "avatarUrl" => "https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg",
    "bio" => "This is my bio",
    "job" => "Web Developer",
    "location" => "New York",
    "email" => "johndoe@example.com"
];

header('Content-Type: application/json');
echo json_encode($mockUserData);
?>
