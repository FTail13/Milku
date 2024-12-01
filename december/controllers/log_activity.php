<?php
function log_activity($user_id, $action, $details) {
    require_once '../models/database.php';
    $db = new Database();

    $stmt = $db->getConnection()->prepare("INSERT INTO activity_logs (user_id, action, details) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $action, $details);
    $stmt->execute();
}
