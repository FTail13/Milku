<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $created_by = $_POST['created_by'];

    $query = $conn->prepare("INSERT INTO job_posts (title, description, created_by) VALUES (?, ?, ?)");
    $query->bind_param("sss", $title, $description, $created_by);

    if ($query->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to create job"]);
    }
}
?>
