<?php
abstract class Human {
    protected $height, $weight, $age;

    public function __construct($h, $w, $a) {
        $this->height = $h;
        $this->weight = $w;
        $this->age = $a;
    }

    public function getHeight() { return $this->height; }
    public function setHeight($h) { $this->height = $h; }

    public function getWeight() { return $this->weight; }
    public function setWeight($w) { $this->weight = $w; }

    public function getAge() { return $this->age; }
    public function setAge($a) { $this->age = $a; }

    abstract protected function onChildBorn();
    public function birthChild() {
        $this->onChildBorn();
    }
}
