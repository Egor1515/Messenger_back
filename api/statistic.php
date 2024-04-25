<?php
header("Access-Control-Allow-Origin: *");

$statisticsData = [
    [
        "users" => 100,
        "subscribes" => 500,
        "downloads" => 200,
        "products" => 300
    ],
];

header('Content-Type: application/json');
echo json_encode($statisticsData);
?>
