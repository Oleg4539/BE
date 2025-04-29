<?php
require_once 'HouseCleaning.php';
require_once 'Human.php';

class Programmer extends Human implements HouseCleaning {
    private $languages = [], $experience;

    public function __construct($h, $w, $a, $langs, $exp) {
        parent::__construct($h, $w, $a);
        $this->languages = $langs;
        $this->experience = $exp;
    }

    public function addLanguage($lang) {
        $this->languages[] = $lang;
    }

    public function cleanRoom() {
        echo "Програміст прибирає кімнату\n";
    }

    public function cleanKitchen() {
        echo "Програміст прибирає кухню\n";
    }

    protected function onChildBorn() {
        echo "Програміст став батьком!\n";
    }
}
