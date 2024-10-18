
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
    <title>Add Programs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: azure;
        }
        .form {
            margin-top: 50px;
            margin-left: 10px;
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

       #buton{
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

        #buton:hover {
            background-color: #0056b3;
        }

        .top-right {
            position: absolute;
            top: 100px;
            left : 590px;

        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 50px;
            margin-left: 100px;
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
    <div class="form">
        <h3>Programs</h3>
        <form action="addPrograms_process.php" method="post">
            <div class="form-group">
                <label for="title">Program  Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="authorName">Author Name:</label>
                <input type="text" name="authorName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="authorSurname">Author Surname</label>
                <input type="text" name="authorSurname" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="moderatorId">Moderator</label>
                <select name="moderatorId" class="form-control" required>
                <?php
                require_once 'config.php';

                $stmt = $pdo->query('SELECT * FROM moderators');
                while ($row = $stmt->fetch()){
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . ' ' . $row['surname'] . '</option>';
                }
                ?>
                </select>
            </div>

            <div class="form-group">
                <label for="img">Image</label>
                <input type="text" name="img" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="desc">Description:</label>
                <textarea name="desc" rows="5" class="form-control" placeholder="Enter article description..."></textarea>
            </div>

            <div class="form-group">
                <label for="tag">Type</label>
                <select name="type" class="form-control" required>
                    <option>TV Show</option>
                    <option>Documentary</option>
                    <option>News Program</option>
                    <option>Reality Show</option>
                    <option>Other</option>
                </select>
            </div>
            <button id="buton" type="submit" class="btn btn-primary">Submit Article</button>
        </form>
    </div>

    <div class="top-right">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>ModeratorId</th>
                    <th>Type</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once 'config.php';

                $stmt = $pdo->query('SELECT * FROM programs');
                while ($row = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['image_src'] . '</td>';
                    echo '<td>' . $row['moderator_id'] . '</td>';
                    echo '<td>' . $row['type'] . '</td>';
                    echo '<td>' . $row['author'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
