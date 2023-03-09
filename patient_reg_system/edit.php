<?php
$index = $_POST['edit_Id'];
$file = 'patient_data.json';
$jsonFile = file_get_contents($file);
$patientArray = json_decode($jsonFile, true);
$newData = json_encode($patientArray, JSON_PRETTY_PRINT);
file_put_contents($file, $newData);

?>

<!doctype html>
<html lang="en">
<head>
    <title>EDIT PATIENT DATA</title>
</head>
<body>

    <h2>EDIT PATIENT DATA</h2>
    <form action="edit_submit.php" method="post">
        <input type="hidden" name="edit_Id" value="<?= $index ?>">
        <label for="new_name">Update name</label>
        <input type="text" name="new_name" value="<?= $patientArray[$index]['name'] ?>">
        <label for="new_surname">Update surname</label>
        <input type="text" name="new_surname" value="<?= $patientArray[$index]['surname'] ?>">
        <label for="new_gender">Update gender</label>
        <select name="new_gender">
            <option value="<?= $patientArray[$index]['gender'] ?>"><?= $patientArray[$index]['gender'] ?></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <label for="new_dob">Update date of birth</label>
        <input type="date" name="new_dob" value="<?= $patientArray[$index]['dob'] ?>">
        <label for="new_id_number">Update Personal ID nr</label>
        <input type="text" name="new_id_number" value="<?= $patientArray[$index]['id_number'] ?>">
        <label for="new_doctor">Update Doctor's speciality</label>
        <select name="new_doctor" style="width:160px" >
            <option value="<?= $patientArray[$index]['doctor'] ?>"><?= $patientArray[$index]['doctor'] ?></option>
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
        <label for="new_visit">Update Visit Date or Time</label>
        <input type="datetime-local" name="new_visit" value="<?= $patientArray[$index]['visit'] ?>">
        <label for="new_reason">Update complaints</label>
        <textarea name="new_reason"><?= $patientArray[$index]['health_reason'] ?></textarea>
        <input type="submit" class="edit">
    </form>
    <button><a href="data.php">Cancel</a></button>
    <style>
        label, input, select, textarea {
            display: block;
            margin: 5px 0;
            width: 200px;
        }
        label, .edit, a {
            font-weight: bold;
            color: #000000;
        }
        .edit {
            background-color: #2f9a2f;
            cursor: pointer;
        }
        button {
            width: 100px;
            background-color: #e89e15;
        }
        .edit, button {
            width: 100px;
            font-size: 1rem;
            border-radius: 10px;
        }
        a {
            text-decoration: none;
        }
        .edit:hover {
            background-color: #45d703;
        }
        button:hover {
            background-color: #ff0404;
        }
    </style>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window. location.href)
        }
    </script>
</body>
</html>