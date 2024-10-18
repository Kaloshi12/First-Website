<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

   
    $stmt = $pdo->prepare('SELECT * FROM applicants WHERE Id = :Id');
    $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $applicant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($applicant) {
        $fname = $applicant['fname'];
        $lname = $applicant['lname'];

        
        $username = $fname . $lname . '24';
        $givenPass = '12345678';
        $salt = bin2hex(random_bytes(16));
        $saltedPass = $givenPass . $salt;
        $password = hash("sha256", $saltedPass);
        $name = $fname;
        $surname = $lname;
        $access_level = 'developer';

       
        $insertStmt = $pdo->prepare('INSERT INTO users (username, password, salt, name, surname, access_level) VALUES (:username, :password, :salt, :name, :surname, :access_level)');
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':password', $password);
        $insertStmt->bindParam(':salt', $salt);
        $insertStmt->bindParam(':name', $name);
        $insertStmt->bindParam(':surname', $surname);
        $insertStmt->bindParam(':access_level', $access_level);

        if ($insertStmt->execute()) {
           
            $deleteStmt = $pdo->prepare('DELETE FROM applicants WHERE Id = :Id');
            $deleteStmt->bindParam(':Id', $id, PDO::PARAM_INT);
            if ($deleteStmt->execute()) {
                echo 'success';
                exit(); 
            } else {
                echo "Error deleting the applicant.";
            }
        } else {
            echo "Error inserting the new user.";
        }
    } else {
        echo "Applicant not found.";
    }
}
?>
