<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

$useMockData = true;

if ($useMockData) {
    $accounts = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'imageUrl' => 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg',
            'followers' => 1000
        ],
        [
            'id' => 2,
            'name' => 'Alice Smith',
            'imageUrl' => 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg',
            'followers' => 500
        ],
        [
            'id' => 3,
            'name' => 'Bob Johnson',
            'imageUrl' => 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg',
            'followers' => 750
        ]
    ];

    header('Content-Type: application/json');
    echo json_encode($accounts);
} else {
    echo "No mock data available";
}
?>
