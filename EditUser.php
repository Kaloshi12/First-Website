
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        h2 {
            text-align: center;
            margin-top: 40px;
        }
        
        .content-table {
            align-items: center;
            border-collapse: collapse;
            margin: 40px auto;
            margin-top: 35px;
            font-size: 0.9em;
            min-width: 900px;
            border-radius: 5px 5px 0 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .content-table thead tr {
            background-color: #198754;
            color: white;
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
            width: calc(100% / 7);
        }

        .content-table th:nth-last-child(-n+2),
        .content-table td:nth-last-child(-n+2) {
            width: auto;
        }

        .edit,
        .delete {
            width: 80px;
            height: 30px;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            margin: 0 auto;
        }

        .edit {
            background-color: #F6E709;
            color: black;
            border: 1px solid transparent;
        }

        .edit:hover {
            background-color: #D0C306;
        }

        .delete {
            background-color: #DC3545;
            color: white;
            border: 1px solid transparent;
        }

        .delete:hover {
            background-color: #C82333;
        }
    </style>
</head>
<?php
require_once("headerOwner.php");
?>
<body>
    <br>
    <h2>Users</h2>
    <div class="top-right">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Access Level</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once 'config.php';

            $stmt = $pdo->query('SELECT * FROM users');
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $pdo->query('SELECT DISTINCT access_level FROM users');
            $types = $stmt->fetchAll(PDO::FETCH_COLUMN);

            foreach ($users as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['surname'] . '</td>';
                echo '<td><select class="type-select">';
                foreach ($types as $type) {
                    $type = trim($type);
                    $selected = in_array($type, explode(',', $row['access_level'])) ? 'selected="selected"' : '';
                    echo '<option value="' . $type . '" ' . $selected . '>' . $type . '</option>';
                }
                echo '</select></td>';
                echo '<td><button type="button" class="btn btn-success"><i class="bx bx-check"></i></button></td>';
                echo '<td><button class="edit" data-id="' . $row['id'] . '">Edit</button></td>';
                echo '<td><button class="btn btn-danger" data-id="' . $row['id'] . '"><i class="bx bxs-user-x"></i></button></td>';
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
            
            $('.content-table tbody tr td').attr('contenteditable', 'false');
            
            var row = $(this).closest('tr');
            row.find('td:nth-child(n+2):nth-last-child(n+3)').attr('contenteditable', 'true');
            row.find('.btn-success').prop('disabled', false);
            $(this).hide(); 
            
            row.find('td:first-child, td:nth-last-child(-n+3)').attr('contenteditable', 'false');
        });

        $('.btn-success').click(function () {
            var row = $(this).closest('tr');
            var id = row.find('td:first').text();
            var name = row.find('td:nth-child(2)').text();
            var surname = row.find('td:nth-child(3)').text();
            var access_level = row.find('select.type-select').val(); 
            $.ajax({
                url: 'editUser_process.php', 
                type: 'POST',
                data: { id: id, name: name, surname: surname, access_level: access_level },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert('Data updated successfully!');
                        $('.btn-success').prop('disabled', true);
                        $('.edit').show();
                    } else {
                        alert('Error updating data: ' + data.error);
                    }
                },
                error: function () {
                    alert('Error updating data!');
                }
            });
        });

        $('.btn-danger').click(function () {
            if (confirm("Are you sure you want to delete this user?")) {
                var row = $(this).closest('tr');
                var id = row.find('td:first').text();

                $.ajax({
                    url: 'removeUser1_process.php', 
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            alert('User deleted successfully!');
                            row.remove();
                        } else {
                            alert('Error deleting user: ' + data.error);
                        }
                    },
                    error: function () {
                        alert('Error deleting user!');
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
