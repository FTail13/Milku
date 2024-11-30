<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the database configuration
include_once('../config/database.php');

// Class for handling applicants
class ApplicantsController {
    private $conn;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Add a new nurse
    public function createApplicant($data) {
        try {
            $query = "INSERT INTO nurses (firstName, lastName, yearsOfExperience, specialization, licenseNumber, preferredShift) 
                      VALUES (:firstName, :lastName, :yearsOfExperience, :specialization, :licenseNumber, :preferredShift)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($data);
            return ['message' => 'Nurse added successfully', 'statusCode' => 200];
        } catch (PDOException $e) {
            return ['message' => 'Error: ' . $e->getMessage(), 'statusCode' => 400];
        }
    }

    // Search applicants
    public function searchApplicants($keyword) {
        $query = "SELECT * FROM nurses WHERE 
                  firstName LIKE :keyword OR 
                  lastName LIKE :keyword OR 
                  specialization LIKE :keyword OR 
                  licenseNumber LIKE :keyword OR 
                  preferredShift LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return ['querySet' => $stmt->fetchAll(PDO::FETCH_ASSOC), 'statusCode' => 200];
    }
}

// Initialize the database connection
$database = new Database();
$db = $database->getConnection();
$controller = new ApplicantsController($db);

// Handle POST request to create a new applicant
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $data = [
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'yearsOfExperience' => $_POST['yearsOfExperience'],
            'specialization' => $_POST['specialization'],
            'licenseNumber' => $_POST['licenseNumber'],
            'preferredShift' => $_POST['preferredShift']
        ];
        $response = $controller->createApplicant($data);
        echo json_encode($response);
        exit;
    }
}

// Handle GET request for searching applicants
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $response = $controller->searchApplicants($keyword);
    echo json_encode($response);
    exit;
}
?>
