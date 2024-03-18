<?php

$errors = '';

$db_connect = mysqli_connect('localhost', 'root', 'root', 'todolist'); 

if (isset($_POST['submit'])) {
    $task = $_POST['task'];

    
    if (empty($task)) {
        $errors = "Enter the task! (Введите задачу!)";
    } else {
        mysqli_query($db_connect, "INSERT INTO tasks(task) VALUES('$task')"); // Функция Mysqli_query выполняет запрос к базе данных MySQL.
        header('Location: index.php');
    }
}


if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($db_connect, "DELETE FROM tasks WHERE id=$id");
    header('Location: index.php');
}

$tasks = mysqli_query($db_connect, "SELECT * FROM tasks"); 


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="To-Do List">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Todo List</title>
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="main_menu_brend">
                <h1>Todo list application with PHP and MySQL</h1>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                    <form action="index.php" method="post">
                        <?php if (isset($errors)) : ?>
                        <p><?= $errors; ?></p>
                        <?php endif; ?>
                        <div class="input-group mb-3">
                            <input name="task" type="text" class="form-control" placeholder="Enter the task"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" name="submit" type="submit" id="button-addon2">Add
                                Task</button>
                        </div>
                    </form>
                    <div class="style_table">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="table-success" scope="col">№</th>
                                    <th class="table-info"" scope=" col">Task</th>
                                    <th class="table-danger" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row = mysqli_fetch_array($tasks)) : ?>
                                <tr class="table-warning">
                                    <th scope="row"><?= $i; ?></th>
                                    <td class="task"><?= $row['task']; ?></td>
                                    <td class="delete"><a href="index.php?del_task=<?= $row['id']; ?>">x</a></td>
                                </tr>
                                <?php $i++;
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>