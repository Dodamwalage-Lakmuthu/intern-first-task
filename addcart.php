<?php
session_start();
if (!isset($_SESSION["FirstName"])) {

    header("Location:login.php");
}

require './includes/dbcon.php';
?>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="./css/cart.css">
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
            <h2>Your cart</h2>
            <?php
            // $productid = $_GET["productid"];
            // $buyquantity = $_GET["buyquantity"];
            $buyerId = (int)$_SESSION['UserId'];

            // fetching cart details
            $sql = "SELECT products.title,products.price,cart.Quantity FROM products INNER JOIN cart ON products.ProductId=cart.ProductId where cart.BuyerId=" . $buyerId . ";";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr>
                <th>Title</th>
                <th>unit price</th>
                <th>buy quantity</th>
                <th>total</th>
                <tr/>";
                $subTotal =  (int)'';
                while ($row = $result->fetch_assoc()) {
                    $productTitle = $row["title"];
                    $productPrice = $row["price"];
                    $productQuantity = $row["Quantity"];
                    $proTotalPrice = $productQuantity * $productPrice;
                    $subTotal += $proTotalPrice;
                    if ($productQuantity != 0) {
                        echo "<tr>
                <th>" . $productTitle . "</th>
                <th>" . $productPrice . "</th>
                <th>" .  $productQuantity . "</th>
                <th>$proTotalPrice</th>
                <tr/>";
                    }
                }
                echo "</table>";
            }

            if (isset($subTotal)) {
                echo "<div class='total'>
                <h2>Your Total</h2>
                <h3>Rs: " . number_format(floatval($subTotal), 2) . "</h3>
                </div>";
                echo "<a href='./payment.php?buyerId=" . $buyerId . "'>checkout <i class='fas fa-shopping-bag'></i></a>";
            } else {
                echo "<h2> Your cart is empty </h2>";
            }

            ?>



        </main>
        <footer>
            <p>&copy; My Shoping</p>
        </footer>
    </div>
</body>

</html>