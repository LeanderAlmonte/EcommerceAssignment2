<?php

namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__) . "/core/db/dbconnectionmanager.php");

class Project {
    private $projectID;
    private $name;
    private $budget;
    private $status;

    private $dbConnection;

    // Constructor
    public function __construct() {
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    // Getter and setter for projectID
    public function getProjectID() {
        return $this->projectID;
    }

    public function setProjectID($id) {
        $this->projectID = $id;
    }

    // Getter and setter for name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Getter and setter for budget
    public function getBudget() {
        return $this->budget;
    }

    public function setBudget($budget) {
        $this->budget = $this->validateBudget($budget);
    }

    // Getter and setter for status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    private function validateBudget($budget) {
        if ($budget <= 0) {
            throw new Exception("Budget must be a positive number greater than zero.");
        }
        return (double) $budget;
    }

    // Function to validate user input
function validateInput($data) {
    // Trim whitespace from the beginning and end of the input
    $data = trim($data);
    // Remove backslashes from the input
    $data = stripslashes($data);
    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}


    // Read all projects
    public function read() {
        $query = "SELECT * FROM projects";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Read a single project by ID
    public function readOne() {
        $query = "SELECT * FROM projects WHERE projectID = :projectID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':projectID', $this->projectID);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Project::class);
    }
}
