<?php

$email = $_POST['email'];
$pass = md5($_POST['pass']);
$role = $_POST['role'] ? $_POST['role'] : 'guest';

require_once("./utils/tools.php");

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "INSERT INTO users VALUES(NULL, '$email','$pass','$role')";
$stmt = $pdo->exec($sql);

header("location:index.php");