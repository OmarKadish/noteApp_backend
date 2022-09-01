<?php
include_once 'config/db.php';
include_once 'config/core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    $fname = $data->firstName;
	$lname = $data->lastName;
	$email = $data->email;
    $password = $data->password;

    // Hash Password
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // U can do validation like unique username etc....

    try {
        $statement = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) 
        VALUES (?,?,?,?)");
        $statement->execute([$fname, $lname, $email, $hashed]);

        if ($statement){
            echo json_encode(array('message' => 'User created'));
        } else {
            echo json_encode(array('message' => 'Internal Server error'));
        }
    } catch (PDOException $e) {
            print $e->getMessage();
    }
} else {
    http_response_code(404);
}



?>