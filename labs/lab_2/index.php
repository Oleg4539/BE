<!-- завдання 4 -->
<?php
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + (60 * 60 * 24 * 30 * 6), '/');
    $_COOKIE['lang'] = $lang; // тимчасово, щоб бачити результат одразу
}

$lang = $_COOKIE['lang'] ?? 'ukr';

switch ($lang) {
    case 'ukr':
        $message = 'Вибрана мова: Українська';
        break;
    case 'eng':
        $message = 'Selected language: English';
        break;
    default:
        $message = 'Мова не визначена';
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2><?= $message ?></h2>

<p>Оберіть мову:</p>
  <a href="index.php?lang=ukr">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/49/Flag_of_Ukraine.svg" alt="Українська" width="60" height="40">
    </a>

    <a href="index.php?lang=eng">
        <img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg" alt="English" width="60" height="40">
    </a>
<!-- 1 завдання -->

    <style>
        body { font-family: Arial; padding: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="number"] { width: 300px; }
        textarea { width: 300px; height: 60px; }
        .section { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
    </style>

<form method="post">
    
    <div class="section">
        <h3>1. Заміна символів у тексті</h3>
        <label>Текст: <input type="text" name="text1" required></label>
        <label>Знайти: <input type="text" name="find1" required></label>
        <label>Замінити на: <input type="text" name="replace1" required></label>
    </div>

    <div class="section">
        <h3>2. Сортування назв міст за алфавітом</h3>
        <label>Введіть міста через пробіл: <input type="text" name="cities" required></label>
    </div>

    <div class="section">
        <h3>3. Отримання імені файлу без розширення</h3>
        <label>Шлях до файлу: <input type="text" name="filepath" required></label>
    </div>

    <div class="section">
        <h3>4. Різниця між датами</h3>
        <label>Дата 1 (ДД-ММ-РРРР): <input type="text" name="date1" required></label>
        <label>Дата 2 (ДД-ММ-РРРР): <input type="text" name="date2" required></label>
    </div>

    <div class="section">
        <h3>5. Генератор пароля</h3>
        <label>Довжина пароля: <input type="number" name="pass_length" min="4" required></label>
    </div>

    <div class="section">
        <h3>6. Перевірка міцності пароля</h3>
        <label>Введіть пароль для перевірки: <input type="text" name="check_pass" required></label>
    </div>

    <input type="submit" value="Виконати всі завдання">

</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Завдання 1.1
    function replaceText($text, $find, $replace) {
        return str_replace($find, $replace, $text);
    }

    // Завдання 1.2
    function sortCities($citiesInput) {
        $cities = explode(' ', $citiesInput);
        sort($cities, SORT_STRING | SORT_FLAG_CASE);
        return implode(' ', $cities);
    }

    // Завдання 1.3
    function getFilename($path) {
        $filenameWithExt = basename(trim($path));
        return pathinfo($filenameWithExt, PATHINFO_FILENAME);
    }

    // Завдання 1.4
    function daysBetween($d1, $d2) {
        $date1 = DateTime::createFromFormat('d-m-Y', $d1);
        $date2 = DateTime::createFromFormat('d-m-Y', $d2);
    
        if (!$date1 || !$date2) {
            return "Помилка: неправильний формат дати. Використовуйте ДД-ММ-РРРР.";
        }
    
        return abs($date1->diff($date2)->days);
    }

    // Завдання 1.5
    function generatePassword($length) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $password;
    }

    // Завдання 1.6
    function isStrongPassword($password) {
        if (
            strlen($password) >= 8 &&
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[a-z]/', $password) &&
            preg_match('/[0-9]/', $password) &&
            preg_match('/[\W_]/', $password)
        ) {
            return true;
        }
        return false;
    }

    // Обробка даних
    echo "<div class='section'><h3>Результати:</h3>";

    $res1 = replaceText($_POST["text1"], $_POST["find1"], $_POST["replace1"]);
    echo "<b>1)</b> Результат заміни: <i>$res1</i><br>";

    $res2 = sortCities($_POST["cities"]);
    echo "<b>2)</b> Міста за алфавітом: <i>$res2</i><br>";

    $res3 = getFilename($_POST["filepath"]);
    echo "<b>3)</b> Ім’я файлу без розширення: <i>$res3</i><br>";

    $res4 = daysBetween($_POST["date1"], $_POST["date2"]);
    echo "<b>4)</b> Кількість днів між датами: <i>$res4</i><br>";

    $res5 = generatePassword((int)$_POST["pass_length"]);
    echo "<b>5)</b> Згенерований пароль: <i>$res5</i><br>";

    $res6 = isStrongPassword($_POST["check_pass"]) ? "Пароль міцний" : "Пароль слабкий";
    echo "<b>6)</b> Перевірка пароля: <i>$res6</i><br>";

    echo "</div>";
}
?>

