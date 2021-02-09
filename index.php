<?php
session_start();
require_once './includes/dbcon.php';
require_once './includes/query.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="./css/main.css">
    <!-- <link rel="stylesheet" href="./css/product.css"> -->
    <link rel="stylesheet" href="./css/prod.css">
    <title>Shop page</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>My Shopping</h1>
        </header>
        <!-- nav bar  -->
        <nav>
            <ul>
                <li><a href="#" id="index">Shop</a></li>
                <li><a href="./about.php" id="about">About</a></li>
                <li><a href="./contact.php" id="contact">Contact</a></li>
                <?php
                if (isset($_SESSION["FirstName"])) {
                    echo "<li><a href='./account.php' id='account'>" . $_SESSION["FirstName"] . "'s Account</a></li>";
                    echo "<li><a href='./includes/logout.php' id='logout'>LOGOUT</a></li>";
                } else {
                    echo "<li><a href='./signup.php' id='signup'>SignUp</a></li>";
                    echo "<li><a href='./login.php' id='login'>LogIn</a></li>";
                }
                ?>


            </ul>
        </nav><!-- end of nav bar -->

        <!--   body of web page -->

        <main>
            <h2>Our Products</h2>

            <div class="con">
                <?php
                $result = allproducts($conn);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $productid = $row["ProductId"];
                        $imgsrc = $row["ImageLocation"];
                        $title = $row["Title"];
                        $description = $row["Description"];
                        $price = $row["Price"];
                        $quantity = $row["Quantity"];
                        if ($quantity > 0) {
                            echo '
                                        		<div class="item" id="' . $productid . '">
                        	<div class="image">
                        		<img src="' . $imgsrc . '">
                        	</div>
                        	<div class="price">
                                <h5>' . $title . '</h5>
                        		<h6>Rs ' . $price . '</h46>
                        	</div>
                        	<div class="desc">
                        	<P>' . $description . '</P>
                        	</div>
                        </div>';
                        }
                    }
                }
                ?>
            </div>




        </main><!-- en of body -->
        <!-- footer  -->
        <footer>
            <P>&copy; My Shopping</P>
        </footer><!-- end of footer -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/navhigh.js"></script>

</body>

</html>