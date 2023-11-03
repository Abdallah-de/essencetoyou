<?php
session_start();
include('../db_config.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php');
    exit();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Get the form data and apply basic sanitization
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Check for valid username and password
    if (empty($username) || empty($password)) {
        header('Location: ../login.php?login_error=1');
        exit();
    }

    // Hash the entered password using MD5
    $hashed_password = md5($password);

    // Query the database for user authentication using prepared statements
    $stmt = $connect->prepare("SELECT id, username, password FROM admin WHERE username=? AND password=? LIMIT 1");
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $user_name, $db_password);
        $stmt->fetch();

        // Successful login, set session variables and redirect to admin panel
        $_SESSION['id'] = $user_id;
        $_SESSION['username'] = $user_name;
        $stmt->close(); // Close the statement
        header('Location: crud-user_feedback.php');
        exit();
    } else {
        // Invalid credentials, redirect back to login page with error
        header('Location: ../login.php?login_error=1');
        exit();
    }
} else {
    // Handle case where form data is not set
    header('Location: ../login.php');
    exit();
}
?>
