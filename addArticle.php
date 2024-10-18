<?php
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["access_level"])) {
    if ($_SESSION["access_level"] == "developer") {
        require_once "headerDev.php";
    } elseif ($_SESSION["access_level"] == "owner") {
        require_once "headerOwner.php";
    }
} else {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: azure;
        }
        .form {
            margin-left: 30px;
            margin-top: 70px;
            width: 100%;
            max-width: 650px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow:0 0 10px rgba(0, 0, 0,.2) ;
            color : black;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .form h3 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .top-right {
            position: absolute;
            top: 115px;
            left: 690px;
            right:0;
        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 50px;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-left: 2px black;
        }

        .content-table thead tr {
            background-color: #ffd500;
            color: black;
            text-align: center;
        }

        .content-table tbody tr {
            text-align: center;
            border-bottom: 1px solid black;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #ffd500;
        }

        .content-table th,
        .content-table td {
            padding: 10px 15px;
        }

       
    </style>
</head>
<body>
    <div class="form">
        <h3>Article</h3>
        <form action="processAddArticle.php" method="post">
            <div class="form-group">
                <label for="title">Article Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="adate">Article Date:</label>
                <input type="date" name="adate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="desc">Description:</label>
                <textarea name="desc" rows="5" class="form-control" placeholder="Description..."></textarea>
            </div>
            
            <div class="form-group">
                <label for="img">Image:</label>
                <input type="text" name="img" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="desc">Content:</label>
                <textarea name="cont" rows="5" class="form-control" placeholder="Content..."></textarea>
            </div>

            <div class="form-group">
                <label for="tag">Tags:</label>
                <select name="tag" class="form-control" required>
                    <option>Top News</option>
                    <option>Sport</option>
                    <option>Pop News</option>
                    <option>Business</option>
                    <option>Economy</option>
                    <option>World</option>
                    <option>Culture</option>
                    <option>Lifestyle</option>
                    <option>Other</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Article</button>
        </form>
    </div>

    <div class="top-right">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Tag</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once 'config.php';

                $stmt = $pdo->query('SELECT * FROM news');
                while ($row = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['img_src'] . '</td>';
                    echo '<td>' . $row['type'] . '</td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
        var form = document.getElementById('articleForm');
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert('New news record created successfully');
                    window.location.href = 'addArticle.php';
                } else {
                    alert('Error: ' + xhr.responseText);
                    window.location.href = 'addArticle.php';
                }
            }
        };

        xhr.open('POST', 'processAddArticle.php', true);
        xhr.send(formData);
    });
</script>
</body>
</html>
