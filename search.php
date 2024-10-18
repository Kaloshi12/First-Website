<?php
session_start();
require_once("config.php");

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    require_once("header.php");
} else {
    // If logged in, check access level
    if ($_SESSION["access_level"] == "developer") {
        require_once("headerDev.php");
    } elseif ($_SESSION["access_level"] == "owner") {
        require_once("headerOwner.php");
    } else {
        require_once("header.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title display="bloc">Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .card {
            margin: 15px 0;
            height: 100%;
        }
        .card-body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-text {
            flex-grow: 1;
        }
    </style></head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Search Results</h1>
        <div class="row row-cols-1 row-cols-md-4 g-5">
            <?php
            // Fetch search results from the database
            if (isset($_GET['query'])) {
                $search_query = $_GET['query'];
                $stmt = $pdo->prepare("SELECT * FROM news WHERE title LIKE ?");
                $stmt->execute(["%$search_query%"]);
                $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($searchResults) {
                    // Display search results as cards
                    foreach ($searchResults as $news):
                    ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo $news['img_src']; ?>" class="card-img-top" alt="News Image">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $news['title']; ?></h5>
                                <p class="card-text">
                                    <?php
                                    $description = $news['description'];
                                    $firstSentenceEnd = strpos($description, '.');
                                    if ($firstSentenceEnd !== false) {
                                        echo substr($description, 0, $firstSentenceEnd + 1);
                                    } else {
                                        echo $description;
                                    }
                                    ?>
                                </p>
                                <form method="POST" action="newsview.php">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($news['id']) ?>">
                            <button type="submit" class="btn btn-primary btn-read">Read More</button>
                        </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                } else {
                   echo " <div style='padding-left: 400px;'>
                   <img src='images/notF.jpeg' width='600px' height='600px'>
               </div>";
                }
            }
            ?>
        </div>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
