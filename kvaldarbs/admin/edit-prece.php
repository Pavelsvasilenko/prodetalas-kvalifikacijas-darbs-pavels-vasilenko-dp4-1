<?php 
    session_start();
    include('../php/connection.php');

    if(isset($_GET['preces_id'])) {

        $preces_id = $_GET['preces_id'];
        $variable = $conn->prepare("SELECT * FROM preces WHERE preces_id = ?");
        $variable->bind_param("i", $preces_id); 
        $variable->execute();
        $preces = $modifyprece = $variable->get_result();
    
    } else if(isset($_POST['preces_id'])){
        
        $preces_id = $_POST['preces_id'];
        $precesName = $_POST['name'];
        $brand = $_POST['brand'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $color = $_POST['color'];


        $variable = $conn->prepare("UPDATE preces SET preces_name = ?, preces_brand = ?, preces_description  = ?, preces_price = ?, preces_category = ?, preces_color = ? WHERE preces_id = ?");
        $variable->bind_param('sssissi', $precesName, $brand, $description, $price, $category, $color, $preces_id);   
        
        $preces = $variable->execute();
        header('location: index.php');
    
    } else {

    }

?>

<!DOCTYPE html>
    <html lang="lv">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <title>preces rediģēšana</title>
    </head>

    <body>
        <header class="header">
            <nav class="nav">
                <a href="index.php" class="text-logo" id="text-logo">ProDetaļas admin</a>
                <i class="fas fa-bars" id="hamburger-menu"></i>
                <ul class="ul-links" id="ul-links">
                    <li class="li-links">
                        <a href="index.php" class="a-links activated">Visas preces</a>
                    </li>
                    <li class="li-links">
                        <a href="pasutijumi.php" class="a-links">Visi pasūtījumi</a>
                    </li>
                    <li class="li-links">
                        <a href="pievienot-prece.php" class="a-links">Pievienot preci</a>
                    </li>
                    <li class="li-links">
                        <a href="admin-logout.php" class="a-links">Iziet</a>
                    </li>
                </ul>
            </nav>
        </header>


        <section class="container">
            <div class="content">
            <?php foreach($preces as $prece) {?>
                
                <form action="edit-prece.php" method="POST">
                <input type="hidden" name="preces_id" value="<?php echo $prece['preces_id']; ?>">
                    <input type="text" value="<?php echo $prece['preces_name']; ?>" class="modify-input" name="name">
                    <input type="text" value="<?php echo $prece['preces_brand']; ?>" class="modify-input" name="brand">
                    <input type="text" value="<?php echo $prece['preces_description']; ?>" class="modify-input" name="description">
                    <input type="text" value="<?php echo $prece['preces_price']; ?>€" class="modify-input" name="price">
                    <input type="text" value="<?php echo $prece['preces_category']; ?>" class="modify-input" name="category">
                    <input type="text" value="<?php echo $prece['preces_color']; ?>" class="modify-input" name="color">
                    <input type="submit" class="modify-btn" name="modifyBtn" value="saglabāt">
                </form>
            <?php } ?>
            </div>
        </section>
        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>