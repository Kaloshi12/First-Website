<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
       h1 {
             text-align: center; 
             margin-top: 20px; 
    }   
        .content-table {
            align-items: center;
            border-collapse: collapse;
            margin: 40px auto;
            margin-top: 80px;
            font-size: 0.9em;
            min-width: 800px; 
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

        .content-table th,
        .content-table td {
            padding: 15px;
        }

        .remove {
            width: 70px;
            height: 30px;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #dc3545;
            color: #fff;
            border: 1px solid transparent;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .remove:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    
     <h1>Articles</h1>
    <div class="top-right">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Content</th>
                    <th>Type</th>
                    <th></th>
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
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['img_src'] . '</td>';
                    echo '<td>' . $row['type'] . '</td>';
                    echo '<td> <form method="POST" action="removeArticleProcess.php"> <input type="hidden" name="id" value="' . $row['id'] . '"> <button class="remove" type="submit" name="button">X</button> </form></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>