<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logout_token'])) {
    $_SESSION['logout_token'] = bin2hex(random_bytes(32));
}
$logout_token = $_SESSION['logout_token'];

if (isset($_GET['token']) && $_GET['token'] === $_SESSION['logout_token']) {
    $_SESSION = array();

    
    session_destroy();

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <style>
        body {
            background-color: #f0f0f0;
        }

        .menu-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .menu-button {
            width: 220px;
            height: 60px;
            font-size: 18px;
            border-radius: 10px;
            background-color: transparent;
            color: #28a745;
            margin: 10px 0;
            border: 2px solid #28a745;
            transition: all 0.3s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .menu-button:hover {
            background-color: #28a745;
            color: white;
        }

        .menu-button .bx {
            font-size: 24px;
            margin-left: 10px;
        }

        .dropdown-item:hover {
            background-color: #28a745 !important;
            color: white !important;
        }

        .icon-large {
            font-size: 28px;
        }

         
    #search {
            width: max-content;
            display: flex;
            align-items: center;
            padding: 14px;
            border-radius: 28px;
            background: #e8e8e8;
            margin-right: 10px;
            transition: 0.1s ease;
        }
        #search-input {
            font-size: 16px;
            font-family: 'Lexend', sans-serif;
            color: #333333;
            margin-left: 14px;
            outline: none;
            border: none;
            background: transparent;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning bg-gradient">
        <div class="container-fluid">
        <img src="images/logowhite.png" height="70px">
        <a class="navbar-brand" href="home.php">Thashetheme</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-right: 10px;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="home" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="livenews" href="livenews.php">Live News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="sport" href="sport.php">Sport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="popnews" href="popnews.php">Pop News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="programs" href="programs.php">Programs</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="topnews.php">Top News</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="business.php">Business</a></li>
                            <li><a class="dropdown-item" href="economy.php">Economy</a></li>
                            <li><a class="dropdown-item" href="world.php">World</a></li>
                            <li><a class="dropdown-item" href="culture.php">Culture</a></li>
                            <li><a class="dropdown-item" href="lifestyle.php">Lifestyle</a></li>
                        </ul>
                    </li>
                </ul>
                <form id="searchForm" class="d-flex" role="search" action="search.php" method="get">
                <div id="search">
                    <span class="material-symbols-outlined">search</span>
                    <input id="search-input" name="query" type="search" placeholder="Search" aria-label="Search">
                </div>
            </form>
                <div class="dropdown">
                    <button id="dropdownButton" class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownButton">
                    <li><a class="dropdown-item" href="logout.php?token=<?= $logout_token ?>">LogOut</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="http://localhost/project/devmenu.php">Developer Menu</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <script>
        document.getElementById('search-input').addEventListener('focus', function() {
            this.classList.add('expanded');
        });

        document.getElementById('search-input').addEventListener('blur', function() {
            if (!this.value) {
                this.classList.remove('expanded');
            }
        });

        document.getElementById('search-input').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('searchForm').submit(); 
    }
});
    </script>
</body>
</html>
