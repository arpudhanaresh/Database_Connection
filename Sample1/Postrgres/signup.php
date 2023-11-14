<?php
// Connect to the PostgreSQL database
$pdo = new PDO('pgsql:host=localhost;dbname=postgres', 'datab', 'datab');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    // Insert a new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, username, password, isActive) VALUES (:firstName, :lastName, :email, :newUsername, :newPassword, TRUE)");
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':newUsername', $newUsername);
    $stmt->bindParam(':newPassword', $newPassword);

    if ($stmt->execute()) {
        echo 'Signup successful';
    } else {
        echo 'Error during signup';
    }
}
?>
