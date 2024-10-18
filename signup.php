<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $salt = bin2hex(random_bytes(16));

    $saltedPassword = $password . $salt;

    $hashedPassword = hash("sha256", $saltedPassword);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, salt, name, surname, access_level) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->execute([$username, $hashedPassword, $salt, $fname, $lname, 'developer']);

        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
