<?php
require_once '../models/database.php';
require_once '../models/user.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userModel = new UserModel();

    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $result = $userModel->registerUser($username, $password);

        if ($result) {
            echo json_encode(['message' => 'Registration successful']);
        } else {
            echo json_encode(['message' => 'Registration failed']);
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $userModel->loginUser($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            echo json_encode(['message' => 'Login successful']);
        } else {
            echo json_encode(['message' => 'Invalid credentials']);
        }
    }
}
