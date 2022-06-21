<?php         
require_once "connection-sprint.php";
$item_to_delete = $_GET["id"];

$sql_delete ="DELETE FROM sprint.employees WHERE employees.id = $item_to_delete";
mysqli_query($conn, $sql_delete);

header("location: ./index.php");
?>