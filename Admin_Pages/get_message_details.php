<?php
include '../db_config.php';

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users_feedback WHERE id=$id";
    $result = $connect->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'Message not found.'));
    }
} else {
    echo json_encode(array('error' => 'Invalid message ID.'));
}

$connect->close();
?>
