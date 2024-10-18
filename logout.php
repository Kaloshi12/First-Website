<?php
session_start();

if (isset($_GET['token']) && $_GET['token'] === $_SESSION['logout_token']) {
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();

    header("Location: home.php");
    exit;
} else {
    $return_to = isset($_GET['return_to']) ? $_GET['return_to'] : 'devmenu.php';
    header("Location: $return_to");
    exit;
}
?>
