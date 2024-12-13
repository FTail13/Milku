<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicant_id = $_POST['applicant_id'];
    $hr_id = $_POST['hr_id'];
    $message = $_POST['message'];

    $query = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $query->bind_param("iis", $applicant_id, $hr_id, $message);

    if ($query->execute()) {
        echo json_encode(["status" => "success", "message" => "Follow-up message sent successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send follow-up"]);
    }
}
?>
