
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
    <title>Edit Moderators</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
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
        font-size: 1.2em;
        width: 90%;
        max-width: 900px;
        border-radius: 10px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
        overflow-x: auto;
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

    .content-table th,
    .content-table td {
        padding: 15px;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
        border-bottom: 2px solid #ffd500;
    }

    .edit {
        width: 90px;
        height: 40px;
        padding: 5px 10px;
        font-size: 16px;
        background-color: #F6E709;
        color: black;
        border: 1px solid transparent;
        border-radius: 8px;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    .edit:hover {
        background-color: #D0C306;
    }

    .btn-success {
        margin-left: -20px;
        margin-right: -15px;
    }
</style>

<body>
    <h1>Moderators</h1>
    <div class="top-right">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th></th>
                    <th></th>
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
                    echo '<td><button type="button" class="btn btn-success"><i class="bx bx-check"></i></button></td>';
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
            
            $('.content-table tbody tr td').attr('contenteditable', 'false');
            
            var row = $(this).closest('tr');
            row.find('td:nth-child(n+2):nth-last-child(n+3)').attr('contenteditable', 'true');
            row.find('.btn-success').prop('disabled', false);
            $(this).hide(); 
            
            row.find('td:first-child').attr('contenteditable', 'false');
        });

        $('.btn-success').click(function () {
            var row = $(this).closest('tr');
            var id = row.find('td:first').text();
            var name = row.find('td:nth-child(2)').text();
            var surname = row.find('td:nth-child(3)').text();

            $.ajax({
                url: 'editModerators_process.php', 
                type: 'POST',
                data: { id: id, name: name, surname: surname},
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert('Date updated successfully!');
                    } else {
                        alert('Error updating date: ' + data.error);
                    }
                },
                error: function () {
                    alert('Error updating date!');
                }
            });
        });
    });
</script>

</body>
</html>
