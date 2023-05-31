<?php 

include('connection.php');

$variable = $conn->prepare("SELECT * FROM preces WHERE preces_brand = 'samsung' AND preces_category = 'plates' LIMIT 3");

$variable->execute();

$samsung_plates = $variable->get_result();

?>