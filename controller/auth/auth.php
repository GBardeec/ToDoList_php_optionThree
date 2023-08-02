<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/migration/000_database.php");

$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);
$created_at = date('Y-m-d H:i:s');

if(isset($login) && isset($password)){
    try {
        $sqlCheck = "SELECT * FROM users WHERE login = ?";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->execute([$login]);
        $user = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if($user){
            if(password_verify($password, $user['password'])){
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['login'] = $login;
                header("Location: /index.php");
            }else{
                echo "Неправильный пароль";
            }
        }else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sqlRegister = "INSERT INTO users (login, password, created_at) VALUES (?, ?, ?)";
            $stmtRegister = $pdo->prepare($sqlRegister);
            $stmtRegister->execute([$login, $hashedPassword, $created_at]);

            session_start();
            $_SESSION['id'] = $pdo->lastInsertId();
            $_SESSION['login'] = $login;
            header("Location: /index.php");
        }
    } catch(PDOException $e) {
        echo "Ошибка при регистрации: " . $e->getMessage();
    }
}
?>
