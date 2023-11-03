<?php

session_start();
include 'db_config.php';

$name = "";
$email = "";
$message = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    do {
        if (empty($name) || empty($email) || empty($message) ) {
            $errorMessage = "All the fields are required";
            break;
        }

        //adding the users to the database

        $sql = "INSERT INTO users_feedback (name, email, message)" . "VALUES ('$name','$email','$message')";
        $result = $connect->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connect->error;
            break;
        }

        $name = "";
        $email = "";
        $message = "";

        $successMessage = "You sent your message Successfully";

        header("location:contact.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>Contact Us|| An Essence To You</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/photos/favicon.jpg" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container px-5">
                    <a href="index.html"><img src="/assets/photos/logo.png"  class="navbar-brand" style="max-width: 80px;"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.html">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.html">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownPortfolio" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">OUR PROJECT</a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownPortfolio">
                                    <li><a class="dropdown-item" href="film.html">FILM</a></li>
                                    <li><a class="dropdown-item" href="gallery.html">GALLERY</a></li>
                                    <li><a class="dropdown-item" href="storyboard.html">STORYBOARD</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <section class="py-5">
                <div class="container px-5">
                    <!-- Contact form-->
                    <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                        <div class="text-center mb-5">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                            <h1 class="fw-bolder" >Get In Touch</h1>
                            <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
                        </div>
                        <div class="row gx-5 justify-content-center">
                            <div class="col-lg-8 col-xl-6">
                                <!-- * * * * * * * * * * * * * * *-->
                                <!-- * * SB Forms Contact Form * *-->
                                <!-- * * * * * * * * * * * * * * *-->
                                <!-- This form is pre-integrated with SB Forms.-->
                                <!-- To make this form functional, sign up at-->
                                <!-- https://startbootstrap.com/solution/contact-forms-->
                                <!-- to get an API token!-->
                                <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="POST">
    <!-- Name input-->
    <div class="form-floating mb-3">
        <input value="<?php echo $name; ?>" class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." data-sb-validations="required">
        <label for="name">Full name</label>
        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
    </div>
    <!-- Email address input-->
    <div class="form-floating mb-3">
        <input value="<?php echo $email; ?>" class="form-control" id="email" name="email" type="email" placeholder="name@example.com" data-sb-validations="required,email">
        <label for="email">Email address</label>
        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
    </div>
    <!-- Message input-->
    <div class="form-floating mb-3">
        <textarea class="form-control" id="message" name="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"><?php echo $message; ?></textarea>
        <label for="message">Message</label>
        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
    </div>
    <!-- Submit success message-->
    <!-- This is what your users will see when the form-->
    <!-- has successfully submitted-->
    <div class="d-none" id="submitSuccessMessage">
        <div class="text-center mb-3">
            <div class="fw-bolder">Form submission successful!</div>
        </div>
    </div>
    <!-- Submit error message-->
    <!-- This is what your users will see when there is-->
    <!-- an error submitting the form-->
    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
    <!-- Submit Button-->
    <input type="submit" name="" value="Send" class="btn btn-primary btn-lg">
</form>
                            </div>
                        </div>
                    </div>
                    <!-- Contact cards-->
                    <div class="row gx-5 row-cols-2 row-cols-lg-4 py-5">
                        <div class="col">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-chat-dots"></i></div>
                            <div class="h5 mb-2">What Do You Think?</div>
                            <p class="text-muted mb-0">Send us a feedback on what's your insights about the movie.</p>
                        </div>
                        <div class="col">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
                            <div class="h5">Get In Touch</div>
                            <p class="text-muted mb-0">If you have any clarifications, don't hesitate to contact us.</p>
                        </div>
                        <div class="col">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                            <div class="h5">Call Us</div>
                            <p class="text-muted mb-0">Barangay Bonga Menor - 044-309-3669</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="column align-items-center justify-content-between flex-column flex-sm-column">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; An Essence To You 2023</div></div>
                   <div class="col-auto"><div class="small m-0 text-white">BE MOTIVATED TO LEARN</div>
                    <div class="small m-0 text-white">WHERE YOU CAN BE HELP AND SAVE LIVES IN THE FUTURE</div>
                </div>
                    <div class="col-auto">
                        <a class="link-light small" href="https://www.facebook.com/profile.php?id=100095439047245">Facebook</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="https://twitter.com/essence1051999">Twitter</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="https://www.instagram.com/essencetoyouu/">Instagram</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="https://www.tiktok.com/@_camilxx?lang=en">Tiktok</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
