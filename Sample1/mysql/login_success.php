<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
</head>
<body>

<h2>Login Successful</h2>

<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>

<p><a href="logout.php">Logout</a></p>

</body>
</html>
