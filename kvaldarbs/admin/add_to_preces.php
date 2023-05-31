<?php 

include('../php/connection.php');

if(isset($_POST['pievienotBtn'])) {

    $preces_nosaukums = $_POST['nosaukums'];
    $preces_brands = $_POST['brands'];
    $preces_kategorija = $_POST['kategorija'];
    $preces_description = $_POST['description'];
    $preces_price = $_POST['price'];
    $preces_color = $_POST['color'];
    $preces_daudzums = $_POST['daudzums'];

    $bilde1 = $_FILES['imageFirst']['tmp_name'];
    $bilde2 = $_FILES['imageSecond']['tmp_name'];
    $bilde3 = $_FILES['imageThird']['tmp_name'];
    $bilde4 = $_FILES['imageFourth']['tmp_name'];

    $bilde_nosaukums1 = $preces_nosaukums."1.jpg";
    $bilde_nosaukums2 = $preces_nosaukums."2.jpg";
    $bilde_nosaukums3 = $preces_nosaukums."3.jpg";
    $bilde_nosaukums4 = $preces_nosaukums."4.jpg";

    move_uploaded_file($bilde1, "../assets/img/".$bilde_nosaukums1);
    move_uploaded_file($bilde2, "../assets/img/".$bilde_nosaukums2);
    move_uploaded_file($bilde3, "../assets/img/".$bilde_nosaukums3);
    move_uploaded_file($bilde4, "../assets/img/".$bilde_nosaukums4);

    $variable = $conn->prepare("INSERT INTO preces (preces_name, preces_brand, preces_category, preces_description, preces_image, preces_image2, preces_image3, preces_image4, preces_price, preces_color, skaits_noliktava)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

    $variable->bind_param('ssssssssdsi', $preces_nosaukums, $preces_brands, $preces_kategorija, $preces_description, $bilde_nosaukums1, $bilde_nosaukums2, $bilde_nosaukums3, $bilde_nosaukums4, $preces_price, $preces_color, $preces_daudzums);

    if($variable->execute()) {
        header('location: pievienot-prece.php');
    }
}


?>