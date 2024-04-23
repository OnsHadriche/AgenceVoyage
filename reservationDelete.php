<?php

include './config.php';

$id = $_GET['id'];
echo $id;

$deletesql = "DELETE FROM roombook WHERE id = $id";

$result = mysqli_query($conn, $deletesql);

header("Location:profile.php");

?>