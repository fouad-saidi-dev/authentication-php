<?php
require_once("./utils/tools.php");

session_start();


if (isset($_POST['submit'])) {
    if ($_POST['email'] == '' or $_POST['pass'] == '') {
        echo "un champ est null";
    } else {
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);

        $pdo = new PDO(
            "mysql:dbname=bdcc",
            "root",
            ""
        );

        $sql = "SELECT * FROM users WHERE password = '$pass' AND email = '$email' ";
        $stmt = $pdo->query($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            $_SESSION['role'] = $data['role'];
            header('location:index.php');
            log_r($data);
        } else {
            echo "error";
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container" style="width: 50%;">
        <form action="login.php" method="post">
            <input type="text" class="form-control" placeholder="email" name="email">
            <input type="text" class="form-control" placeholder="password" name="pass">
            <button name="submit" type="submit" class="btn btn-outline-success">Login</button>
        </form>
    </div>
</body>

</html>