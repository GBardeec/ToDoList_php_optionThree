<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To do list</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../resources/css/style.css" rel="stylesheet">
</head>
<body>
<?php
session_start();
?>
<header class="mt-3 mb-5">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid pl-0">
                <div class="navbar-brand fs-4 mr-3">To do list</div>
                <?php if (isset($_SESSION['login'])): ?>
                    <a type="button" class="btn btn-secondary" href="../../controller/auth/logout.php">
                        Выйти
                    </a>
                <?php else: ?>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#login">
                        Авторизация
                    </button>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <section>
        <!-- Модальное окно-->
        <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Поле авторизиации/регистрации</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" name="loginform" action="../../controller/auth/auth.php">
                            <div class="row mb-3">
                                <label for="login" class="col-md-4 col-form-label text-md-end">Имя пользователя</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login" autocomplete="email"
                                           autofocus required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control"
                                           name="password" required autocomplete="current-password">
                                    <small id="emailHelp" class="form-text text-muted">Если у вас отсутствует аккаунт -
                                        он будет автоматические создан</small>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-secondary">
                                    Войти
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
