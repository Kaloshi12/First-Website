<?php
require_once("config.php");

$sql = "SELECT * FROM users";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . ", Name: " . $row['name'] . "<br>";
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
