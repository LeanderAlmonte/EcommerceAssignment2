<?php

namespace models;

use Exception;

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
        $name = $this->validateInput($name);
        if (empty($name)) {
            throw new Exeption("Project name is required.");
        }
        $this->name = $name;
    }

    // Getter and setter for budget
    public function getBudget() {
        return $this->budget;
    }

    public function setBudget($budget) {
        if (!is_numeric($budget) || $budget === " " || $budget <= 0) {
            throw new Exception("Budget is required and must be a valid number");

        }
        $this->budget = $budget;
    }

    // Getter and setter for status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
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
