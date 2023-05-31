<?php 
    session_start();
    include('../php/connection.php');

    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id']; 
        $variable = $conn->prepare("DELETE FROM pasutijumi WHERE order_id = ?");
        $variable->bind_param('i', $order_id);
        if($variable->execute()) {
            header('location: pasutijumi.php');
        }

        
    }

?>