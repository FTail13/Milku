<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $query->bind_param("sss", $username, $password, $role);

    if ($query->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registration failed"]);
    }
}
?>
