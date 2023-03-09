<!doctype html>
<html lang="en">
<head>
    <title>Patient registration</title>
</head>
<body>
    <h1>🧑‍💊PATIENT REGISTRATION SYSTEM👩‍🔬💉</h1>
    <form method="POST" action="submit.php">
        <table>
            <tr>
                <td><label for="name" class="label">Enter name:</label></td>
                <td><input type="text" name="name" value="" style="width:160px" required></td>
            </tr>
            <tr>
                <td><label for="surname">Enter surname:</label></td>
                <td><input type="text" name="surname" style="width:160px" required></td>
            </tr>
            <tr>
                <td><label for="gender">Gender:</label></td>
                <td>
                    <select name="gender" style="width:160px" required>
                        <option value="-">-</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="birth">Date of birth:</label></td>
                <td><input type="date" name="birth" style="width:160px"></td>
            </tr>
            <tr>
                <td><label for="idNumber">Personal ID number:</label></td>
                <td><input type="idNumber" name="idNumber" style="width:160px" required></td>
            </tr>
            <tr>
                <td><label for="doctor">Doctor speciality:</label></td>
                <td>
                    <select name="doctor" style="width:160px" required>
                        <option value="-">-</option>
                        <option value="Family doctor">Family doctor</option>
                        <option value="Psychiatrist">Psychiatrist</option>
                        <option value="Ophthalmologist">Ophthalmologist</option>
                        <option value="Gastroenterologist">Gastroenterologist</option>
                        <option value="Traumatologist">Traumatologist</option>
                        <option value="Cardiologist">Cardiologist</option>
                        <option value="Pulmonologist">Pulmonologist</option>
                        <option value="Endocrinologist">Endocrinologist</option>
                        <option value="Rheumatologist">Rheumatologist</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="visit">Visit Date and Time:</label></td>
                <td><input type="datetime-local" step="1800" name="visit" style="width:160px" required></td>
            </tr>
            <tr>
                <td><label for="reason">Health complaints:</label></td>
                <td><textarea name="reason" style="width:160px"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div align="right">
                        <input type="submit" id="register_0" value="register">
                    </div>
                </td>
            </tr>
        </table>
    </form>

    <p>To check registration data press <a href="data.php">here</a></p>

    <form method="POST" action="index.php">
        <label for="searchItem">Search by Personal ID Number:</label>
        <input type="text" name="searchItem" id="searchItem" required>
        <input type="submit" name="search" value="Search">
    </form>

    <?php $file = './patient_data.json'?>

    <?php if (isset($_POST['search'])): ?>
        <h2>Search results</h2>
        <?php
        $searchItem = $_POST['searchItem'];
        $content = file_get_contents($file);
        $searchData = json_decode($content, true);

        $results = array_filter($searchData, function($item) use ($searchItem) {
            return strpos($item['id_number'], $searchItem) !== false;
        });

        if (!empty($results)): ?>
            <table class="searchTable">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Gender</th>
                    <th>Date of birth</th>
                    <th>Personal ID number</th>
                    <th>Doctor speciality</th>
                    <th>Visit Date and Time</th>
                    <th>Health complaints</th>
                </tr>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td>
                            <?= $result['#'] ?>
                        </td>
                        <td>
                            <?= $result['name'] ?>
                        </td>
                        <td>
                            <?= $result['surname'] ?>
                        </td>
                        <td>
                            <?= $result['gender'] ?>
                        </td>
                        <td>
                            <?= $result['dob'] ?>
                        </td>
                        <td>
                            <?= $result['id_number'] ?>
                        </td>
                        <td>
                            <?= $result['doctor']?>
                        </td>
                        <td>
                            <?= $result['visit'] ?>
                        </td>
                        <td>
                            <?= $result['health_reason'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    <?php endif; ?>
    <style>
        .searchTable th {
            border: 1px solid black;
            width: 150px;
            text-align: center;
        }
        .searchTable td {
            border: 1px solid black;
            width: 150px;
            text-align: center;
        }
    </style>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window. location.href)
        }
    </script>
</body>
</html>