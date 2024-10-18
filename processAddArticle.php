<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['adate'];
    $description = $_POST['desc'];
    $img_src = $_POST['img'];
    $cont = $_POST['cont'];
    $tag = $_POST['tag'];

    try {
        $stmt = $pdo->prepare("INSERT INTO news (title, date, description, img_src, type, content) VALUES (:title, :date, :description, :img_src, :type, :content)");
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':img_src', $img_src);
        $stmt->bindParam(':type', $tag);
        $stmt->bindParam(':content', $cont);

        $stmt->execute();

        header("Location: addArticle.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
