<?php
require_once '../config/database.php';

class ApplicantsModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Create applicant
    public function createApplicant($data) {
        try {
            $query = "INSERT INTO nurses (firstName, lastName, yearsOfExperience, specialization, licenseNumber, preferredShift)
                      VALUES (:firstName, :lastName, :yearsOfExperience, :specialization, :licenseNumber, :preferredShift)";
            $stmt = $this->conn->prepare($query);
    
            // Bind each value properly
            $stmt->bindParam(':firstName', $data['firstName']);
            $stmt->bindParam(':lastName', $data['lastName']);
            $stmt->bindParam(':yearsOfExperience', $data['yearsOfExperience']);
            $stmt->bindParam(':specialization', $data['specialization']);
            $stmt->bindParam(':licenseNumber', $data['licenseNumber']);
            $stmt->bindParam(':preferredShift', $data['preferredShift']);
    
            $stmt->execute();
            return ['message' => 'Applicant added successfully', 'statusCode' => 200];
        } catch (PDOException $e) {
            return ['message' => $e->getMessage(), 'statusCode' => 400];
        }
    }    



    // Read all applicants
    public function getAllApplicants() {
        $query = "SELECT * FROM nurses";
        $stmt = $this->conn->query($query);
        return ['querySet' => $stmt->fetchAll(PDO::FETCH_ASSOC), 'statusCode' => 200];
    }

    // Update applicant
    public function updateApplicant($data) {
        try {
            $query = "UPDATE nurses SET firstName = :firstName, lastName = :lastName, 
                      yearsOfExperience = :yearsOfExperience, specialization = :specialization,
                      licenseNumber = :licenseNumber, preferredShift = :preferredShift 
                      WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($data);
            return ['message' => 'Applicant updated successfully', 'statusCode' => 200];
        } catch (PDOException $e) {
            return ['message' => $e->getMessage(), 'statusCode' => 400];
        }
    }

    // Delete applicant
    public function deleteApplicant($id) {
        try {
            $query = "DELETE FROM nurses WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return ['message' => 'Applicant deleted successfully', 'statusCode' => 200];
        } catch (PDOException $e) {
            return ['message' => $e->getMessage(), 'statusCode' => 400];
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
?>