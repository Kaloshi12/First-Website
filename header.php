
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style>
    #search {
            width: max-content;
            display: flex;
            align-items: center;
            padding: 14px;
            border-radius: 28px;
            background: #e8e8e8;
            margin-right: 10px;
            transition: width 0.2s ease; 
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
<div>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-gradient" style="background-color: rgba(0, 0, 139, 0.8);">
        <div class="container-fluid">
            <img src="images/logowhite.png" height="70px">
            <a class="navbar-brand" href="home.php">Thashetheme</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-right: 10px;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="Home" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="LiveNews" href="livenews.php">Live News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="Sport" href="sport.php">Sport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="PopNews" href="popnews.php">Pop News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="Programs" href="programs.php">Programs</a>
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
            </div>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: rgb(123, 104, 238);">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" >
                    <li><a class="dropdown-item" href="login.php">LogIn</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="apply.php">Contact us</a></li>
                    <li><a class="dropdown-item" href="aboutUs.php">About us</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>
</div> 

<script>
      document.getElementById('search-input').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('searchForm').submit(); 
    }
});

    function resizeInput() {
        document.getElementById('search-input').style.transition = '0.3s ease';
        document.getElementById('search-input').style.width = '300px';
    }

    function handleClickOutside(event) {
        const searchInput = document.getElementById('search-input');
        const searchContainer = document.getElementById('search');

        if (!searchContainer.contains(event.target)) {
            document.getElementById('search-input').style.width = 'max-content';
        }
    }

    document.getElementById('search-input').addEventListener('click', resizeInput);
    document.addEventListener('click', handleClickOutside);
    
    </script>

   