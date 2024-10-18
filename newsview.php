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

require_once 'config.php';

$news = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        $stmt = $pdo->prepare('SELECT * FROM news WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $news = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (!$news) {
        $error = "News article not found.";
    }

    $stmt2 = $pdo->query("SELECT * FROM news");

    if (!$stmt2) {
        die("Error executing query: " . $pdo->errorInfo()[2]);
    }
    $newsRows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .card-img-top1 {
            width: 95%;
            height: 170px;
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
        .card-body1 {
            min-height: 170px;
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
    </style>
</head>
<body>
    <br>
    <div style="width: 65%;">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php else: ?>
            <h2 style="padding-left: 50px;">
                <?= htmlspecialchars($news['title']) ?>
            </h2>
            <div style="padding-left: 55px;">
                <div style="padding-top: 5px;">
                    <div class="badge bg-primary text-wrap" style="width: 6rem;">
                        <?= htmlspecialchars($news['type']) ?>
                    </div>
                </div>
                <div style="padding-top: 7px;">
                    <h7 class="text-muted"><?= htmlspecialchars($news['date']) ?></h7>
                </div>
                <hr>
                <div>
                    <img src="<?= htmlspecialchars($news['img_src']) ?>" width="90%" height="450px" alt="News Image">
                </div>
                <br><br>
                <div style="width: 90%; padding-left: 1%">
                    <h6><?= nl2br(htmlspecialchars($news['content'])) ?></h6>
                </div>
                <br><br>
            </div>
        <?php endif; ?>
    </div>
    <br>
    <hr>
    <div class="row row-cols-1 row-cols-md-4 g-5" style="padding-left: 20px; padding-right: 10px;">
        <?php
        $index = 0; 
        for ($i = 0; $i < 8; $i++) {
            $description = $newsRows[$index + $i]['description'];
            $firstSentenceEnd = strpos($description, '.');
            $firstSentence = ($firstSentenceEnd !== false) ? substr($description, 0, $firstSentenceEnd + 1) : $description;
        ?>
            <div class="col">
                <div class="card">
                    <img src="<?= htmlspecialchars($newsRows[$index + $i]['img_src']) ?>" class="card-img-top1" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($newsRows[$index + $i]['title']) ?></h5>
                        <p class="card-text" id="bigNewsDescription"><?= htmlspecialchars($firstSentence) ?></p>
                        <form method="POST" action="newsview.php">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($newsRows[$index + $i]['id']) ?>">
                            <button type="submit" class="btn btn-primary btn-read">Read</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div style="position: absolute; top: 0; right: 0; margin-top: 130px; padding-right: 10px; padding-left: 10px">
        <img src="images/ad1.jpeg" alt="Advertisement" class="img-fluid mb-3" width="400px" height="400pxs" style="padding-left: 80px; padding-bottom: 20px">
        <br>
        <?php
        $index = 8; 
        for ($i = 0; $i < 3; $i++) {
            $description = $newsRows[$index + $i]['description'];
            $firstSentenceEnd = strpos($description, '.');
            $firstSentence = ($firstSentenceEnd !== false) ? substr($description, 0, $firstSentenceEnd + 1) : $description;
        ?>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= htmlspecialchars($newsRows[$index + $i]['img_src']) ?>" class="card-img-top1" alt="..." width="190px" height="200px">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body1">
                            <h5 class="card-title"><?= htmlspecialchars($newsRows[$index + $i]['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($firstSentence) ?></p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        <?php } ?>
    </div>
</body>
<?php require_once("footer.php"); ?>
</html>