<?php

// Завдання 2.1
function findDuplicates($array) {
    $duplicates = array();
    $counts = array_count_values($array);

    foreach ($counts as $value => $count) {
        if ($count > 1) {
            $duplicates[] = $value;
        }
    }

    return $duplicates;
}

// Завдання 2.2
function generateName($syllables) {
    $name = '';
    $length = rand(2, 4);
    for ($i = 0; $i < $length; $i++) {
        $name .= $syllables[array_rand($syllables)];
    }

    return ucfirst($name);
}

// Завдання 2.3
function createArray() {
    $length = rand(3, 7);
    $array = array();

    for ($i = 0; $i < $length; $i++) {
        $array[] = rand(10, 20);
    }

    return $array;
}

// Завдання 2.4
function mergeAndSortArrays($array1, $array2) {
    $merged = array_merge($array1, $array2);
    $unique = array_unique($merged);
    sort($unique);

    return $unique;
}

// Завдання 2.5
function sortAssociativeArray($array, $by = 'name') {
    if ($by === 'name') {
        ksort($array);
    } elseif ($by === 'age') {
        asort($array);
    }

    return $array;
}

echo "<h2>Завдання 2.1</h2>";
$array1 = [1, 2, 2, 3, 4, 4, 5];
$duplicates = findDuplicates($array1);
echo "Повторювані елементи: " . implode(", ", $duplicates) . "<br>";

echo "<br>";

echo "<h2>Завдання 2.2</h2>";
$syllables = ["Pa", "Mo", "Lu", "Ra", "Ta"];
$generatedName = generateName($syllables);
echo "Згенероване ім'я: " . $generatedName . "<br>";

echo "<br>";

echo "<h2>Завдання 2.3</h2>";
$array2 = createArray();
echo "Створений масив: " . implode(", ", $array2) . "<br>";

echo "<br>";

echo "<h2>Завдання 2.4</h2>";
$array3 = createArray();
$array4 = createArray();
echo "Масив 1: " . implode(", ", $array3) . "<br>";
echo "Масив 2: " . implode(", ", $array4) . "<br>";
$mergedSorted = mergeAndSortArrays($array3, $array4);
echo "Об'єднаний і відсортований масив: " . implode(", ", $mergedSorted) . "<br>";

echo "<br>";

echo "<h2>Завдання 2.5</h2>";
$users = array(
    "Alice" => 25,
    "Bob" => 30,
    "Charlie" => 20,
    "Dave" => 35
);
echo "Сортування за іменами:<br>";
$sortedByName = sortAssociativeArray($users, 'name');
echo "Сортування за іменами: " . implode(", ", array_keys($sortedByName)) . "<br>";

echo "<br>";

echo "Сортування за віком:<br>";
$sortedByAge = sortAssociativeArray($users, 'age');
echo "Сортування за віком: " . implode(", ", $sortedByAge) . "<br>";
echo "<h2>Завдання 3</h2>";
?>
<!-- завдання 3.3 -->
<?php
session_start();

function old($key, $default = '') {
    return isset($_SESSION[$key]) ? htmlspecialchars($_SESSION[$key]) : $default;
}

$games = ["CS 2", "Rust", "DayZ", "Squad", "Stalker"];
$cities = ["Житомир", "Київ", "Львів", "Харків"];
?>
    <form action="handle.php" method="post" enctype="multipart/form-data">
        <label>Логін: <input type="email" name="login" value="<?= old('login') ?>"></label><br>
        <label>Пароль: <input type="password" name="password"></label><br>
        <label>Пароль (ще раз): <input type="password" name="confirm_password"></label><br>

        Стать:
        <label><input type="radio" name="gender" value="чоловік" <?= old('gender') == 'чоловік' ? 'checked' : '' ?>> чоловік</label>
        <label><input type="radio" name="gender" value="жінка" <?= old('gender') == 'жінка' ? 'checked' : '' ?>> жінка</label><br>

        Місто:
        <select name="city">
            <?php foreach ($cities as $city): ?>
                <option value="<?= $city ?>" <?= old('city') == $city ? 'selected' : '' ?>><?= $city ?></option>
            <?php endforeach; ?>
        </select><br>

        Улюблені ігри:<br>
        <?php foreach ($games as $game): ?>
            <label>
                <input type="checkbox" name="games[]" value="<?= $game ?>"
                    <?= (isset($_SESSION['games']) && in_array($game, $_SESSION['games'])) ? 'checked' : '' ?>>
                <?= $game ?>
            </label><br>
        <?php endforeach; ?>

        <label>Про себе:<br>
            <textarea name="about" rows="5" cols="40"><?= old('about') ?></textarea>
        </label><br>

        <label>Фотографія:
            <input type="file" name="photo">
        </label><br><br>

        <button type="submit">Зареєструватися</button>
    </form>
    </body>
    </html>