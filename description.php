<?php
session_start();
require './includes/dbcon.php';

require_once './includes/query.php'
?>

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/main.css">
    <!-- <link rel="stylesheet" href="./css/product.css"> -->
    <link rel="stylesheet" href="./css/desc.css">
    <link rel="stylesheet" href="./css/cartbut.css">
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
            $productid = $_GET['id'];
            // $sql = 'SELECT products.Title,products.Price,products.ImageLocation,products.Quantity,products.Description,products.OwnerId,users.UserName FROM products INNER JOIN users ON products.OwnerId = users.UserId where products.ProductId=' . $productid;
            $result = getproddescription($conn, $productid);
            $row = $result->fetch_assoc();
            //product details
            $title = $row["Title"];
            $price = $row["Price"];
            $imagelocation = $row["ImageLocation"];
            $quantity = $row["Quantity"];
            $description = $row["Description"];
            $sellername = $row["UserName"];
            $ownerId = $row["OwnerId"];
            //$_SESSION['productId'] = $productid;
            ?>

            <div class="details">
                <h2><?php echo $title; ?></h2>
                <div class="product">
                    <section class="img-con">
                        <img src=<?php echo $imagelocation ?> alt="">
                    </section>

                    <div class="title">

                        <h3>Rs <?php echo $price; ?></h3>
                        <p>Seller: <?php echo $sellername; ?></p>
                    </div>
                    <div class="buying-form">
                        <form action="./includes/cart.php" method="post">
                            <p>quantity</p>
                            <select class="form-control" name="buy-quantity">
                                <?php
                                while ($quantity > 0) {
                                    echo "<option value='" . $quantity . "'>" . $quantity . "</option>";
                                    $quantity--;
                                }
                                ?>
                            </select>
                            <input type="hidden" name="productId" value="<?php echo $productid ?>">
                            <input type="hidden" name="ownerId" value="<?php echo $ownerId ?>">
                            <button class="icon" type="submit"><i class="fas fa-cart-plus"></i></button>
                        </form>
                    </div>

                </div>
                <div class="product-details">
                    <h2>About This Item</h2>
                    <p><?php echo $description; ?></p>
                </div>

            </div>



        </main>
        <footer>
            <p>&copy; My Shoping</p>
        </footer>
    </div>
</body>

</html>