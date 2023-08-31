<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;450;500;600;900&display=swap"
        rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/a865f27d9f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/slider.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/about_us.css">
    <link rel="stylesheet" href="./css/before_after_blood.css">
    <link rel="stylesheet" href="./css/testimonials.css">
    
    <!-- <link rel="stylesheet" href="./css/register.css"> -->
    <link rel="stylesheet" href="./css/nav.css">
    <!-- <link rel="stylesheet" href="./css/sign_in.css"> -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- <link rel="stylesheet" href="./css/donor.css"> -->
    <title>Slider</title>
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
                            <a href="sign_in.php"><button class="white-btn" type="button">Sign
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