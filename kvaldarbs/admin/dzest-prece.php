<?php 
    session_start();
    include('../php/connection.php');

    if(isset($_GET['preces_id'])) {
        $preces_id = $_GET['preces_id']; 
        $variable = $conn->prepare("DELETE FROM preces WHERE preces_id = ?");
        $variable->bind_param('i', $preces_id);
        if($variable->execute()) {
            header('location: index.php');
        }

        
    }

?>