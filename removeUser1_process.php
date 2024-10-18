<?php
// Include your database connection file
require_once 'config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the ID of the user to be deleted
    $id = $_POST["id"];

    // Delete the user from the database
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    // Check if the deletion was successful
    if ($stmt->rowCount() > 0) {
        // Send a success response
        echo json_encode(["success" => true]);
    } else {
        // Send an error response
        echo json_encode(["success" => false, "error" => "Failed to delete user"]);
    }
} else {
    // Send an error response if the request method is not POST
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
