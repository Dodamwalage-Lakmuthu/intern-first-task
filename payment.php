<?php
session_start();
if (!isset($_SESSION["FirstName"])) {

    header("Location:index.php");
}

require_once './includes/dbcon.php';
require_once './includes/query.php';
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
                <li><a href="./index.php" id="shop">Shop</a></li>
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


            <?php
            $buyerId = $_GET["buyerId"];
            $results = getproductid($conn, $buyerId);
            if ($results->num_rows > 0) {
                while ($row = $results->fetch_assoc()) {
                    $productId = $row["ProductId"];
                    $quantity  = $row["Quantity"];
                    // echo $quantity . "  ";

                    //CREATE ODER
                    createoder($conn, $buyerId, $productId, $quantity);

                    //UPDATE PRODUCT TABLE QUANTITY
                    $avbquantity = getCurrentProductQua($conn, $productId);
                    // echo $avbquantity . "  ";
                    $newQuantity = $avbquantity - $quantity;
                    // echo $newQuantity . "<br>";
                    updateProductQuantity($conn, $productId, $newQuantity);
                }
            }

            deletecart($conn, $buyerId);

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