<?php
require_once('connect.php');
session_start();

if (isset($_POST['hiddenuser']))
{
    $user_esc = $conn-> escape_string($_POST['hiddenuser']);
    $pass_esc = $conn-> escape_string($_POST['hiddenpass']);
    $login = "SELECT * FROM login WHERE username = '$user_esc' AND password = '$pass_esc'";
    $loginQuery = $conn-> query($login) or die(mysqli_error($conn));
    $rows = $loginQuery->num_rows;
    $_SESSION['rows'] = $rows;

    if ($rows == 1)
    {
        $permission = "SELECT permission FROM login WHERE username = '$user_esc' AND password = '$pass_esc'";
        $permissionQuery = $conn -> query($permission) or die(mysqli_error($conn));
        $permissionRow = $permissionQuery-> fetch_assoc();

        $_SESSION['username'] = $user_esc;

        if ($permissionRow['permission'] == 'admin')
        {
            //add update delete search display
            $_SESSION['permission'] = "admin";
        }
        else if ($permissionRow['permission'] == 'user')
        {
            //search display
            $_SESSION['permission'] = "user";
        }
    }
    else
    {
        $_SESSION['invalid'] = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>Portfolio - Mimi Lam</title>
    <link rel="icon" href="../../assets/images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/main.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../../index.html">
                <img src="../../assets/images/favicon.ico"/>
                Mimi Lam
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <div class="navbar-nav">
                    <a href="../../view/portfolio.html" class="btn btn-outline-primary" role="button">Back to Portfolio</a> <p>&#8205;</p>
                </div>
            </div>
        </nav>
    </header>
    <br/>
    <?php if ($_SESSION['invalid']) { ?>
        <p>Username or Password is incorrect.</p>
        <a href="login.html"><input type="button" class="btn btn-primary" name="logout" value="Login Page"/></a>
    <?php } 
    else if (!$_SESSION['invalid']) { ?>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1><br/>
    <?php if ($_SESSION['rows'] > 0) { ?>
        <a href="display.php"><input type="button" class="btn btn-primary" name="display" value="Display All"/></a>
        <a href="search.html"><input type="button" class="btn btn-primary" name="search" value="Search"/></a>
        <?php if ($_SESSION['permission'] == "admin") { ?>
            <a href="add.php"><input type="button" class="btn btn-primary" name="add" value="Add"/></a>
        <?php } ?>
        <a href="checkout.php"><input type="button" class="btn btn-primary" name="checkout" value="Checkout"/></a>
        <a href="login.html"><input type="button" class="btn btn-primary" name="logout" value="Logout"/></a>
    <?php } ?>
    <?php } $_SESSION['invalid'] = false; ?>
</body>
</html>