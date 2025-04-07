<?php

require_once (dirname(__DIR__).'/models/project.php');

use PHPUnit\Framework\TestCase;
use models\Project;

class Assignment2Test extends TestCase {

    public function testBudget() {
        $project = new Project();
        $project->setBudget(100);
        $this->assertEquals(100, $project->getBudget());
    }

}