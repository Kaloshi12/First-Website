<?php

require_once "config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    $bDate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $appLetter = isset($_POST['appLetter']) ? $_POST['appLetter'] : '';
    $status = 'unseen'; 
    $username = $fname . $lname . "24";

    $stmt = $pdo->prepare("INSERT INTO applicants (fname, lname, username, email, phonenumber, birthdate, gender, appLetter, `check`) 
                           VALUES (:fname, :lname,:username,:email, :phone, :bDate, :gender, :appLetter, :status)");

    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':bDate', $bDate);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':appLetter', $appLetter);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':username', $username);

    
    try {
        if ($stmt->execute()) {
            header("Location: home.php");
            exit;
        } else {
            echo "Error submitting application.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: apply.php");
    exit;
}
?>



