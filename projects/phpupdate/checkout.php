<?php
    $first_name=""; $error_first_name="";
    $last_name=""; $error_last_name="";
    $address=""; $error_address="";
    $city=""; $error_city="";
    $zip=""; $error_zip="";
    $phone=""; $error_phone="";
    $error_crop=""; $error_state="";
    $error_check=false;

    require_once("connect.php");

    $stateQuery = "SELECT state_id, name FROM state ORDER BY name ASC";
    $stateResult = $conn->query($stateQuery) or die(mysqli_error($conn));

    $cropQuery = "SELECT crop FROM crops ORDER BY crop ASC";
    $cropResult = $conn->query($cropQuery) or die(mysqli_error($conn));

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['submit']))
    {
        if (empty($_POST['first_name']))
        {
            $error_first_name = "*";
            $error_check = true;
        }
        else
            $first_name = trim($_POST['first_name']);

        if (empty($_POST['last_name']))
        {
            $error_last_name = "*";
            $error_check = true;
        }
        else
            $last_name = trim($_POST['last_name']);
        
        if (empty($_POST['address']))
        {
            $error_address = "*";
            $error_check = true;
        }
        else
            $address = trim($_POST['address']);

        if (empty($_POST['city']))
        {
            $error_city = "*";
            $error_check = true;
        }
        else
            $city = trim($_POST['city']);

        if (empty($_POST['zip']))
        {
            $error_zip = "*";
            $error_check = true;
        }
        else
            $zip = trim($_POST['zip']);

        if (empty($_POST['phone']) || !is_numeric($_POST['phone']))
        {
            $error_phone = "*";
            $error_check = true;
        }
        else
            $phone = trim($_POST['phone']);

        if (!$error_check)
        {
            $crop_esc = $conn -> escape_string($_POST['crop']);
            $state_esc = $conn -> escape_string($_POST['state']);
            header("Location: checkoutresult.php");
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
<h1>Checkout</h1>
<br/>
<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
    <label>Crop: </label>
    <select name = "crop"> <?php echo $error_crop; ?>
    <option disabled selected>-- Select Crop --</option>
        <?php while ($row = $cropResult->fetch_assoc()) { ?>
        <option value = "<?php echo $row['crop']; ?>" > <?php echo $row['crop']; ?>
        <?php } ?>
    </select><br/><br/>
    <label>First Name: </label> <input type = "text" name="first_name" value="<?php echo $first_name; ?>" /> <?php echo $error_first_name; ?><br><br>
    <label>Last Name: </label> <input type = "text" name="last_name" value="<?php echo $last_name; ?>"/> <?php echo $error_last_name; ?> <br><br>
    <label>Address</label> <input type = "text" name="address" value="<?php echo $address; ?>"/><?php echo $error_address; ?><br><br>
    <label>City: </label> <input type = "text" name="city" value="<?php echo $city; ?>"/><?php echo $error_city; ?><br><br>
    <label>State: </label>
        <select name = "state">
        <option disabled selected>-- Select State --</option>
            <?php while ($row = $stateResult->fetch_assoc()) { ?>
            <option value = "<?php echo $row['state_id']; ?>" > <?php echo $row['name']; ?>
            <?php } ?>
        </select> <?php echo $error_state; ?> <br/><br/>
    <label>Zip Code: </label> <input type = "text" name="zip" value="<?php echo $zip; ?>" /> <?php echo $error_zip; ?> <br><br>
    <label>Phone Number: </label> <input type = "text" name="phone"  value="<?php echo $phone; ?>" /> <?php echo $error_phone; ?> <br><br>
    <input name = "submit" type = "submit" class="btn btn-primary" value = "Submit" />
    <a href="login.php"><input type="button" class="btn btn-primary" name="backtologin" value="Back to Main Page"/></a>
</form>
<br/><br/>
</body>
</html>