<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $applicant_id = $_POST['applicant_id'];
    $cover_letter = $_POST['cover_letter'];
    $resume_path = $_FILES['resume']['name'];

    move_uploaded_file($_FILES['resume']['tmp_name'], "../uploads/" . $resume_path);

    $query = $conn->prepare("INSERT INTO applications (job_id, applicant_id, cover_letter, resume_path) VALUES (?, ?, ?, ?)");
    $query->bind_param("iiss", $job_id, $applicant_id, $cover_letter, $resume_path);

    if ($query->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to apply"]);
    }
}
?>
