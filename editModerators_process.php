<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    

    $stmt = $pdo->prepare("UPDATE moderators SET  name = ?, surname = ? WHERE id = ?");
    $stmt->execute([$name,$surname,$id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to update article"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
