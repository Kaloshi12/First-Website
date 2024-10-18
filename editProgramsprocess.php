<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $title = isset($_POST["title"]) ? $_POST["title"] : '';
    $description = isset($_POST["description"]) ? $_POST["description"] : '';
    $mid = isset($_POST["moderatorID"]) ? intval($_POST["moderatorID"]) : null;
    $img = isset($_POST["image"]) ? $_POST["image"] : '';
    $type = isset($_POST["type"]) ? $_POST["type"] : '';
    $fname = isset($_POST["authorFName"]) ? $_POST["authorFName"] : '';

    if ($id && $title && $description && $mid && $img && $type && $fname) {
        $stmt = $pdo->prepare("UPDATE programs SET title = :title, description = :description, image_src = :image_src, type = :type, moderator_id = :moderator_id, author = :author WHERE id = :id");
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image_src', $img);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':moderator_id', $mid, PDO::PARAM_INT);
        $stmt->bindParam(':author', $fname);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "No changes made"]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "Failed to update program"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Invalid input data"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
