<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "tasklist";

$connection = new mysqli($host, $username, $password, $database);
if ($connection->connect_error) {
    die("Подключение не произошло: " . $connection->connect_error);
}

echo "Подключение успешно";

return $connection;
