<?php
require_once("./utils/tools.php");
session_start();

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "SELECT * from users";
$stmt = $pdo->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);



$author = $_SESSION['role'] == 'author';
$admin = $_SESSION['role'] == 'admin';
$editor = $_SESSION['role'] == 'editor';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <h1>User Manager</h1>
        <form action="add.php" method="post">
            <input type="email" name="email" placeholder="Email" class="form-control mb-3" id="">
            <input type="password" name="pass" placeholder="Password" class="form-control mb-3" id="">
            <select name="role" class="form-select mb-3" id="">
                <option value="">Sélectionnez un rôle</option>
                <option value="admin">Admin</option>
                <option value="author">author</option>
                <option value="editor">Editor</option>
                <option value="guest">Guest</option>
            </select>
            <button class="btn btn-outline-primary mb-4 d-block w-100">Envoyer</button>
        </form>
        <?php if ($editor || $admin || $author) : ?>
            <table class="table table-stripped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>MAIL</th>
                        <th>PASSWORD</th>
                        <th>ROLE</th>
                        <?php if ($admin) : ?>
                            <th></th>
                        <?php endif ?>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <?php if (true) : ?>
                            <tr>
                                <td class="text-center">
                                    <?= $user['id'] ?>
                                </td>
                                <td>
                                    <?= $user['email'] ?>
                                </td>
                                <td>
                                    <?= $user['password'] ?>
                                </td>
                                <td>
                                    <?= $user['role'] ?>
                                </td>
                                <?php if ($admin) : ?>
                                    <td class="text-center">
                                        <a onclick="valider(event)" href="del.php?iddd=<?= $user['id'] ?>" class="btn btn-outline-danger text-center"><i class="bi bi-trash"></i></a>
                                    </td>
                                <?php endif ?>
                                <td class="text-center">
                                    <?php if ($editor || $admin || $author) : ?>
                                        <?php if ($_SESSION['email'] == $user['email'] || $admin) : ?>
                                            <a href="edit.php?iddd=<?= $user['id'] ?>" class="btn btn-outline-primary text-center"><i class="bi bi-pencil"></i></a>
                                        <?php endif ?>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>

    <?php if ($editor || $admin || $author) : ?>
        <?php
        log_r($users);
        log_r($_REQUEST);
        ?>
    <?php endif ?>
    <script>
        function valider(evt) {
            evt.preventDefault();
            if (confirm('Etes-cous sûr de .....')) {
                location.href = evt.target.href
            }

        }
    </script>
</body>

</html>