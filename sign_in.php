<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'database.php';
$message = "";

session_start();

if (isset($_POST['signin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the SELECT statement
        $stmt = $conn->prepare("SELECT * FROM registerdoner WHERE email = ? AND password = ?");
        if (!$stmt) {
                $message = "Error preparing the statement: " . $conn->error;
        } else {
                // Bind the parameters and execute the statement
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();

                // Get the result
                $result = $stmt->get_result();

                // Check if a match is found
                if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Store the name in a session variable
                        $_SESSION['name'] = $row['firstname'] . ' ' . $row['lastname'];
                        // Redirect to the index page
                        echo '<script>window.location.href = "donor.php";</script>';
                } else {
                        $message = "Invalid email or password.";
                }

                // Close the statement
                $stmt->close();
        }
}

?>

<!-- Rest of your HTML code -->


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
        <meta charset="utf-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;450;500;600;900&display=swap"
                rel="stylesheet">
        <script src="https://kit.fontawesome.com/a865f27d9f.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./css/nav.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/sign_in.css">
        <link rel="stylesheet" href="./css/slider.css">
        <title>Navigation Bar</title>
</head>

<body>
        <header class="site-header">
                <div class="wrapper site-header__wrapper">
                        <div class="site-header__start">
                                <img src="./images/logo.svg" alt="">
                                <p>Heamo</p>
                                <p>Donors</p>
                        </div>
                        <div class="site-header__middle">
                                <nav class="nav">
                                        <i class="nav__toggle fa-solid fa-bars fa-xl"></i>
                                        <ul class="nav__wrapper">
                                                <li class="nav__item"><a href="index.php">Home</a></li>
                                                <li class="nav__item"><a href="donor.php">Find Donors</a></li>
                                                <li class="nav__item"><a href="#blogs">Blog</a></li>
                                                <li class="nav__item"><a href="#main">About us</a></li>
                                                <li class="nav__item"><a href="#">Contact</a></li>
                                                <?php if (!isset($_SESSION['name'])) { ?>
                                                <li class="nav_btns li-btns">
                                                        <a href="sign_in.php"><button class="white-btn"
                                                                        type="button">Sign
                                                                        in</button></a>
                                                        <a href="register.php"><button type="button">Register as a
                                                                        donor</button></a>
                                                </li>
                                                <?php } else { ?>
                                                <li class="nav_btns li-btns">
                                                        <a href="logout.php"><button class="white-btn" type="button">Log
                                                                        out
                                                                </button></a>
                                                        <a href="register.php">
                                                                <button type="button" disabled>
                                                                                <?php echo $_SESSION['name'] ?>
                                                                </button>
                                                        </a>
                                                </li>
                                                <?php } ?>
                                        </ul>
                                </nav>
                        </div>
                        <?php if (!isset($_SESSION['name'])) { ?>
                        <div class="nav_btns div-btns">
                                <a href="sign_in.php"><button class="white-btn" type="button">Sign
                                                in</button></a>
                                <a href="register.php"><button type="button">Register as a
                                                donor</button></a>
                        </div>
                        <?php } else { ?>
                        <div class="nav_btns div-btns">
                                <a href="logout.php"><button class="white-btn" type="button">Log out
                                        </button></a>
                                <a href="register.php">
                                        <button type="button" disabled>
                                                        <?php echo $_SESSION['name'] ?>
                                        </button>
                                </a>
                        </div>
                        <?php } ?>
                </div>
        </header>
        <div class="sign_in">
                <div class="sign_in_container">
                        <div class="sign_in_img">
                                <img src="./images/men and women.png" alt="" srcset="">
                        </div>
                        <div class="sign_in_input_field">
                                <?php if ($message != "") { ?>
                                <div class="message">
                                                <?php echo $message ?>
                                                
                                </div>
                                <?php } ?>
                                <h1>Welcome back!</h1>
                                <p>Clarity gives you the blocks and components you need to create a truly professional
                                        website.</p>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <label class="email" for="">Email address</label>
                                        <input type="email" name="email" placeholder="email, phone, or username">
                                        <label class="password" for="">Password</label>
                                        <input type="password" name="password" placeholder="password" id="signupformpassword">
                                        <div>
                                                <input type="checkbox" name="" id="">
                                                <label class="remember" for="">Remember me</label>
                                                <label class="forgot_password">Forgot Password</label>
                                        </div>
                                        <button class="btns" type="submit" name="signin">Sign in</button>

                                        <p>Don't have an account? <span>Create free account</span></p>
                                </form>
                        </div>
                </div>
        </div>

        <?php

        include 'footer.php';



        ?>