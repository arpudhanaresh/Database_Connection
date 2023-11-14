<?php
session_start();
// Connect to the PostgreSQL database
$pdo = new PDO('pgsql:host=localhost;dbname=postgres', 'datab', 'datab');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user from the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND isActive = TRUE");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Successful login
        header('Location: login_success.php');
        exit();
    } else {
        // Invalid login
        echo 'Invalid username or password';
    }
}
?>
