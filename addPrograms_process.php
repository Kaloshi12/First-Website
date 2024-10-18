<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $aname = isset($_POST['authorName']) ? $_POST['authorname'] : '';
    $asurname = isset($_POST['authorSurname']) ? $_POST['authorsurname'] : '';
    $mid = isset($_POST['moderatorId']) ? $_POST['moderatorId'] : '';
    $img = isset($_POST['img']) ? $_POST['img'] : '';
    $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';

    $fullName = trim($aname . ' ' . $asurname);
    $stmt = $pdo->prepare("INSERT INTO programs (title, author, description, image_src, moderator_id, type) VALUES (:title, :author, :description, :image_src, :moderator_id, :type)");

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $fullName);
    $stmt->bindParam(':description', $desc);
    $stmt->bindParam(':image_src', $img);
    $stmt->bindParam(':moderator_id', $mid);
    $stmt->bindParam(':type', $type);

    try {
        if ($stmt->execute()) {
            header("Location: addPrograms.php");
            exit;
        } else {
            echo "Error submitting application.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: addPrograms.php");
    exit;
}
?>