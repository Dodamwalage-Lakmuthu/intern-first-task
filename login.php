<?php
include_once './includes/dbcon.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/log.css">
    <title>LogIn</title>

</head>

<body>
    <?php
    $email = $password = "";
    $Erremail = $Errpassword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $Erremail = "Please enter valid email address";
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST["password"])) {
            $Errpassword = "please enter your password";
        } else {
            $password = test_input($_POST["PASSWORD"]);
            $password = md5($password);
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
        <a href="./index.php">
            <h2>My Shopping</h2>
        </a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
                <label for="Email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="email" name="email" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <span class="alert"><?php echo $Erremail; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                <span class="alert"><?php echo $Errpassword; ?></span>
            </div>
            <div class="logbutton">
                <button type="submit" class="btn btn-primary">LOGIN</button>
            </div>
            <div class="create">
                <h4>Need Account ? Click <a href="./signup.php">here</a></h4>
            </div>
        </form>
    </div>


</body>

</html>