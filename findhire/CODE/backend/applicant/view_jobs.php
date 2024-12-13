<?php
include '../db_connection.php';

$query = $conn->prepare("SELECT * FROM job_posts");
$query->execute();
$result = $query->get_result();

$jobs = [];
while ($row = $result->fetch_assoc()) {
    $jobs[] = $row;
}

echo json_encode($jobs);
?>
