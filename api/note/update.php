<?php

include_once '../config/db.php';
include_once '../config/core.php';

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $postdata = json_decode(file_get_contents("php://input"));
        
        $title = $postdata->title;
        $content = $postdata->content;
  
        // Update.
        $sql = "Update notes Set title = ?, content = ? WHERE id = ?";
        $result= $conn->prepare($sql);
        $result->execute([$title, $content, $id]);
        if($result){
            exit(json_encode(array('status'=> 'success')));
        } else {
            exit(json_encode(array('status'=> 'error')));
        } 
    } else {
        http_response_code(422);
    }
}