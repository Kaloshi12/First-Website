<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = isset($_POST['id']) ? $_POST['id'] : '';

    $stmt = $pdo->prepare('DELETE FROM news WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: removeArticle.php'); 
        exit();
    } else {
        echo "Error removing moderator.";
    }
}
?>