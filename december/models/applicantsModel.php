<?php
require_once 'database.php';

class ApplicantsModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function createApplicant($data) {
        $stmt = $this->db->prepare("INSERT INTO nurses (firstName, lastName, yearsOfExperience, specialization, licenseNumber, preferredShift, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssi", $data['firstName'], $data['lastName'], $data['yearsOfExperience'], $data['specialization'], $data['licenseNumber'], $data['preferredShift'], $data['created_by']);
        return $stmt->execute();
    }
}
