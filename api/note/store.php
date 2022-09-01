<?php
include_once '../config/db.php';
include_once '../config/core.php';


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $postdata = json_decode(file_get_contents("php://input"));

      
      $title = $postdata->title;
      $content = $postdata->content;
      $user_id = $postdata->user_id;

      // Store.
      $sql = "INSERT INTO notes (title , content, user_id) VALUES (?, ?, ?)";
      $result= $conn->prepare($sql);
      $result->execute([$title, $content, $user_id]);
      if($result){
        $postdata->id = $conn->lastInsertId();
        exit(json_encode($postdata));
      } else {
          exit(json_encode(array('status'=> 'error')));
      } 
  } else {
      http_response_code(422);
    }
