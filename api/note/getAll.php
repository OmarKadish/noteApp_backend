<?php

include_once '../config/db.php';
include_once '../config/core.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userId = $_GET['uid'];

    $data = array();
    $sql = "SELECT * FROM notes Where user_id = ?";
    $result = $conn->prepare($sql);
    $result->execute([$userId]);
    $data = $result->fetchall(PDO::FETCH_ASSOC);
    
    exit(json_encode($data));
}
