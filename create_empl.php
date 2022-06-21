<?php
require_once "connection-sprint.php";
require "functions.php";

if (isset($_POST['employee_name'])) {
    $employeeName = $_POST['employee_name'];
        if ($employeeName=="") header("location: ./index.php?err_noname_empl=not_inserted_employee");
} else {
   $employeeName  = null;
}

if (isset($_POST['project_id'])) {
    $projectId = $_POST['project_id'];
} else {
   $projectId = null;
}

if (isEmployeeNameProvided()) {
    $employeeExistsQuery = "SELECT `id` FROM `employees` WHERE `name`='$employeeName'";
    $result = mysqli_query($conn, $employeeExistsQuery);
    if (empty($result->fetch_row())) {
        if (isProjectIdProvided()) {
            $addNewEmployeeToProjectQuery = "INSERT INTO `employees` (`name`, `project_id`) VALUES ('$employeeName', '$projectId')";
            mysqli_query($conn, $addNewEmployeeToProjectQuery);
            header("location: ./index.php");
        } else {
            $addNewEmployeeToProjectQuery = "INSERT INTO `employees` (`name`) VALUES ('$employeeName')";
            mysqli_query($conn, $addNewEmployeeToProjectQuery);
            header("location: ./index.php");
        }
    } else {
        header("location: ./index.php?err_adding_empl=employee_exists");
    }
}
