<?php
require_once("./utils/tools.php");


if (isset($_POST['submit'])) {
    if ($_POST['email'] == '' or $_POST['pass'] == '') {
        echo "un champ est null";
    } else {
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
    }
}

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "SELECT * FROM users WHERE email = '$email' and password = '$pass' ";
$stmt = $pdo->exec($sql);

echo $stmt;

//header("location:/");