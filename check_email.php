<?php
require "include/db_conn.php";

if(isset($_POST["email"])){
    $email = $_POST["email"];
    
    $sql_check = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    $response = array();
    if ($result->num_rows > 0) {
        $response['exists'] = true;
    } else {
        $response['exists'] = false;
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
