<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $application_id = $_POST['application_id'];
    $status = $_POST['status'];

    $query = $conn->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $query->bind_param("si", $status, $application_id);

    if ($query->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update application"]);
    }
}
?>
