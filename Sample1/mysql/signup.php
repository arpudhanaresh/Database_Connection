<?php
require_once 'config.php';

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = validateInput($_POST["first_name"]);
    $last_name = validateInput($_POST["last_name"]);
    $email = validateInput($_POST["email"]);
    $username = validateInput($_POST["username"]);
    $password = validateInput($_POST["password"]);

    // Check if the username is already taken
    $checkUsernameQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUsernameQuery->bind_param("s", $username);
    $checkUsernameQuery->execute();
    $checkUsernameResult = $checkUsernameQuery->get_result();

    if ($checkUsernameResult->num_rows > 0) {
        $signup_error_message = "Username already taken. Please choose a different one.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertUserQuery = $conn->prepare("INSERT INTO users (first_name, last_name, email, username, password, isActive) VALUES (?, ?, ?, ?, ?, 1)");
        $insertUserQuery->bind_param("sssss", $first_name, $last_name, $email, $username, $hashedPassword);

        if ($insertUserQuery->execute()) {
            $signup_message = "Signup successful!";
        } else {
            $signup_error_message = "Error: " . $insertUserQuery->error;
        }

        $insertUserQuery->close();
    }

    $checkUsernameQuery->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
</head>
<body>

<h2>Sign Up</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Sign Up">
</form>

<p><?php echo isset($signup_message) ? $signup_message : ''; ?></p>
<p><?php echo isset($signup_error_message) ? $signup_error_message : ''; ?></p>

<p>Already have an account? <a href="login.html">Login here</a></p>

</body>
</html>
