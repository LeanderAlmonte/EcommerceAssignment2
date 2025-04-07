<?php

require_once (dirname(__DIR__).'/models/project.php');
require_once (dirname(__DIR__).'/models/employee.php');

use PHPUnit\Framework\TestCase;
use models\Project;
use models\Employee;

class Assignment2Test extends TestCase {

    public function testBudget() {
        $project = new Project();
        $project->setBudget(100);
        $this->assertEquals(100, $project->getBudget());
    }

    public function testInvalidBudget() {

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Budget must be greater than zero.");
        $project = new Project();
        $project->setBudget(0);

    }

    // Test the validateEmployeeRecord method
    public function testValidateEmployeeRecord() {
      // Create an instance of the Employee class
      $employee = new Employee();

      // Test when the firstName is empty
      $employee->setFirstName("");
      $employee->setTitle("Manager");
      $employee->setDepartmentID(1);
      $this->assertEquals("First Name is required.", $employee->validateEmployeeRecord());

      // Test when the title is empty
      $employee->setFirstName("John");
      $employee->setTitle("");
      $employee->setDepartmentID(1);
      $this->assertEquals("Title is required.", $employee->validateEmployeeRecord());

      // Test when the departmentID is empty
      $employee->setFirstName("John");
      $employee->setTitle("Manager");
      $employee->setDepartmentID(null);
      $this->assertEquals("Department ID is required.", $employee->validateEmployeeRecord());

      // Test when all fields are valid
      $employee->setFirstName("John");
      $employee->setTitle("Manager");
      $employee->setDepartmentID(1);
      $this->assertTrue($employee->validateEmployeeRecord());
    }

}