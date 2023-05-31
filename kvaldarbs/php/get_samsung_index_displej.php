<?php 

include('connection.php');

$variable = $conn->prepare("SELECT * FROM preces WHERE preces_brand = 'samsung' AND preces_category = 'displejs' LIMIT 3");

$variable->execute();

$samsung_displej = $variable->get_result();

?>