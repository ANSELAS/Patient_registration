<!doctype html>
<html lang="en">
<head>
    <title>Registration data</title>
</head>
<body>
    <?php $file = file_get_contents('patient_data.json') ?>
    <?php $list = json_decode($file, true)?>

    <h2>REGISTRATION DATA</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Gender</th>
            <th>Date of birth</th>
            <th>Personal ID number</th>
            <th>Doctors speciality</th>
            <th>Visit Date and Time</th>
            <th>Health complaints</th>
            <th>Action</th>
        </tr>
        <?php foreach ($list as $key => $data): ?>
            <tr>
                <td>
                    <?php echo $data['id_row'] ?>
                </td>
                <td>
                    <?php echo $data['name'] ?>
                </td>
                <td>
                    <?php echo $data['surname'] ?>
                </td>
                <td>
                    <?php echo $data['gender'] ?>
                </td>
                <td>
                    <?php echo $data['dob'] ?>
                </td>
                <td>
                    <?php echo $data['id_number'] ?>
                </td>
                <td>
                    <?php echo $data['doctor'] ?>
                </td>
                <td>
                    <?php echo $data['visit'] ?>
                </td>
                <td>
                    <?php echo $data['health_reason'] ?>
                </td>
                <td>
                    <form class="actionButton" action="edit.php" method="POST">
                        <input class="blue" type="submit" value="Edit">
                        <input class="blue" type="hidden" name="edit_Id" value="<?= $key?>">
                    </form>
                    <form class="actionButton" action="delete.php" method="POST">
                        <input class="red" type="submit" value="Cancel">
                        <input class="red" type="hidden" name="id" value="<?= $key?>">
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <form method="post" action="download.php">
        <button class="download" type="submit" name="id" value="Download">Download CSV</button>
    </form>
    <br>
    <button><a href="http://localhost:8080/index.php">Go back to main page</a></button>

    <style>
        td {
            border: 1px solid black;
            width: 180px;
            text-align: center;
        }
        a {
            text-decoration: none;
            font-size: 1.5rem;
        }
        button {
            height: 40px;
            border-radius: 30px;
            background-color: #08bf3c;
        }
        button:hover {
            background-color: #027cbd;;
        }
        th {
            border: 1px solid black;
            width: 150px;
            text-align: center;
        }
        a {
            text-decoration: none;
            font-size: 1.5rem;
        }
        .red, .blue {
            width: 70px;
            margin: 5px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }
        .red {
            background-color: #eb5934;
        }
        .blue {
            background-color: #3492eb;
        }
        .red:hover {
            background-color: #e8cf15;
        }
        .blue:hover {
            background-color: #0ac9ba;
        }
        .actionButton {
            display: inline;
        }
        .download {
            width: 170px;
            height: 40px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 30px;
            background-color: #e89e15;
            cursor: pointer;
        }
    </style>
</body>
</html>