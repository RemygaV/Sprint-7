<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update project</title>
</head>

<body>

    <?php
    require_once "connection-sprint.php";

    $project_id_edit = $_GET['id'];
    $sql = "SELECT * FROM `projects` WHERE `id`='$project_id_edit'";

    $project = mysqli_query($conn, $sql);
    $project = mysqli_fetch_assoc($project);

    ?>
    <h2>Edit this project:</h2>
    <form action="" method="post">
        <label>Project id:</label>
        <input type="text" name="ProjectUpdateId" value="<?= $project['id'] ?>" readonly>
        <label>Project name:</label>
        <input type="text" name="ProjectUpdateName" value="<?= $project['Project_Name'] ?>">

        <button class ="btn_submit" type="submit">Update</button>
    </form>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $projectId = $_POST['ProjectUpdateId'];
        $projectName = $_POST['ProjectUpdateName'];

        print($projectId);
        print($projectName);

        if (isset($_POST['ProjectUpdateId']) and isset($_POST['ProjectUpdateName']) and (!$_POST['ProjectUpdateName'] == "")) {
            $sqlUpdateProject = "UPDATE projects SET Project_Name='$projectName' WHERE id='$projectId'";
            try {
                mysqli_query($conn, $sqlUpdateProject);
                header("location: ./projects.php");
            } catch (Exception $e) {
                header("Location: projects.php?err=duplicate_project");
            }
        } else {
            header("location: ./projects.php?err2=empty_project");
        }
    }

    ?>
    <button class = "btn_back"><a class="txt" href="./projects.php">Back</a></button>

</body>

</html>