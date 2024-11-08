<?php
include 'db.php';
include 'session_check.php';

$events = $conn->query("SELECT events.*, users.first_name, users.last_name FROM events JOIN users ON events.added_by = users.id")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Events</title>
</head>
<body>
    <h1>All Events</h1>
    <table border="1">
        <tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Added By</th>
            <th>Last Updated</th>
        </tr>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo $event['event_name']; ?></td>
                <td><?php echo $event['date']; ?></td>
                <td><?php echo $event['location']; ?></td>
                <td><?php echo $event['first_name'] . ' ' . $event['last_name']; ?></td>
                <td><?php echo $event['last_updated']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
