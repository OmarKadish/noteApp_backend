<?php

include_once '../config/db.php';
include_once '../config/core.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM notes WHERE id=?";
        $result= $conn->prepare($sql);
        $result->execute([$id]);
        $data = $result->fetch();
    }

    exit(json_encode($data));

}