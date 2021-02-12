<?php
include_once './includes/dbcon.php';
require_once './includes/query.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/log.css">
    <link rel="stylesheet" href="./css/main.css">

    <title>Document</title>
</head>

<body>

    <!-- validation inputs -->
    <?php
    $firstname = $lastname = $username = $email = $password1 = $password2 = "";
    $Errfirstname = $Errlastname = $Errusername = $Erremail = $Errpassword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["firstname"])) {
            $Errfirstname = "Enter your firstname";
        } else {
            $firstname = test_input($_POST["firstname"]);
        }
        if (empty($_POST["lastname"])) {
            $Errlastname = "Enter your lastname";
        } else {
            $lastname = test_input($_POST["lastname"]);
        }
        if (empty($_POST["username"])) {
            $Errusername = "Enter your username";
        } else {
            $username = test_input($_POST["username"]);
        }
        if (empty($_POST["email"])) {
            $Erremail = "Enter your email";
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST["password1"])) {
            $Errpassword = "Enter your password";
        } else {
            $password1 = test_input($_POST["password1"]);
        }
        if (empty($_POST["password2"])) {
            $Errpassword = "Re Enter your password";
        } else {
            $password2 = test_input($_POST["password2"]);
        }
        if ($password1 == $password2) {
            $password = md5($password1);
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>


    <div class="container">
        <header>
            <h1>My Shopping</h1>
        </header>

        <div class="signup">
            <a href="./index.php">
                <h2>My Shopping</h2>
            </a>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-group row">
                    <label for="firstname" class="col-sm-3 col-form-label">First Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="FirstName">
                        <p><?php echo $Errfirstname; ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lastname" class="col-sm-3 col-form-label">Last Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="lastName">
                        <p><?php echo $Errlastname; ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" id="username" class="form-control" placeholder="username">
                        <p><?php echo $Errusername; ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        <p><?php echo $Erremail; ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" name="password1" class="form-control" id="password1" placeholder="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password2" class="col-sm-3 col-form-label">Re Enter password</label>
                    <div class="col-sm-6">
                        <input type="password" name="password2" class="form-control" id="password2" placeholder="Re Enter Password">
                        <p><?php echo $Errpassword; ?></p>
                    </div>
                </div>
                <div class="logbutton">
                    <button type="submit" id="sub-btn" class="btn btn-primary">SIGNUP</button>
                </div>
            </form>
        </div>
    </div>
    <?php

    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($username) && !empty($password)) {
        signup($conn, $lastname, $firstname, $username, $password, $email);
    }

    ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/signup.js"></script>
</body>

</html>