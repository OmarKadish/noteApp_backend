<?php

include_once '../config/db.php';
include_once '../config/core.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
  
        // Delete.
        $sql = "Delete From notes WHERE id = ?";
        $result= $conn->prepare($sql);
        $result->execute([$id]);
        if($result->rowCount() > 0){
            exit(json_encode(array('status'=> 'success')));
        } else {
            exit(json_encode(array('status'=> 'error')));
        } 
    } else {
        http_response_code(422);
    }
}