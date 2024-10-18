
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
    <title>Add Moderator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: azure;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1200px;
            margin-top: 70px;
            margin-left: 20px;
            padding: 20px;
        }
        .top-right {
            margin-top: 100px; 
            margin-left: 50px;
        }
        .form {
            width: 45%;
            background: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form h3 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        /* .btn {
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
        .btn:hover {
            background-color: #0056b3;
        } */
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
            top: 0;
            right: -300px;
            margin-top: 60px;
            margin-right: 500px;
            margin-left: 300px;
        }
        .content-table {
            border-collapse: collapse;
            margin: 40px auto; 
            margin-top: 80px;
            margin-left: 50px;
            font-size: 0.9em;
            min-width: 600px; 
            border-radius: 5px 5px 0 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
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
        .content-table th, .content-table td {
            padding: 15px; 
        }



    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <h3>Add Moderator</h3>
            <form action="addmoderatorprocess.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Name" class="form-control" required>
                <label for="surname">Surname</label>
                <input type="text" name="surname" placeholder="Surname" class="form-control" required>
                <br>
                <button type="submit" class="btn">Add Moderator</button>
            </form>
        </div>
        <div class="top-right">
        <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once 'config.php';

                $stmt = $pdo->query('SELECT * FROM moderators');
                while ($row = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['surname'] . '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
        </table>
        </div>
    </div>
</body>
</html>
