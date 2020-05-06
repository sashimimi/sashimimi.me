<?php
require_once('connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['submit']))
{
	$crop_esc = "Blue Jazz"; //$conn -> escape_string($_POST['crop']);
	$season_esc = "Spring"; //$conn -> escape_string($_POST['season']);
	$price_esc = "10"; //$conn -> escape_string($_POST['price']);
	$description_esc = "A flower."; //$conn -> escape_string($_POST['description']);
	

	$query = "INSERT INTO crops (crop, season, price, description)
	VALUES ('$crop_esc', '$season_esc', '$price_esc', '$description_esc')";

	$result = $conn->query($query) or die(mysqli_error($conn));

	$_SESSION['addsuccess'] = true;
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
	<h1>Add new item</h1>
	<br/>
<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
<label>Crop name: </label> <input type = "text" name="crop" value="Blue Jazz" disabled /><br><br>
<label>Season: </label> <input type = "text" name="season" value="Spring" disabled /><br><br>
<label>Price: </label> <input type = "text" name="price" value="10" disabled /><br><br>
<label>Description: </label> <input type = "text" name="description" value="A flower." disabled /><br><br>
<input name = "submit" type = "submit" class="btn btn-primary" value = "Add" />
<a href="login.php"><input type="button" class="btn btn-primary" name="backtologin" value="Previous Page"/></a>
</form>
<br/>
<?php if ($_SESSION['addsuccess']) { ?>
	<p>Item added successfully.</p>
<?php } $_SESSION['addsuccess'] = false; ?>
</body>
</html>