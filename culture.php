<?php

session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["access_level"])) {
    if ($_SESSION["access_level"] == "developer") {
        require_once "headerDev.php";
    } elseif ($_SESSION["access_level"] == "owner") {
        require_once "headerOwner.php";
    }
} else {
    require_once "header.php";
}
require_once("config.php");

$stmt = $pdo->prepare("SELECT * FROM news WHERE type = 'Culture'");
$stmt->execute();
$lifestyleNews = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture</title>
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
            position: relative;
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
            right: 10px;
        }
        .btn-read1 {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 150px;
        }
    </style>
</head>
<body style="background: #fff0f7;">
    <br>
    <div style="padding-left: 30px; padding-right: 31px;">
        <h2 class="text-center" style="margin-bottom: 25px;">Culture News</h2> 

        <?php $description = $lifestyleNews[0]['description'];
        $firstSentenceEnd = strpos($description, '.');

        $firstSentence = ($firstSentenceEnd !== false) ? substr($description, 0, $firstSentenceEnd + 1) : $description;
        ?>
    <div class="card border-0 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
            <a href="newsview.php?id=<?= $lifestyleNews[0]['id'] ?>">
                        <img src="<?= $lifestyleNews[0]['img_src'] ?>" class="card-img-top1" alt="...">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title" >
                            <a style="text-decoration: none; color: black;" href="newsview.php?id=<?= $lifestyleNews[0]['id'] ?>">
                                <?= $lifestyleNews[0]['title'] ?>
                            </a>
                        </h4>
                        <p class="card-text" id="bigNewsDescription"><?= $firstSentence ?></p>
                        <form id="bigCardForm" method="POST" action="newsview.php">
                            <input type="hidden" name="id" id="bigCardId" value="<?= htmlspecialchars($lifestyleNews[0]['id']) ?>">
                            <button type="submit" class="btn btn-primary btn-read1" id="rdbtn">Read</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <br>
    <div class="row row-cols-1 row-cols-md-4 g-5" style="padding-top: 12px;">
        <?php
        $index = 1;
        $nr = count($lifestyleNews);
        for($i = 0; $i < $nr - $index; $i++) {
            $description = $lifestyleNews[$index + $i]['description'];
            $firstSentenceEnd = strpos($description, '.');
            $firstSentence = ($firstSentenceEnd !== false) ? substr($description, 0, $firstSentenceEnd + 1) : $description;
        ?>
            <div class="col">
                <div class="card">
                    <img src="<?= $lifestyleNews[$index + $i]['img_src'] ?>" class="card-img-top1" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $lifestyleNews[$index + $i]['title'] ?></h5>
                        <p class="card-text" id="bigNewsDescription"><?= $firstSentence ?></p>
                        <form method="POST" action="newsview.php">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($lifestyleNews[$index + $i]['id']) ?>">
                            <button type="submit" class="btn btn-primary btn-read">Read</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<br>

</body>
<?php
require_once("footer.php");
?>
</html>
