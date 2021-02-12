<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Mega&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="topnav">
            <header>
                <h1>My Shopping</h1>
            </header>
            <!-- nav bar  -->
            <nav>
                <ul>
                    <li><a href="./index.php" id="index">Shop</a></li>
                    <li><a href="./about.php" id="about">About</a></li>
                    <li><a href="#" id="contact">Contact</a></li>
                    <?php
                    if (isset($_SESSION["FirstName"])) {
                        echo "<li><a href='./account.php' id='account'>" . $_SESSION["FirstName"] . "'s Account</a></li>";
                        echo "<li><a href='./includes/logout.php' id='login'>LOGOUT</a></li>";
                    } else {
                        echo "<li><a href='./signup.php' id='login'>SignUp</a></li>";
                        echo "<li><a href='./login' id='login'>LogIn</a></li>";
                    }
                    ?>


                </ul>
            </nav>
            <!-- end of nav bar
        </div>
         -->

            <!--   body of web page -->

            <main>
                <div class="tophead">
                    <h2>MY Shopping &reg;</h2>
                    <p>we sell all your needs</p>
                    <h4>Contact Us</h4>
                </div>
                <div class="abdis">
                    <p>Fell free to contact us</p>
                    <h4>hello@myshoping.com</h4>
                </div>
            </main><!-- en of body -->
            <!-- footer  -->
            <footer>
                <P>&copy; My Shopping</P>
            </footer><!-- end of footer -->
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="./js/navhigh.js"></script>
</body>

</html>