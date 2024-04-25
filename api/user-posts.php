<?php
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}
require_once('user-posts-data.php');

header('Content-Type: application/json');
echo json_encode(array_reverse($mockUserPosts));
?>
