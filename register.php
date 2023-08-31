<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'database.php';

$message = "";
$tattoo = ""; 
$dateOfGettingInked = ""; 
if (isset($_POST['register'])) {
    // ... Your code for handling form submission ...

    if(isset($_POST['tattoo']) &&$_POST['tattoo']!= '')
    {
        $tattoo  =$_POST['tattoo'];
    }
    else
    {
        $tattoo = NULL;
    }
    if( isset($_POST['dateOfGettingInked']) && $_POST['dateOfGettingInked']!= '')
    {
        $dateOfGettingInked  = $_POST['dateOfGettingInked'];
    }
    else
    {
        $dateOfGettingInked = NULL;
    }

    // Prepare the insert statement
    $stmt = $conn->prepare("INSERT INTO registerdoner (firstname, lastname, dob, email, gender, bloodgroup, everDonatedBloodBefore, bloodDonatedOn, anySkinDisease, tattoo, dateOfGettingInked, phone, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        $message = "Error preparing the statement: " . $conn->error;
    } else {
        // Bind the form data to the prepared statement parameters
        $stmt->bind_param("sssssssssssss", $_POST['firstname'], $_POST['lastname'], $_POST['dob'], $_POST['email'], $_POST['gender'], $_POST['bloodgroup'], $_POST['everDonatedBloodBefore'], $_POST['bloodDonatedOn'], $_POST['anySkinDisease'], $tattoo, $dateOfGettingInked, $_POST['phone'], $_POST['password']);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['name'] = $_POST['firstname'] .' ' . $_POST['lastname'] ;
            $message = "Registered as a donor successfully.";
            $insertedRows = $stmt->affected_rows;
        } else {
            $message = "Error inserting form data: " . $stmt->errno . " - " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }


}


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
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Register Page</title>
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
    <div class="register">


        <div class="register_box">
            <?php if ($message != "") { ?>
            <div class="message">
                    <?php echo $message ?>
            </div>
            <?php } ?>
            <h3>Register as a Blood Donor</h3>
            <p>Personal Details</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="registerForm">
                <div class="register_first_container">
                    <div class="input_box">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Enter your first name">
                    </div>
                    <div class="input_box">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Enter your last name">
                    </div>
                    <div class="input_box">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" placeholder="dd/mm/yy">
                    </div>
                </div>
                <div class="register_first_container">
                    <div class="input_box">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Enter your email">
                    </div>

                    <div class="input_box">
                        <label for="password">password</label>
                        <input type="password" name="password" id="" placeholder="Enter your password">
                    </div>
                    <div class="input_box">
                        <label for="phone">Mobile Number</label>
                        <input type="text" name="phone" id="phone" placeholder="Enter your mobile number">
                    </div>

                    <div class="input_box">
                    <label for="gender"  class="gender-label">Gender</label>
                        <select id="gender" name="gender">

                            <option value="" selected>GENDER</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <p class="medical_detail">Medical Details</p>
                <div class="register_first_container">
                    <div class="input_box">
                        <label for="bloodgroup">Blood Group</label>

                        <select id="bloodgroup" name="bloodgroup">

                            <option value="" selected>Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="AB+">AB+</option>
                            <option value="O+">O+</option>
                        </select>
                    </div>
                    <div class="input_box">
                        <label for="everDonatedBloodBefore">Ever Donated Blood Before</label>
                        <input type="text" name="everDonatedBloodBefore" id="everDonatedBloodBefore"
                            placeholder="yes / no">
                    </div>
                    <div class="input_box">
                        <label for="bloodDonatedOn">Blood Donated on</label>
                        <input type="date" name="bloodDonatedOn" id="bloodDonatedOn" placeholder="month/year">
                    </div>
                </div>
                <div class="register_first_container">
                    <div class="input_box">
                        <label for="anySkinDisease">Any Skin Disease</label>
                        <select id="anySkinDisease" name="anySkinDisease">
                            <option value="no" selected>No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                    <div class="input_box">
                        <label for="tattoo">Any Tattoo</label>
                        <select id="tattoo" name="tattoo">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                    <div class="input_box">
                        <label for="dateOfGettingInked">Date of Getting Inked</label>
                        <input type="date" name="dateOfGettingInked" id="dateOfGettingInked" placeholder="month/year">
                    </div>
                </div>
                <button class="btns" type="submit" name="register">Register</button>
            </form>
        </div>
    </div>

    <?php

    include 'footer.php';
    ?>