<?php
require_once("database.php");
$pdo_statement=$conn->prepare("DELETE FROM users WHERE ID=" . $_GET['ID']);
$pdo_statement->execute();
header('location:users.php');
?>