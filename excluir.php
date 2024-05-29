<?php
require("./auth.php");
require('./data/conexao.php');

$id = $_POST["id"];

$sql = "DELETE FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

header("Location: /admin.php");