<?php
require_once "check_session.php";
checkAccessLevel('owner');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants</title>
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
            min-width: 1000px;
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
        }

        .content-table th:nth-last-child(-n+2),
        .content-table td:nth-last-child(-n+2) {
            width: 50px; 
        }

        
        .content-table td:nth-child(7) {
            width: 30%; 
        }

        .edit {
            width: 70px;
            height: 30px;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #198754;
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
<?php
require_once("headerOwner.php");
?>
<body>
    <br>
    <h2>Applications</h2>
    <div class="top-right">
        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Application Letter</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once 'config.php';

            $stmt = $pdo->query('SELECT * FROM applicants');
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['Id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['fname']) . ' ' . htmlspecialchars($row['lname']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['phoneNumber']) . '</td>';
                echo '<td>' . htmlspecialchars($row['birthdate']) . '</td>';
                echo '<td>' . htmlspecialchars($row['gender']) . '</td>';
                echo '<td>' . htmlspecialchars($row['appLetter']) . '</td>';
                echo '<td>';
                echo '<button type="button" class="btn btn-success edit"><i class="bx bx-check"></i></button>';
                echo '</td>';
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

        row.find('td:first-child, td:nth-last-child(-n+2)').attr('contenteditable', 'false');
    });

    $('.btn-success').click(function (event) {
        event.preventDefault();

        var row = $(this).closest('tr');
        var id = row.find('td:first').text();
        var name = row.find('td:nth-child(2)').text().split(' ');
        var fname = name[0];
        var lname = name[1];
        var email = row.find('td:nth-child(3)').text();
        var phonenumber = row.find('td:nth-child(4)').text();
        var birthdate = row.find('td:nth-child(5)').text();
        var gender = row.find('td:nth-child(6)').text();
        var appLetter = row.find('td:nth-child(7)').text();

        $.ajax({
            url: 'applicantProcess.php',
            type: 'POST',
            data: {
                id: id,
                fname: fname,
                lname: lname,
                email: email,
                phonenumber: phonenumber,
                birthdate: birthdate,
                gender: gender,
                appLetter: appLetter
            },
            success: function (response) {
                alert(response);
                if (response.trim() === 'success') {
                    alert('Data updated successfully!');
                    location.reload();
                } else {
                    alert('Error updating data: ' + response);
                }
            },
            error: function () {
                alert('Error updating data!');
            }
        });
    });
});

    </script>

</body>
</html>

<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    $stmt = $pdo->prepare('UPDATE applicants SET fname = :fname, lname = :lname, email = :email, phoneNumber = :phoneNumber, birthdate = :birthdate, gender = :gender, appLetter = :appLetter WHERE Id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':fname', $_POST['fname']);
    $stmt->bindParam(':lname', $_POST['lname']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':phoneNumber', $_POST['phonenumber']);
    $stmt->bindParam(':birthdate', $_POST['birthdate']);
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':appLetter', $_POST['appLetter']);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'Error updating data';
    }
}
?>
