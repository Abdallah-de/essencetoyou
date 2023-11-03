<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="../assets/photos/favicon.jpg">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="/Admin_Pages/admin.css">

</head>
<body>
    <div class="body">
        <div class="page">
            <div class="container">
            <form action="/Admin_Pages/login_process.php" method="post">

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <input type="submit" id="submit" value="Login" class="button-login">
                </form>

                <a href="../index.html">
                    <button> 
                        Back
                    </button>
                </a>

                <?php
                    if(isset($_GET['login_error'])) {
                        echo '<div class="alert alert-danger" role="alert">Incorrect username or password. Please try again.</div>';
                    }
                    if(isset($_GET['login_success'])) {
                        echo '<div class="alert alert-success" role="alert">Welcome! You have successfully logged in.</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>