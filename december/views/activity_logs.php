<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

require_once '../models/database.php';
require_once '../models/activityLog.php';

$activityLogs = (new ActivityLogModel())->getActivityLogs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
</head>
<body>
    <h1>Activity Logs</h1>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Details</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activityLogs as $log): ?>
                <tr>
                    <td><?php echo $log['username']; ?></td>
                    <td><?php echo $log['action']; ?></td>
                    <td><?php echo $log['details']; ?></td>
                    <td><?php echo $log['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
