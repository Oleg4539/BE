<?php
require_once 'autoload.php';
require_once 'Circle.php';
require_once 'FileManager.php';
require_once 'Student.php';
require_once 'Programmer.php';

use Models\UserModel;
use Controllers\UserController;
use Views\UserView;

$model = new UserModel();
$controller = new UserController();
$view = new UserView();

echo $model->getUserName() . "\n";
$controller->showMessage();
echo "\n";
$view->render();
echo "\n";

// Перевірка Circle
$circle1 = new Circle(0, 0, 5);
$circle2 = new Circle(3, 4, 5);
echo $circle1 . "\n";
echo $circle1->intersects($circle2) ? "Кола перетинаються\n" : "Не перетинаються\n";

// Статичні методи
if (!is_dir("text")) mkdir("text");
FileManager::writeFile("test.txt", "Hello world\n");
echo FileManager::readFile("test.txt");
//FileManager::clearFile("test.txt");

// Люди, студенти, програмісти
$student = new Student(180, 70, 20, "КНУ", 2);
$student->increaseCourse();
$student->cleanRoom();
$student->birthChild();

$programmer = new Programmer(175, 80, 25, ["PHP"], 5);
$programmer->addLanguage("Python");
$programmer->cleanKitchen();
$programmer->birthChild();
