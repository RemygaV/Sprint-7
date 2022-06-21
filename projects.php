<?php
require_once "connection-sprint.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
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

    $sql2 = "SELECT projects.id, Project_Name, group_concat(employees.Name SEPARATOR ', ') as Group_employees 
    FROM projects
    LEFT JOIN employees ON Projects.id = employees.Project_id
    GROUP BY Project_Name
    ORDER BY projects.id";

    $result2 = mysqli_query($conn, $sql2);

    // Checking catched exceptions ----
    if (!empty($_GET['err'])) {
    ?>
        <p class="error_txt">This project is already created !!! </p>
    <?php
    } else if (!empty($_GET['err2'])) {
    ?>
        <p class="error_txt">This project name field can't be empty !!! </p>
    <?php
    }  
?>

    <table class="myTable">
        <tr class="topTable">
            <th>Id</th>
            <th>Project name</th>
            <th>Employees</th>
            <th>&#10006</th>
            <th>&#9998</th>
        </tr>

        <?php

        if (mysqli_num_rows($result2) > 0) {

            foreach ($result2 as $row) {
        ?>
                <tr>
                    <td><?= $row["id"]; ?></td>
                    <td><?= $row["Project_Name"]; ?></td>
                    <td><?= $row["Group_employees"]; ?></td>
                    <td><a class="a_delete" href="delete_proj.php?id=<?= $row["id"] ?>">Delete</a></td>
                    <td><a class="a_update" href="update_project.php?id=<?= $row["id"] ?>">Update</a></td>
                </tr>
        <?php

            }
        } else {
            echo "0 results";
        }
        ?>
    </table>


    <h2>Please add a new project:</h2>
    <form action="?action=create_project" method="POST">
        <label>Project name:</label>
        <input type="text" name="createProjectName" placeholder="Project name">
        <button class ="btn_submit" type="submit">Add</button>
    </form>
    <?php

    if (isset($_GET['action']) && $_GET['action'] == "create_project") {
        $newProject = $_POST['createProjectName'] ?? null;

        if (!empty($newProject)) {

            $sql_proj = "INSERT INTO `projects` (`id`, `Project_Name`) VALUES (NULL, '$newProject')";

            try {
                mysqli_query($conn, $sql_proj);
                header("location: ./projects.php");
            } catch (Exception $e) {
                header('Location: projects.php?err=duplicate_project');
            }
        } else {
            ?>
            <p class="error_txt">Project name is not added !!! </p>
            <?php
        }
    }

    mysqli_close($conn);
    ?>

</body>

</html>