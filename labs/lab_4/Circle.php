<?php
class Circle {
    private $x;
    private $y;
    private $radius;

    public function __construct($x, $y, $radius) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function __toString() { //цей метод викликається, коли об’єкт намагаються вивести як рядок:
        return "Коло з центром в ($this->x, $this->y) і радіусом $this->radius";
    }

    public function getX() { return $this->x; }//отримання
    public function getY() { return $this->y; }
    public function getRadius() { return $this->radius; }

    public function setX($x) { $this->x = $x; }// заміна
    public function setY($y) { $this->y = $y; }
    public function setRadius($radius) { $this->radius = $radius; }

    public function intersects(Circle $circle) {//перетин кіл
        $distance = sqrt(pow($this->x - $circle->getX(), 2) + pow($this->y - $circle->getY(), 2));
        return $distance < ($this->radius + $circle->getRadius());
    }
}
