<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['logout_token'])) {
    $_SESSION['logout_token'] = bin2hex(random_bytes(32));
}
$logout_token = $_SESSION['logout_token'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-MVRn0WSOJwQVb7lWRjKcZJBV9RofNOxibkxrgqzfWGIABwfr0MK9uwPKJbIxvvq1" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    height: 70px; 
    font-size: 20px;
    border-radius: 10px;
    background: transparent;
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
    font-size: 36px;
    margin-left: 10px; 
}

.dropdown-item:hover {
    background-color: #28a745 !important;
    color: white !important;
}

#UserButton .bx,
#contactButton .bx {
    font-size: 28px;
}

#NotifButton .bx {
    font-size: 24px;
    padding-right: 8px;
}
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
        .notification{
            display: none;
        }
        .notification {
            display: none;
            position: absolute;
            z-index: 1000; /* Ensure it appears on top */
            right: 230px;
            top: 70px;
        }

        .notification .box {
            width: 200px;
            height: 250px;
            background: #fff;
            position: relative;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .notification .header {
            margin: 0.2em auto;
            background: #28a745;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.432);
            width: 95%;
            height: 35px;
        }

        .notification .header h6 {
            padding: 5px 5px;
            color: white;
        }

        .notification_box {
            margin: 0.4em auto 0 auto;
            width: 200px;
            height: 200px;
            overflow: auto;
        }

        .notification .notification_box::-webkit-scrollbar {
            width: 10px;
        }

        .notification_box::-webkit-scrollbar-thumb {
            background: #f1f1f1;
        }

        .notification_box::-webkit-scrollbar-thumb {
            background: #888;
        }

        .notification_box::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
    </style>
</head>
<?php
require_once('config.php');
$query = "SELECT count(*) AS unseen_count FROM applicants WHERE `check` = 'unseen'";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);
$count = $row['unseen_count'];
?>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-success bg-gradient">
        <div class="container-fluid">
        <img src="images/logowhite.png" height="70px">
        <a class="navbar-brand" href="home.php">Thashetheme</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-right: 10px;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="LiveNews" href="http://localhost/project/livenews.php">Live News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="Sport" href="http://localhost/project/sport.php">Sport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="PopNews" href="http://localhost/project/popnews.php">Pop News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="Programs" href="http://localhost/project/programs.php">Programs</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                   
                    <li class="nav-item">
                        <div class="contact-user-buttons">
                            <button id="contactButton" type="button"  class="btn btn-sm btn-transparent pb=0" style="margin-right: 10px;" onclick="location.href='editApplications.php';" >
                                <i class='bx bxs-contact'></i>
                            </button>
                            
                          
                            <button id="UserButton" type="button" class="btn btn-sm btn-transparent pb=0" onclick="location.href='EditUser.php';">
                                <i class='bx bxs-user'></i>
                            </button>
                        </div>
                    </li>
                </ul>
                <button type="button" class="btn btn-transparent position-relative" id="NotifButton" style="margin-right: 9px;">
                <i class='bx bx-bell'></i>
                <span class="position-absolute top-0 start-90 translate-middle badge rounded-pill bg-danger" id="nrNotifs" style="margin-top: 5px;">
                    
                        <?php echo $count; ?>
                </span>
                </button>
                
                <form id="searchForm" class="d-flex" role="search" action="search.php" method="get">
                <div id="search">
                    <span class="material-symbols-outlined">search</span>
                    <input id="search-input" name="query" type="search" placeholder="Search" aria-label="Search">
                </div>
            </form>
               
                <div class="dropdown">
                    <button id="dropdownButton" class="btn bg-success bg-gradient dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownButton">
                    <li><a class="dropdown-item" href="logout.php?token=<?= $logout_token ?>&return_to=">LogOut</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="http://localhost/project/devmenu.php">Developer Menu</a></li>
                    </ul>
                </div>
               
            </div>
        </div>
    </nav>
    <div id="notification" class="notification">
       <div class="box"> 
        <div class="header">
        <h6><i class='bx bxs-bell'><?php echo $count; ?></i> Notifications</h6>
        </div>
   <div class="notification_box">
        <?php 
       require_once('config.php');

       try {
          
           $stmt = $pdo->query("SELECT * FROM applicants WHERE `check` = 'unseen'");
       
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               echo "<i class='bx bxs-user'></i> " . htmlspecialchars($row['fname']) . " " . htmlspecialchars($row['lname']) . "<br>". htmlspecialchars($row['email']). "<br> <br>";
           }
       } catch (PDOException $e) {
           echo "Error: " . $e->getMessage();
       }
        ?>
   </div> 
   </div>
    </div>
</div>

<script>
    const contactButton = document.getElementById('contactButton');
    const userButton = document.getElementById('UserButton');
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenuItems = document.querySelectorAll('.dropdown-item');
    const notifyBtn = document.getElementById('NotifButton');
const blocNotify = document.getElementById('notification');

notifyBtn.addEventListener('click', function(event) {
    if (blocNotify.style.display === 'block') {
        blocNotify.style.display = 'none';
    } else {
        blocNotify.style.display = 'block';
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'headerOwner.php', true); 
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log('Notifications updated successfully');
                    document.getElementById('nrNotifs').textContent = '0';
                } else {
                    console.error('Failed to update notifications');
                }
            }
        };
        xhr.send();
    }
    event.stopPropagation();
});





document.addEventListener('click', function(event) {
    if (!blocNotify.contains(event.target) && !notifyBtn.contains(event.target)) {
        blocNotify.style.display = 'none';
    }
});
    dropdownButton.addEventListener('mouseover', function() {
        dropdownButton.style.backgroundColor = '#28a745';
    });

    dropdownButton.addEventListener('mouseout', function() {
        dropdownButton.style.backgroundColor = '';
    });

    dropdownMenuItems.forEach(item => {
        item.addEventListener('mouseover', function() {
            item.style.backgroundColor = '#28a745';
            item.style.color = 'white';
        });
        
        item.addEventListener('mouseout', function() {
            item.style.backgroundColor = '';
            item.style.color = '';
        });
        contactButton.addEventListener('mouseover', function() {
        contactButton.style.width = '70px';
        contactButton.innerHTML = 'Applications';
    });

    contactButton.addEventListener('mouseout', function() {
        contactButton.style.width = '';
        contactButton.innerHTML = '<i class="bx bxs-contact"></i>';
    });

    userButton.addEventListener('mouseover', function() {
        userButton.style.width = '70px';
        userButton.innerHTML = 'User';
    });

    userButton.addEventListener('mouseout', function() {
        userButton.style.width = ''; 
        userButton.innerHTML = '<i class="bx bxs-user"></i>';
    });
    });
    document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const searchQuery = document.getElementById('search-input').value;
    window.location.href = `search.php?query=${encodeURIComponent(searchQuery)}`;
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
<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $query = "UPDATE applicants SET `check` = 'seen' WHERE `check` = 'unseen'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>