<?php
require_once('connect.php');
session_start();

$search_item = filter_input(INPUT_POST,'hiddensearch');
$min_length = 1;

if(strlen($search_item) >= $min_length)
{
    $query = "SELECT * FROM crops WHERE crop = '$search_item'";

    $result = $conn->query($query) or die(mysqli_error($conn)); 
    $rows = $result->num_rows;
} 
else 
{
    $_SESSION['tooshort'] = true;
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
    <?php if ($_SESSION['tooshort']) { ?>
        <p>Minimum search Length is <?php echo $min_length; ?></p>
    <?php } 
    else if (!$_SESSION['tooshort']){ ?>
<h1>Results for "<?php echo $search_item; ?>"</h1>
<br/>
    <?php if ($rows > 0) { ?>
        <table border = "1" width = "60%" align = "center" style="border-collapse: collapse";>
	    <tr>
            <th>ID</th><th>Crop</th><th>Season</th><th>Price</th><th>Description</th>
	    </tr>
	    <?php while ($row = $result->fetch_assoc()) {?>
	    <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['crop']; ?></td>
            <td><?php echo $row['season']; ?></td>
            <td><?php echo $row['price']." G"; ?></td>
            <td><?php echo $row['description']; ?></td>
            <?php if ($_SESSION['permission'] == "admin") { ?>
            <td>
                <form action="update.php" method="POST">
                <input type = "hidden" name = "id" 
                    value = "<?php echo $row['id']; ?>"/>
                <input type = "submit" value= "Update">
                </form>
            </td>
            <td>
                <form action="delete.php" method="post">
                <input type = "hidden" name = "id" 
                    value = "<?php echo $row['id']; ?>">
                <input type = "submit" value= "Delete">
                </form>
            </td>
            <?php } ?>
	    </tr>
	<?php } ?>
	    </table>
    <?php } ?>
    <?php } $_SESSION['tooshort'] = false; ?>
    <br/>
	<a href="search.html"><input type="button" class="btn btn-primary" name="backtosearch" value="Search Again"/></a>
</body>
</html>