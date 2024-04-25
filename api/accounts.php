<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'test';

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
$insert_sql = "INSERT INTO accounts (name, imageUrl, followers) VALUES
    ('John Doe', 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg', 1000),
    ('Alice Smith', 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg', 500),
    ('Bob Johnson', 'https://img.freepik.com/free-photo/beauty-portrait-of-female-face_93675-132045.jpg', 750)";

if ($mysqli->query($insert_sql) === TRUE) {

} else {
    echo "Error inserting records: " . $mysqli->error . "<br>";
}

$useMockData = false; // Можно становить в true для использования моковых данных

if ($useMockData) {
    // Моковые данные
    $accounts = [
        [
            'id' => 1,
            'name' => 'John Doe',
            'imageUrl' => 'https://example.com/avatar.jpg',
            'followers' => 1000
        ],
        [
            'id' => 2,
            'name' => 'Alice Smith',
            'imageUrl' => 'https://example.com/alice.jpg',
            'followers' => 500
        ],
        [
            'id' => 3,
            'name' => 'Bob Johnson',
            'imageUrl' => 'https://example.com/bob.jpg',
            'followers' => 750
        ]
    ];

    // Возвращаем моковые данные в формате JSON
    header('Content-Type: application/json');
    echo json_encode($accounts);
} else {
    // Реальные данные из базы данных
    $sql_select_accounts = "SELECT id, name, imageUrl, followers FROM accounts";
    $result = $mysqli->query($sql_select_accounts);

    if ($result->num_rows > 0) {
        $accounts = array();
        while ($row = $result->fetch_assoc()) {
            $accounts[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($accounts);
    } else {
        echo "No accounts found";
    }
}

$mysqli->close();
?>
