<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once 'config.php';

                $stmt = $pdo->query("SHOW COLUMNS FROM news LIKE 'type'");
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $types = [];
                if (preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches)) {
                    $types = explode("','", $matches[1]);
                }

                $stmt = $pdo->query('SELECT * FROM news');
                while ($row = $stmt->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td contenteditable="false">' . $row['title'] . '</td>';
                    echo '<td contenteditable="false">' . $row['date'] . '</td>';
                    echo '<td contenteditable="false">' . $row['description'] . '</td>';
                    echo '<td contenteditable="false">' . $row['img_src'] . '</td>';
                    echo '<td contenteditable="false">' . $row['content'] . '</td>';
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
                    echo '<td><button class="edit" data-id="' . $row['id'] . '">Edit</button></td>';
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
        $('select.type-select').prop('disabled', true);
        $('.content-table tbody tr td').attr('contenteditable', 'false');
        
        var row = $(this).closest('tr');
        row.find('td:nth-child(n+2):nth-last-child(n+3)').attr('contenteditable', 'true');
        row.find('select.type-select').prop('disabled', false);
        row.find('.btn-success').prop('disabled', false);
        $(this).hide();
        
        row.find('td:first-child, td:nth-last-child(-n+2)').attr('contenteditable', 'false');
    });

    $('.btn-success').click(function () {
        var row = $(this).closest('tr');
        var id = row.find('td:first').text();
        var title = row.find('td:nth-child(2)').text();
        var date = row.find('td:nth-child(3)').text();
        var description = row.find('td:nth-child(4)').text();
        var img_src = row.find('td:nth-child(5)').text();
        var content = row.find('td:nth-child(6)').text();
        var type = row.find('.type-select').val();

        $.ajax({
            url: 'editArticle_process.php',
            type: 'POST',
            data: { id: id, title: title, date: date, description: description, img_src: img_src, content: content, type: type },
            success: function (response) {
                try {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert('Article updated successfully!');
                        row.find('td:nth-child(n+2):nth-last-child(n+3)').attr('contenteditable', 'false');
                        row.find('select.type-select').prop('disabled', true);
                        $('.edit').show();
                    } else {
                        alert('Error updating article: ' + data.error);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    alert('Error processing response!');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error updating article:', textStatus, errorThrown);
                alert('Error updating article!');
            }
        });
    });
});
    </script>
</body>
</html>
