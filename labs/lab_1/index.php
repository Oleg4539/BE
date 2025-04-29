<!-- 1 завдання -->
<?php
echo "Полину в мріях в купель океану,<br>";
echo "Відчую <b>шовковистість</b> глибини,<br>";
echo "Чарівні мушлі з дна собі дістану,<br>";
echo "&nbsp;Щоб <i><b>взимку</b></i><br>";
echo "&nbsp;&nbsp;<u>тішили</u><br>";
echo "&nbsp;&nbsp;&nbsp;мене<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;вони…<br><br>";

//2 завдання

$uah = 1500;
$usdRate = 39.5;
$usd = round($uah / $usdRate, 2); //обчислення

echo "$uah грн. можна обміняти на $usd доларів<br><br>";

//3 завдання

$month = 4;

if ($month >= 3 && $month <= 5) {
    echo "Весна<br><br>";
} elseif ($month >= 6 && $month <= 8) {
    echo "Літо<br><br>";
} elseif ($month >= 9 && $month <= 11) {
    echo "Осінь<br><br>";
} else {
    echo "Зима<br><br>";
}


//4 завдання

$letter = 'о';

switch (strtolower($letter)) {
    case 'а': case 'е': case 'є': case 'и': case 'і': case 'ї': case 'о': case 'у': case 'ю': case 'я':
        echo "$letter — голосна літера.<br><br>";
        break;
    default:
        echo "$letter — приголосна літера.<br><br>";
}

//5 завдання

$number = mt_rand(100, 999); //рандомне число
echo "Число: $number <br>";

$digits = str_split($number);
echo "Сума цифр: " . array_sum($digits) . "<br>"; //сума всіх цифр

$reversed = implode('', array_reverse($digits));
echo "Число у зворотному порядку: $reversed <br>";

rsort($digits);
$maxNumber = implode('', $digits);
echo "Найбільше число: $maxNumber<br><br>";

//6 завдання

function drawTable($rows, $cols) {
    echo "<table border='1' style='border-collapse: collapse;'>";
    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
            echo "<td style='width: 50px; height: 50px; background-color: $color;'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

drawTable(5, 5);
?>