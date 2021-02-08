<?php
session_start();
if (!isset($_SESSION["FirstName"])) {

    header("Location:index.php");
}

require_once './includes/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/account.css">
    <title>Document</title>
</head>

<body>
    <?php
    $title = $name = $description = $quantity = $price = $newfilename = "";
    $Errtitle = $Errname = $Errdescription = $Errquantity = $filename = $Errnewfilename = $Errprice = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //title
        if (empty($_POST['title'])) {
            $Errtitle = "Enter a Title to your product";
        } else {
            $title = test_input($_POST['title']);
        }
        //price
        if (empty($_POST['price'])) {
            $Errprice = "Enter your price";
        } else {
            $price = test_input($_POST['price']);
            if (!is_numeric($price)) {
                $Errprice = "Invalid price";
                $price = "";
            } else {
                $price = floatval($price);
            }
        }
        //quantity
        if (empty($_POST['quantity'])) {
            $Errquantity = "Say, How much quantity you have";
        } else {
            $quantity = test_input($_POST['quantity']);
            if (!is_numeric($quantity)) {
                $Errquantity = "Invalid quantity";
                $quantity = "";
            } else {
                if ((int)$quantity < 0) {
                    $Errquantity = "Inavlid quantity";
                    $quantity = "";
                } else {
                    $quantity = (int)$quantity;
                }
            }
        }
        //description
        if (empty($_POST['description'])) {
            $Errdescription = "Say something about your product";
        } else {
            $description = test_input($_POST['description']);
        }
        // file validation
        if (isset($_FILES["image"])) {
            $file = $_FILES['image'];
            //file properties
            $filename = $file['name'];
            $tmp_name = $file['tmp_name'];
            $file_size = $file['size'];
            $error = $file['error'];


            // file extenssion
            $file_ext = explode('.', $filename);
            $file_ext  = strtolower(end($file_ext));

            $allowed = array('txt', 'jpg', 'jpeg', 'gif');

            if (in_array($file_ext, $allowed) && $error === 0 && $file_size <= 3145728) {
                $newfilename = uniqid('', true) . '.' . $file_ext;
                $uploaddir = 'uploads/' . $newfilename;
                move_uploaded_file($tmp_name, $uploaddir);
            } else {
                $Errnewfilename = "Inavalid file";
            }
        }
    }



    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return ($data);
    }

    ?>




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
                    echo "<li><a href='./account.php' id=''>" . $_SESSION["FirstName"] . "'s Account</a></li>";
                    echo "<li><a href='./includes/logout.php' id='login'>LOGOUT</a></li>";
                } else {
                    echo "<li><a href='./signup.php' id='login'>SignUp</a></li>";
                    echo "<li><a href='./login' id='login'>LogIn</a></li>";
                }
                ?>


            </ul>
        </nav><!-- end of nav bar -->

        <!--   body of web page -->

        <main class="account">
            <div class="upload">
                <h2>Upload Your Product</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label col-form-label-sm">Title of the product</label>
                        <div class="col-sm-10">
                            <input value="<?php echo $title; ?>" type="text" name="title" class="form-control form-control-sm" id="title" placeholder="Title of your product">
                            <span class="alert"><?php echo $Errtitle; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="price">Price</label>
                            <input type="number" value="<?php echo $price; ?>" name="price" class="form-control" id="price" placeholder="Price of your product" required>
                            <span class="alert"><?php echo $Errprice; ?></span>
                        </div>
                        <div class="col">
                            <label for="quantity">Quantity</label>
                            <input type="text" value="<?php echo $quantity; ?>" name="quantity" class="form-control" id="quantity" placeholder="quantity of your product" required>
                            <span class="alert"><?php echo $Errquantity; ?></span>
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="imageinput" required accept="jpg,png,jpeg,gif">
                        <label class="custom-file-label" for="image input">Choose images..</label>
                        <span class="error"><?php echo $Errnewfilename; ?></span>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="button">
                        <button type="submit" id="sub-btn" class="btn btn-primary">UPLOAD PRODUCT</button>

                    </div>
                </form>
            </div>
            <!-- end of upload form -->
            <div class="other">

            </div>
        </main><!-- en of body -->
        <?php
        $ownerId = (int)$_SESSION['UserId'];

        if (!empty($ownerId) && !empty($title) && !empty($price) && !empty($uploaddir) && !empty($quantity) && !empty($description)) {
            $sql = "INSERT INTO products(OwnerId,Title,Price,ImageLocation,Quantity,Description) values($ownerId,'$title',$price,'$uploaddir',$quantity,'$description');";
            if ($conn->query($sql) == TRUE) {
                header('Location:index.php');
            } else {
                echo $price;
                echo $conn->error;
            }
        }
        ?>



        <!-- footer  -->
        <footer>
            <P>&copy; My Shopping</P>
        </footer><!-- end of footer -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/account.js"></script>
</body>

</html>