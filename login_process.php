<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "config.php";

    $username = $_POST["singInUserName"];
    $password = $_POST["SinginPass"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        $saltedPassword = $password . $user['salt'];
        $hashedPassword = hash("sha256", $saltedPassword);

        if ($hashedPassword === $user['password']) {
            $_SESSION["username"] = $username;
            $_SESSION["access_level"] = $user['access_level'];
            $_SESSION['logout_token'] = bin2hex(random_bytes(32));

            if ($user['access_level'] == "developer") {
                header("Location: devmenu.php");
            } else {
                header("Location: home.php");
            }
            exit;
        } else {
            $_SESSION["error"] = "Invalid username or password";
        }
    } else {
        $_SESSION["error"] = "Invalid username or password";
    }

    header("Location: login.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>
