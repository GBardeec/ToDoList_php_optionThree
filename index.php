<?php include("resources/views/layouts/header.php"); ?>
<main>
    <div class="container">
        <?php if (isset($_SESSION['login'])): ?>
        <div class="row justify-content-center">
            <form class="col-4" method="POST" name="tasksform" action="controller/tasks/add_tasks.php">
                <h5 class="text-center">Список неподтвержденных задач</h5>
                <div class="input-group mb-3">
                    <input type="text" name="description" required class="form-control" placeholder="Введите текст"
                           aria-describedby="basic-addon2">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Добавить</button>
                    </div>
                </div>
            </form>
            <div class="row justify-content-center">
                <div class="col-4">
                    <div>
                        <div>
                            <?php
                            require_once("controller/tasks/show_tasks.php");

                            $resultStatusNull = getTasksWithStatusNull($pdo, $_SESSION['id']);
                            $resultStatusNotNull = getTasksWithStatusNotNull($pdo, $_SESSION['id']);

                            if (count($resultStatusNull) > 0) {
                                echo "<ul class='list-group mb-3'>";
                                foreach ($resultStatusNull as $row) {
                                    echo "<li class='list-group-item pt-1'>" .  htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</li>";
                                }
                                echo "</ul>";
                                echo "<div class='btn-group d-flex justify-content-between'>";
                                    echo "<form method='POST' class='' action='" . addDomainToUrl('/controller/tasks/delete_all_tasks.php') . "'>";
                                        echo "<input type='submit' name='deleteAll' value='Удалить все' class='btn btn-danger mr-2'>";
                                    echo "</form>";
                                    echo "<form method='POST' class='' action='" . addDomainToUrl('/controller/tasks/change_status_all_tasks.php') . "'>";
                                        echo "<input type='submit' name='readyAll' value='Подтвертить все' class='btn btn-success'>";
                                    echo "</form>";
                                echo "</div>";
                            } else {
                                echo "<p class='text-center'>
                                    <small>
                                        Нет неподтвержденных задач
                                    </small>
                                </p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <h5 class="text-center">Список подтвержденных задач</h5>
                <div class="row justify-content-center">
                    <div class="col-4">
                        <?php
                        if (count($resultStatusNotNull) > 0) {
                            echo "<ul class='list-group'>";
                            foreach ($resultStatusNotNull as $row) {
                                $statusClass = changeBackGroundColor($row);

                                echo "<li class='list-group-item mt-3 " . $statusClass . "'>" . 'Задача: ' . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</li>";
                                echo "<li class='list-group-item mb-1'>" . 'Статус: ' . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . "</li>";

                                echo "<div class='btn-group d-flex justify-content-between'>";
                                    echo "<form method='POST' class='' action='" . addDomainToUrl('/controller/tasks/delete_one_tasks.php') . "'>";
                                        echo "<input type='hidden' name='taskId' value='" . $row['id'] . "'>";
                                        echo "<input type='submit' name='deleteOne' value='Удалить' class='btn btn-danger mr-2'>";
                                    echo "</form>";
                                    echo "<form method='POST' class='' action='" . addDomainToUrl('/controller/tasks/toogle_status_tasks.php') . "'>";
                                        echo "<input type='hidden' name='taskId' value='" . $row['id'] . "'>";
                                        echo "<input type='submit' name='toggleStatus' value='Изменить статус' class='btn btn-success' 
                                    onclick='changeBackGroundColor(" . json_encode($row) . ")'>";
                                    echo "</form>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p class='text-center'>
                                <small>
                                    Нет подтвержденных задач
                                </small>
                            </p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <p class="text-center">Что бы добавить задачу <a class="link-primary" data-bs-toggle="modal"
                                                                 data-bs-target="#login">авторизуйтесь</a></p>
            <?php endif; ?>
        </div>
</main>
<?php include("resources/views/layouts/footer.php"); ?>

<?php
function changeBackGroundColor($row)
{
    $statusClass = '';
    if ($row['status'] == 'ready') {
        $statusClass = 'list-group-item-success';
    } elseif ($row['status'] == 'unready') {
        $statusClass = 'list-group-item-danger';
    }
    return $statusClass;
}

?>
