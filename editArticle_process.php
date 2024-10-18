<?php

require_once 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $date = $_POST["date"];
    $description = $_POST["description"];
    $img_src = $_POST["img_src"];
    $type = $_POST["type"];

    $stmt = $pdo->prepare("UPDATE news SET title = ?, date = ?, description = ?, img_src = ?, type = ? WHERE id = ?");
    $stmt->execute([$title, $date, $description, $img_src, $type, $id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to update article"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
