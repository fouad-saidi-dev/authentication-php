<?php
require_once("./utils/tools.php");
$id = $_GET['iddd'];
$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "SELECT * from users WHERE id=?";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user) header('location:/')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php?</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <h1>User Manager</h1>
        <form action="save.php" method="post">
            <input type="hidden" name="iddd" value="<?= $id ?>">
            <input type="email" name="email" placeholder="Email" class="form-control mb-3" id="" value="<?= $user['email'] ?>">
            <input type="password" name="pass" placeholder="Password" class="form-control mb-3" id="" value="<?= $user['password'] ?>">
            <select name="role" class="form-select mb-3" id="">
                <option value="">Sélectionnez un rôle</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="author"  <?= $user['role'] === 'author' ? 'selected' : '' ?>>author</option>
                <option value="editor"  <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                <option value="guest"  <?= $user['role'] === 'guest' ? 'selected' : '' ?>>Guest</option>
            </select>
            <button class="btn btn-outline-primary mb-4 d-block w-100">Envoyer</button>
        </form>
    </div>
</body>
</html>