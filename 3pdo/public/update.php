<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM software_engineers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $programmingLanguages = $_POST['programmingLanguages'];
    $experienceLevel = $_POST['experienceLevel'];

    $sql = "UPDATE software_engineers SET 
            firstName = :firstName, 
            lastName = :lastName, 
            email = :email, 
            phoneNumber = :phoneNumber, 
            programmingLanguages = :programmingLanguages, 
            experienceLevel = :experienceLevel 
            WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':programmingLanguages', $programmingLanguages);
    $stmt->bindParam(':experienceLevel', $experienceLevel);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Record updated successfully!";
    } else {
        echo "Error: Could not update the record.";
    }
}
?>

<form method="POST">
    First Name: <input type="text" name="firstName" value="<?= $record['firstName'] ?>" required><br>
    Last Name: <input type="text" name="lastName" value="<?= $record['lastName'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $record['email'] ?>" required><br>
    Phone Number: <input type="text" name="phoneNumber" value="<?= $record['phoneNumber'] ?>"><br>
    Programming Languages: <textarea name="programmingLanguages"><?= $record['programmingLanguages'] ?></textarea><br>
    Experience Level:
    <select name="experienceLevel">
        <option value="Junior" <?= $record['experienceLevel'] == 'Junior' ? 'selected' : '' ?>>Junior</option>
        <option value="Mid" <?= $record['experienceLevel'] == 'Mid' ? 'selected' : '' ?>>Mid</option>
        <option value="Senior" <?= $record['experienceLevel'] == 'Senior' ? 'selected' : '' ?>>Senior</option>
    </select><br>
    <input type="submit" value="Update Record">
</form>
