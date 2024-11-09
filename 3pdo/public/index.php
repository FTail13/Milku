<?php
include('config.php');

$sql = "SELECT * FROM software_engineers";
$stmt = $pdo->query($sql);

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Programming Languages</th>
            <th>Experience Level</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['firstName'] . "</td>
            <td>" . $row['lastName'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phoneNumber'] . "</td>
            <td>" . $row['programmingLanguages'] . "</td>
            <td>" . $row['experienceLevel'] . "</td>
            <td>" . $row['dateAdded'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'>Update</a> | 
                <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>
        </tr>";
}
echo "</table>";
?>
