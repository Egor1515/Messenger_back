<?php
header("Access-Control-Allow-Origin: *");

$earningData = [
    [
        "service" => "Service A",
        "earning" => 1500,
        "status" => "Completed"
    ],
    [
        "service" => "Service B",
        "earning" => 200,
        "status" => "Pending"
    ],
    [
        "service" => "Service C",
        "earning" => 1200,
        "status" => "Completed"
    ]
];

header('Content-Type: application/json');
echo json_encode($earningData);
?>
