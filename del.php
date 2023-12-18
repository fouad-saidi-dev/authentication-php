<?php
$id = $_GET['iddd'];


require_once("./utils/tools.php");

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "DELETE FROM users WHERE id=$id";
$stmt = $pdo->exec($sql);

header("location:/");