<?php
session_start();
require_once("config.php");

if (!isset($_SESSION["username"])) {
    require_once("header.php");
} else {
    if ($_SESSION["access_level"] == "developer") {
        require_once("headerDev.php");
    } elseif ($_SESSION["access_level"] == "owner") {
        require_once("headerOwner.php");
    } else {
        require_once("header.php");
    }
}

$stmt = $pdo->prepare("SELECT * FROM programs");
$stmt->execute();
$lifestyleNews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .card-img-top1 {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .card {
            height: auto;
        }
        .card-body {
            min-height: 250px;
            max-height: 375px;
            overflow: hidden;
        }
        .card-text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
        .btn-read {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }
    </style>
</head>

<body style="background: #fff0f7;">
    <br>
    <div style="padding-left: 30px; padding-right: 31px;">
        <h2 class="text-center" style="margin-bottom: 25px;">Programs</h2> 

        <?php 
        foreach ($lifestyleNews as $program) {
            $description = $program['description'];
            $firstSentenceEnd = strpos($description, '.');
            $firstSentence = ($firstSentenceEnd !== false) ? substr($description, 0, $firstSentenceEnd + 1) : $description;
        ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="newsview.php?id=<?= $program['id'] ?>">
                            <img src="<?= $program['image_src'] ?>" class="card-img-top1" alt="...">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a style="text-decoration: none; color: black;" href="newsview.php?id=<?= $program['id'] ?>">
                                    <?= $program['title'] ?>
                                </a>
                            </h4>
                            <p class="card-text" id="bigNewsDescription"><?= $firstSentence ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <br>
</body>
<?php
require_once("footer.php");
?>
</html>