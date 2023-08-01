<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "tasklist";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = new mysqli($host, $username, $password, $database);
?>