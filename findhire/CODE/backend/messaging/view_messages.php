<?php
include '../db_connection.php';

$user_id = $_GET['user_id'];

$query = $conn->prepare("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ?");
$query->bind_param("ii", $user_id, $user_id);
$query->execute();
$result = $query->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
