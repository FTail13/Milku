<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Nurse</title>
</head>
<body>
    <h2>Add New Nurse</h2>
    <form method="POST" action="../controllers/applicantsController.php">
        <label>First Name</label>
        <input type="text" name="firstName" required>
        <label>Last Name</label>
        <input type="text" name="lastName" required>
        <label>Years of Experience</label>
        <input type="number" name="yearsOfExperience" required>
        <label>Specialization</label>
        <input type="text" name="specialization" required>
        <label>License Number</label>
        <input type="text" name="licenseNumber" required>
        <label>Preferred Shift</label>
        <select name="preferredShift">
            <option value="Morning">Morning</option>
            <option value="Evening">Evening</option>
            <option value="Night">Night</option>
        </select>
        <button type="submit" name="action" value="create">Add Nurse</button>
    </form>
</body>
</html>
