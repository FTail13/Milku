<?php
require_once '../models/database.php';
require_once '../models/applicantsModel.php';
require_once 'log_activity.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $applicantsModel = new ApplicantsModel();

    if ($action === 'create') {
        $data = [
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'yearsOfExperience' => $_POST['yearsOfExperience'],
            'specialization' => $_POST['specialization'],
            'licenseNumber' => $_POST['licenseNumber'],
            'preferredShift' => $_POST['preferredShift'],
            'created_by' => $_SESSION['user_id'] ?? null
        ];

        $result = $applicantsModel->createApplicant($data);

        if ($result) {
            log_activity($_SESSION['user_id'], 'Insert', "Added a nurse: {$data['firstName']} {$data['lastName']}");
            echo json_encode(['message' => 'Nurse added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add nurse']);
        }
    }
}
