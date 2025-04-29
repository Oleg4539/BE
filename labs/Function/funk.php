<?php
function sin_x($x) {
    return sin($x);
}

function cos_x($x) {
    return cos($x);
}

function tg_x($x) {
    return tan($x);
}

function my_tg($x) {
    return sin($x) / cos($x);
}

function pow_x_y($x, $y) {
    return pow($x, $y);
}

function factorial($n) {
    if ($n == 0) return 1;
    return $n * factorial($n - 1);
}
?>