<?php

session_start();
include '../db_config.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM users_feedback WHERE id=$id";
    $connect->query($sql);
}

header('location:crud-user_feedback.php');
?>
