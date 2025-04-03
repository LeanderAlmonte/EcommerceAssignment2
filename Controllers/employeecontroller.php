<?php

namespace controllers;

use models\Employee;
use views\EmployeeList;

require(dirname(__DIR__)."/models/employee.php");
require(dirname(__DIR__)."/resources/views/employees/employeeslist.php");


class EmployeeController{

    private Employee $employee;

    public function read(){

        $employee = new Employee();
        $data = $employee->read();
        
        (new EmployeeList())->render($data);

        // Another option is to remove the echo from the view Just return HTML
        // then the controller returns the view as the requested resource
        // and it will be written to the response's body 
        // If we used return in the view then we can return the data
       //return  (new EmployeeList())->render($data);
    }
}

/*TEST

$employeeController = new EmployeeController();
$employeeController->read();

*/
