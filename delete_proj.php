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
    
</body>
</html>
<?php
require_once "connection-sprint.php";
require "functions.php";

$projectId = $_GET["id"];

if (hasProjectEmployees($conn, $projectId)) {
    if (isset($_POST['delete'])) {
        deleteProject($conn, $projectId);
        header("location: ./projects.php");
    } elseif (isset($_POST['cancel'])) {
        header("location: ./projects.php");
    }

?>
<p class="error_txt">Are you sure you want to delete this project, employees are attached to this project? </p>
    <form action="delete_proj.php?id=<?= $projectId ?>" method="post">
        <button class= "btn_delete" type="submit" name="delete">Delete</button>
    </form>
    <form action="delete_proj.php?id=<?= $projectId ?>" method="post">
        <button class= "btn_cancel" type="submit" name="cancel">Cancel</button>
    </form>
<?php

} else if (!hasProjectEmployees($conn, $projectId)) {
    header("location: ./projects.php");
    deleteProject($conn, $projectId);
}


