<?php 

include('connection.php');

$variable = $conn->prepare("SELECT * FROM preces WHERE preces_brand = 'xiaomi' AND preces_category = 'displejs' LIMIT 3");

$variable->execute();

$xiaomi_displej = $variable->get_result();

?>