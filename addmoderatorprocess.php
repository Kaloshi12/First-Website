<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';

    $stmt = $pdo->prepare("INSERT INTO moderators (name, surname) VALUES (:name, :surname)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);

    try {
        if ($stmt->execute()) {
            header("Location: addModerator.php");
            exit;
        } else {
            echo "Error submitting application.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: addModerator.php");
    exit;
}
?>
