<?php
require_once "connection-sprint.php";

function hasProjectEmployees($conn, $id): bool
{
    $selectQuery = "SELECT `id` FROM `Employees` WHERE `Project_id` = '$id'";
    $query = mysqli_query($conn, $selectQuery);
    $result = $query->fetch_array();

    return !empty($result);
}

function deleteProject($conn, $projectId): void
{
    mysqli_query($conn, "UPDATE `Employees` SET `Project_id` = NULL WHERE `Project_id` = '$projectId'");
    mysqli_query($conn, "DELETE FROM `Projects` WHERE `id` = '$projectId'");
}

function isEmployeeNameProvided(): bool
{
    return !empty($_POST['employee_name']);
}

function isProjectIdProvided(): bool
{
    return !empty($_POST['project_id']);
}