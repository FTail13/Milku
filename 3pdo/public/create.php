<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $programmingLanguages = $_POST['programmingLanguages'];
    $experienceLevel = $_POST['experienceLevel'];

    $sql = "INSERT INTO software_engineers (firstName, lastName, email, phoneNumber, programmingLanguages, experienceLevel) 
            VALUES (:firstName, :lastName, :email, :phoneNumber, :programmingLanguages, :experienceLevel)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phoneNumber', $phoneNumber);
    $stmt->bindParam(':programmingLanguages', $programmingLanguages);
    $stmt->bindParam(':experienceLevel', $experienceLevel);

    if ($stmt->execute()) {
        echo "New record created successfully!";
    } else {
        echo "Error: Could not create the record.";
    }
}
?>

<form method="POST">
    First Name: <input type="text" name="firstName" required><br>
    Last Name: <input type="text" name="lastName" required><br>
    Email: <input type="email" name="email" required><br>
    Phone Number: <input type="text" name="phoneNumber"><br>
    Programming Languages: <textarea name="programmingLanguages"></textarea><br>
    Experience Level:
    <select name="experienceLevel">
        <option value="Junior">Junior</option>
        <option value="Mid">Mid</option>
        <option value="Senior">Senior</option>
    </select><br>
    <input type="submit" value="Create Record">
</form>
