<?php
session_start();
session_destroy();
header("Location: task2.php");
?>