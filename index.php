<?php
session_start();
require_once './includes/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/product.css">
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
                <li><a href="#" id="shop">Shop</a></li>
                <li><a href="./about.php" id="about">About</a></li>
                <li><a href="./contact.php" id="contact">Contact</a></li>
                <?php
                if (isset($_SESSION["FirstName"])) {
                    echo "<li><a href='./account.php'>" . $_SESSION["FirstName"] . "'s Account</a></li>";
                    echo "<li><a href='./includes/logout.php' id='login'>LOGOUT</a></li>";
                } else {
                    echo "<li><a href='./signup.php' id='login'>SignUp</a></li>";
                    echo "<li><a href='./login.php' id='login'>LogIn</a></li>";
                }
                ?>


            </ul>
        </nav><!-- end of nav bar -->

        <!--   body of web page -->

        <main>
            <h2>Shop Page</h2>
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productid = $row["ProductId"];
                    $imgsrc = $row["ImageLocation"];
                    $title = $row["Title"];
                    $description = $row["Description"];
                    $price = $row["Price"];
                    echo '<div class="item" id="' . $productid . '">
                <div class="image">
                    <img src="' . $imgsrc . '" alt="product" class="product-image">
                </div>
                <div class="info-bar">
                    <h2>' . $title . '</h2>
                    <p>' . $description . '</p>
                </div>
                <div class="price">
                    <h4>Rs:' . $price . '</h4>
                </div>
            </div>';
                }
            }
            ?>




        </main><!-- en of body -->
        <!-- footer  -->
        <footer>
            <P>&copy; My Shopping</P>
        </footer><!-- end of footer -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/scripts.js"></script>
</body>

</html>