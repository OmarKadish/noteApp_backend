<?php

include_once 'config/db.php';
include_once '../vendor/autoload.php';

use \Firebase\JWT\JWT;
include_once 'config/core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

	$email = $data->email;
    $password = $data->password;

    //hashing the password to compare it.
    $chk_password = password_hash($password, PASSWORD_DEFAULT);

    //check the database to make sure a user does not already exist with the same email
    $user_check_query = "SELECT * FROM users WHERE email=?";
    $result= $conn->prepare($user_check_query);
    $result->execute([$email]);
    $user = $result->fetch();
    if(password_verify($password, $user['password'])){
        $key = "OMAR_SECRET_KEY";
        $payload = array(
            'id' => $user['id'],
            'email' => $user['email'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname']
        );
        $token = JWT::encode($payload, $key, 'HS256');
        http_response_code(200);
        echo json_encode(array('token' => $token));
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'Login Failed!'));
    }

} else {
    http_response_code(400);
    echo json_encode(array('message' => 'Login Failed!'));
}