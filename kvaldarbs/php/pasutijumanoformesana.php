<?php 
session_start();
 
include('connection.php');

if(!isset($_SESSION['logged_in'])) {
    header('location: ../login.php?message=Nepiciešams ieiet kontā vai piereģistrēties');
} else {

    if(isset($_POST['atsutit_pasutijumu'])) {
     
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['kopejasumma'];
        $order_status = "pagaidam nav apmaksats";
        $user_id = $_SESSION['user_id']; 
        $order_date = date('Y-m-d H:i:s'); 
    
        $variable = $conn->prepare("INSERT INTO pasutijumi (order_price, order_status, user_id, user_phone, user_city, user_address, order_date) 
                        VALUES (?, ?, ?, ?, ?, ?, ?); ");
    
        $variable->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);
    
        $variable->execute();
    
        $order_id = $variable->insert_id;
         
        foreach($_SESSION['groza'] as $key => $value) {
            
            $prece = $_SESSION['groza'][$key];
            $prece_id = $prece['preces_id'];
            $prece_name = $prece['preces_name'];
            $prece_image = $prece['preces_image'];
            $prece_price = $prece['preces_price'];
            $prece_daudzums = $prece['preces_daudzums'];
    
            $variable2 = $conn->prepare("INSERT INTO pasutitas_preces (order_id, preces_id, preces_name, preces_image, preces_price, preces_daudzums, user_id, order_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?); ");
    
            $variable2->bind_param('iissiiis', $order_id, $prece_id, $prece_name, $prece_image, $prece_price, $prece_daudzums, $user_id, $order_date);
    
            $variable2->execute();
    
        }
    
        header('location: ../apmaksajums.php?order_status=veikts pasutijums');
    
    }

}



?>