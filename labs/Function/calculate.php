<?php
require_once(__DIR__ . "/funk.php");

$x = $_POST['x'];
$y = $_POST['y'];

$pow = pow_x_y($x, $y);
$fact = factorial($x);
$mytg = my_tg($x);
$sin = sin_x($x);
$cos = cos_x($x);
$tg = tg_x($x);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Результати</title>
    <style>
        table {
            border-collapse: collapse;
            background-color: yellow;
        }
        th, td {
            border: 1px solid black;
            padding: 8px 12px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>x<sup>y</sup></th>
            <th>x!</th>
            <th>my_tg(x)</th>
            <th>sin(x)</th>
            <th>cos(x)</th>
            <th>tg(x)</th>
        </tr>
        <tr>
            <td><?php echo $pow; ?></td>
            <td><?php echo $fact; ?></td>
            <td><?php echo $mytg; ?></td>
            <td><?php echo $sin; ?></td>
            <td><?php echo $cos; ?></td>
            <td><?php echo $tg; ?></td>
        </tr>
    </table>
</body>
</html>