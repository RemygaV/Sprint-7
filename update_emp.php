<?php
require_once "connection-sprint.php";

$toEditEmployeeId = $_POST['id'];
$toEditEmployeeName = $_POST['name'];
$toEditProjectId = $_POST['Project_id'];

print_r($toEditEmployeeId);
print_r($toEditEmployeeName);
print_r($toEditProjectId);
mysqli_query($conn, "UPDATE employees SET Name='$toEditEmployeeName', Project_id='$toEditProjectId' WHERE id='$toEditEmployeeId'");

header("location: ./index.php");
?>