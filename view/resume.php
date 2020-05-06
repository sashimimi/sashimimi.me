<?php
require_once('../assets/db.php');

if (isset($_POST['username']))
{
    $user_esc = $conn-> escape_string($_POST['username']);
    $pass_esc = $conn-> escape_string($_POST['password']);
    $query = "SELECT * FROM resumelogin WHERE username = '$user_esc' AND password = '$pass_esc'";
    $result = $conn-> query($query) or die(mysqli_error($conn));
    $rows = $result->num_rows;

    if ($rows == 1)
    {
        header("Location: ../assets/pdf/Resume_MimiLam.pdf");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <head>
        <meta name="viewport" content="width=device-width">
        <title>Mimi Lam</title>
        <link rel="icon" href="../assets/images/favicon.ico">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/main.css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <style>
            .hidden {
                display: none;
            }
        </style>
    </head>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand mx-auto" href="../index.html">
            <img src="../assets/images/favicon.ico"/>
            Mimi Lam
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <div class="navbar-nav">
                <a href="../index.html" class="btn btn-outline-primary custom-navbar" role="button">Home</a> <p class="star-light">&#9733;</p>
                <a href="../index.html#about" class="btn btn-outline-primary custom-navbar" role="button">About Me</a> <p class="star-light">&#9733;</p>
                <a href="portfolio.html" class="btn btn-outline-primary custom-navbar" role="button">Portfolio</a> <p class="star-light">&#9733;</p>
                <a href="timeline.html" class="btn btn-outline-primary custom-navbar" role="button">Timeline</a> <p class="star-light">&#9733;</p>
                <a href="contact.html" class="btn btn-outline-primary custom-navbar" role="button">Contact</a>
            </div>
        </div>
    </nav>
</header>
<div class="content">
<br/>
    <div class="container text-center">
        <p>Please login to see this content.</p>
        <h1>User Login </h1>
        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="login">
        <input type = "text" name="username" placeholder ="Username" required /><br><br>
        <input type = "password" name = "password" placeholder = "Password" required /><br><br>
        <input name = "submit" type = "submit" value = "Login" />
        </form>
    </div>
</div>
</body>
</html>