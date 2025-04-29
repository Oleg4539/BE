<?php
require_once 'HouseCleaning.php';
require_once 'Human.php';

class Student extends Human implements HouseCleaning {
    private $university, $course;

    public function __construct($h, $w, $a, $univ, $course) {
        parent::__construct($h, $w, $a);
        $this->university = $univ;
        $this->course = $course;
    }

    public function increaseCourse() {
        $this->course++;
    }

    public function cleanRoom() {
        echo "Студент прибирає кімнату\n";
    }

    public function cleanKitchen() {
        echo "Студент прибирає кухню\n";
    }

    protected function onChildBorn() {
        echo "Студент став батьком!\n";
    }
}
