<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Моковые данные чата
$chatData = [
    [
        "sender" => "John",
        "timestamp" => "2024-04-24 12:00:00",
        "subject" => "Greeting",
        "message" => "Hello there!",
        "unread" => true
    ],
    [
        "sender" => "Alice",
        "timestamp" => "2024-04-24 12:05:00",
        "subject" => "Question",
        "message" => "How are you?",
        "unread" => false
    ],
    [
        "sender" => "Bob",
        "timestamp" => "2024-04-24 12:10:00",
        "subject" => "Discussion",
        "message" => "Let's meet tomorrow.",
        "unread" => true
    ]
];

echo json_encode($chatData);
?>
