<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost;dbname=event_planning", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
