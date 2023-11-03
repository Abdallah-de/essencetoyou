<?php
session_start();
include '../db_config.php';

// Check if the admin is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$sql = "SELECT * FROM users_feedback";
$result = $connect->query($sql);

if (!$result) {
    die("Invalid query: " . $connect->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = $connect->prepare("DELETE FROM users_feedback WHERE id=?");
    $query->bind_param("i", $id);
    $deleteResult = $query->execute();

    if (!$deleteResult) {
        die("Error deleting message: " . $connect->error);
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin || User Messages Management</title>
    <link rel="stylesheet" href="CRUD.css">
    <link rel="icon" type="image/jpg" href="../assets/photos/favicon.jpg">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <nav class="navbar">
        <div class="nav-logo">
            <a href="../index.html"><img src="../assets/photos/logo.png" alt="Logo"></a>
        </div>
        <ul class="nav-menu">
            <li>
            <form method="post" action="admin-logout.php"> 
                <button type="submit" class="logout-btn" name="logout">Logout</button>
            </form>
            </li>
        </ul>
    </nav>
    <div class="container my-5">
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Sent_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['Sent_at']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm view-btn' data-id='{$row['id']}'>View</button>
                            <form method='post' style='display: inline;'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-danger btn-sm' name='delete'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for Message Details -->
    <div class="modal fade" id="messageDetailsModal" tabindex="-1" aria-labelledby="messageDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageDetailsModalLabel">Message Details</h5>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="name"></span></p>
                    <p><strong>Email:</strong> <span id="email"></span></p>
                    <p><strong>Message:</strong> <span id="message"></span></p>
                    <p><strong>Sent at:</strong> <span id="Sent_at"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const viewButtons = document.querySelectorAll('.view-btn');

        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                getMessageDetails(id);
            });
        });

        function getMessageDetails(id) {
            fetch(`get_message_details.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.error) {
                        document.getElementById('name').textContent = data.name;
                        document.getElementById('email').textContent = data.email;
                        document.getElementById('message').textContent = data.message;
                        document.getElementById('Sent_at').textContent = data.Sent_at;

                        const messageDetailsModal = new bootstrap.Modal(document.getElementById('messageDetailsModal'));
                        messageDetailsModal.show();
                    } else {
                        console.error(data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>
