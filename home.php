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

$stmt = $pdo->query("SELECT * FROM news ORDER BY date DESC");

if (!$stmt) {
    die("Error executing query: " . $pdo->errorInfo()[2]);
}

$newsRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        .btn-read:hover {
            background: #64B5F6;
        }
        .btn-read1 {
            position: relative;
            left: 700px;
            width: 150px;
            right: 0;
            bottom: 0;
        }
    </style>
</head>
<body>
<br>
<div style="padding-left: 30px; padding-right: 31px;">
    <div class="card border-0 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img class="card-img-top1" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title mb-0">Card title</h4>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                    <div class="d-flex justify-content-between align-items-end">
                        <form id="bigCardForm" method="POST" action="newsview.php">
                            <input type="hidden" name="id" id="bigCardId">
                            <button type="submit" class="btn btn-primary btn-read1" id="rdbtn">Read</button>
                        </form>
                        <div>
                            <button id="prevCardBtn" class="btn btn-transparent me-2"><</button>
                            <button id="nextCardBtn" class="btn btn-transparent">></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row row-cols-1 row-cols-md-4 g-5" style="padding-top: 12px;">
        <?php
        $index = 4; 
        for ($i = 0; $i < 12; $i++) {
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
</div>
<br>
<?php
$cards = [];
for ($i = 0; $i < 4; $i++) {
    $cards[$i] = [
        'id' => $newsRows[$i]['id'],
        'title' => $newsRows[$i]['title'],
        'text' => $newsRows[$i]['description'],
        'imgUrl' => $newsRows[$i]['img_src']
    ];
}
?>

<script>
    var cards = <?php echo json_encode($cards); ?>;
    var currentCardIndex = 0;

    function updateCard() {
        var card = cards[currentCardIndex];
        document.querySelector('.card-img-top1').src = card.imgUrl;
        document.querySelector('.card-title').textContent = card.title;
        document.querySelector('.card-text').textContent = card.text;
        document.getElementById('bigCardId').value = card.id; 
    }

    document.getElementById('nextCardBtn').addEventListener('click', function() {
        currentCardIndex = (currentCardIndex + 1) % cards.length;
        updateCard();
    });

    document.getElementById('prevCardBtn').addEventListener('click', function() {
        currentCardIndex = (currentCardIndex - 1 + cards.length) % cards.length;
        updateCard();
    });

    updateCard();
</script>

</body>
<?php require_once("footer.php"); ?>
</html>
