<?php
session_start();

function checkAccessLevel($required_level) {
    if (!isset($_SESSION["username"]) || !isset($_SESSION["access_level"])) {
        $_SESSION["error"] = "You must be logged in to access this page.";
        header("Location: login.php");
        exit;
    }

    if ($required_level === "owner" && $_SESSION["access_level"] === "developer") {
        header("Location: devmenu.php");
        exit;
    }
    
 
    if ($required_level === "developer" && $_SESSION["access_level"] === "owner") {
        header("Location: devmenu.php");
        exit;
    }

}

function loginCheck() {
    if (isset($_SESSION["username"]) || isset($_SESSION["access_level"])) {
        header("Location: home.php");
        exit;
    }
}
?>