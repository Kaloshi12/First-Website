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
    <title>Edit Programs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
        .edit {
            width: 70px;
            height: 30px;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #F6E709;
            color: black;
            border: 1px solid transparent;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
        }
        .edit:hover {
            background-color: #D0C306;
        }
    </style>
</head>
<body>
   
    <h1>Programs</h1>
    <div class="top-right">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Moderator</th>
                    <th>Author</th>
                    <th>Type</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'config.php';

                $stmt = $pdo->query("SHOW COLUMNS FROM programs LIKE 'type'");
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $types = [];
                if (preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches)) {
                    $types = explode("','", $matches[1]);
                }

                $moderatorsStmt = $pdo->query("SELECT id, name, surname FROM moderators");
                $moderators = $moderatorsStmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt = $pdo->query('SELECT * FROM programs');
                while ($row = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td contenteditable="false">' . htmlspecialchars($row['title']) . '</td>';
                    echo '<td contenteditable="false">' . htmlspecialchars($row['description']) . '</td>';
                    echo '<td contenteditable="false">' . htmlspecialchars($row['image_src']) . '</td>';
                    echo '<td>';
                    echo '<select class="moderator-select" disabled>';
                    foreach ($moderators as $moderator) {
                        $moderatorName = htmlspecialchars($moderator['name'] . ' ' . $moderator['surname']);
                        $selected = $row['moderator_id'] == $moderator['id'] ? 'selected="selected"' : '';
                        echo '<option value="' . htmlspecialchars($moderator['id']) . '" ' . $selected . '>' . $moderatorName . '</option>';
                    }
                    echo '</select>';
                    echo '</td>';
                    echo '<td contenteditable="false">' . htmlspecialchars($row['author']) . '</td>';
                    echo '<td>';
                    echo '<select class="type-select" disabled>';
                    foreach ($types as $type) {
                        $type = trim($type);
                        $selected = in_array($type, explode(',', $row['type'])) ? 'selected="selected"' : '';
                        echo '<option value="' . htmlspecialchars($type) . '" ' . $selected . '>' . htmlspecialchars($type) . '</option>';
                    }
                    echo '</select>';
                    echo '</td>';
                    echo '<td><button type="button" class="btn btn-success" disabled><i class="bx bx-check"></i></button></td>';
                    echo '<td><button class="edit" data-id="' . htmlspecialchars($row['id']) . '">Edit</button></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
    $(document).ready(function () {
        $('.edit').click(function () {
            $('.edit').show();
            $('.btn-success').prop('disabled', true);
            $('select.type-select, select.moderator-select').prop('disabled', true);
            $('.content-table tbody tr td').attr('contenteditable', 'false');
            
            var row = $(this).closest('tr');
            row.find('td:nth-child(n+2):nth-last-child(n+3)').attr('contenteditable', 'true');
            row.find('select.type-select, select.moderator-select').prop('disabled', false);
            row.find('.btn-success').prop('disabled', false);
            $(this).hide();
            
            row.find('td:first-child, td:nth-last-child(-n+2)').attr('contenteditable', 'false');
        });

        $('.btn-success').click(function () {
            var row = $(this).closest('tr');
            var id = row.find('td:first').text();
            var title = row.find('td:nth-child(2)').text();
            var description = row.find('td:nth-child(3)').text();
            var image = row.find('td:nth-child(4)').text();
            var moderatorID = row.find('select.moderator-select').val();
            var authorFName = row.find('td:nth-child(6)').text();
            var type = row.find('select.type-select').val();

            $.ajax({
                url: 'editProgramsprocess.php',
                type: 'POST',
                data: {
                    id: id,
                    title: title,
                    description: description,
                    image: image,
                    moderatorID: moderatorID,
                    type: type,
                    authorFName: authorFName
                },
                success: function (response) {
                    try {
                        var data = JSON.parse(response);
                        if (data.success) {
                            alert('Program updated successfully!');
                            row.find('td:nth-child(n+2):nth-last-child(n+3)').attr('contenteditable', 'false');
                            row.find('select.type-select, select.moderator-select').prop('disabled', true);
                            $('.edit').show();
                        } else {
                            alert('Error updating program: ' + data.error);
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        alert('Error processing response!');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error updating program:', textStatus, errorThrown);
                    alert('Error updating program!');
                }
            });
        });
    });
    </script>
</body>
</html>
