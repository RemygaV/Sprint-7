<?php
require_once "connection-sprint.php";
require "functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, itial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <a class="main_part" href="./index.php">EMPLOYEES</a>
            <a class="main_part" href="./projects.php">PROJECTS</a>
        </nav>
    </header>


    <?php
        // Checking catched exceptions ----
    if (!empty($_GET['err_adding_empl'])) {
    ?>
        <p class="error_txt">You trying to add the same name of employee !!!</p>
    <?php
    }
    if (!empty($_GET['err_noname_empl'])) {
    ?>
        <p class="error_txt">Employee name field is empty !!! </p>
    <?php
    }
    ?>

    <table class="myTable">
        <tr class="topTable">
            <th>Id</th>
            <th>Name</th>
            <th>Project Name</th>
            <th>&#10006</th>
            <th>&#9998</th>
        </tr>


        <?php

        $sql = "SELECT employees.id, employees.name, employees.project_id, projects.Project_Name 
                    FROM employees
                    LEFT JOIN projects ON Projects.id = employees.Project_id
                    ORDER BY employees.id";

        $sql2 = "SELECT Projects.id, Project_Name
                    FROM projects
                    GROUP BY Project_Name
                    ORDER BY Project_Name";

        $result2 = mysqli_query($conn, $sql2);
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            foreach ($result as $row) {
        ?>
                <tr>
                    <td><?= $row["id"]; ?></td>
                    <td><?= $row["name"]; ?></td>
                    <td><?= $row["Project_Name"]; ?></td>
                    <td><a class="a_delete" href="delete_empl.php?id=<?= $row["id"] ?>">Delete</a></td>
                    <td><a class="a_update" href="update_employee.php?id=<?= $row["id"] ?>">Update</a></td>

                </tr>

        <?php

            }
        } else {
            echo "0 results";
        }
        ?>
        <br>
    </table>

    <h2>To add new employee:</h2>
    <form class= "form_1"action="create_empl.php" method="POST">
        <label>Employee name:</label>
        <input type="text" name="employee_name" placeholder="Name">
        <label>Project name:</label>
        <select name="project_id">
            <option value="">None selected</option>
            <option disabled>──────────</option>
            <?php
            foreach ($result2 as $row) {
            ?>
                <option value=<?= $row["id"]; ?>><?= $row["Project_Name"]; ?></option>
            <?php
            }
            ?>
        </select>
        <button class="btn_submit" type="submit">Add</button>
    </form>
    <?php

    mysqli_close($conn);
    ?>

</body>

</html>