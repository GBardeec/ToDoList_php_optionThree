<?php
require_once("database_auth.php");

$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);
$created_at = date('Y-m-d H:i:s');

if(isset($login) && isset($password)){
    $sqlCheck = "SELECT * FROM users WHERE login = '$login'";

    $result = $connection->query($sqlCheck);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $login;
            header("Location: ../../resources/views/index.php");
        }else{
            echo "Неправильный пароль";
        }
    }else{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sqlRegister = "INSERT INTO users (login, password, created_at) VALUES ('$login', '$hashedPassword', '$created_at')";


        if($connection->query($sqlRegister)){
            session_start();
            $_SESSION['id'] = $connection->insert_id;
            $_SESSION['login'] = $login;
            header("Location: ../../resources/views/index.php");
        }else{
            echo "Ошибка при регистрации";
        }
    }
}
?>
