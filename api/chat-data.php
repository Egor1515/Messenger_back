<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$chatData = [
    [
        "id" => 1,
        "name" => "John Doe",
        "message" => "Hello!",
        "time" => "2024-04-24 12:00:00",
        "delivered" => true
    ],
    [
        "id" => 2,
        "name" => "Alice Smith",
        "message" => "Hi there!",
        "time" => "2024-04-24 12:05:00",
        "delivered" => false
    ],
    [
        "id" => 3,
        "name" => "Bob Johnson",
        "message" => "How are you?",
        "time" => "2024-04-24 12:10:00",
        "delivered" => true
    ]
];

echo json_encode($chatData);
?>
