<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $access_level = $_POST["access_level"];

    $stmt = $pdo->prepare("UPDATE users SET name = ?, surname = ?, access_level = ? WHERE id = ?");
    $stmt->execute([$name, $surname, $access_level, $id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to update user"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
