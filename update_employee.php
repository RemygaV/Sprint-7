<?php
require_once "connection-sprint.php";

$employeeId = $_GET['id'];
$sql = "SELECT * FROM `employees` WHERE `id`='$employeeId'";
$sql2 = "SELECT id, Project_Name
FROM projects
GROUP BY Project_Name
ORDER BY Project_Name";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$result = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <h2>Edit this Employee Name:</h2>
    <form action="./update_emp.php" method="post">

        <label>Employee id:</label>
        <input type="text" name="id" value="<?= $result['id'] ?>" readonly>

        <label>Employee name:</label>
        <input type="text" name="name" value="<?= $result['Name'] ?>">

        <label>Project name:</label>
        <select name="Project_id">
            <option value="">None selected</option>
            <option disabled>──────────</option>

            <?php
            foreach ($result2 as $row) {
            ?>
                <option value=<?= $row["id"]; ?>> <?= $row["Project_Name"]; ?></option>
            <?php
            }
            ?>
        </select>

        <button type="submit">Update</button>
    </form>
    <button><a href="./index.php">Back</a>

</body>

</html>