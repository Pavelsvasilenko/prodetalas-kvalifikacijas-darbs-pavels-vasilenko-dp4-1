<?php 

include ('php/connection.php');
//šeit es ņemu visu informaciju par preci, kuru lietotajs velas apskatit
if(isset($_GET['preces_id'])) {

    $preces_id = $_GET['preces_id'];

    $variable = $conn->prepare("SELECT * FROM preces WHERE preces_id = ?");
    $variable->bind_param("i", $preces_id); 

    $variable->execute();
        
    $prece = $variable->get_result();

} else {



}
?>

<!DOCTYPE html>
    <html lang="lv">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <?php while($row = $prece->fetch_assoc()){ ?>
        <title><?php echo $row['preces_name']; ?></title>
        
    </head>

    <body>
        <header class="header">
            <nav class="nav">
                <a href="index.php" class="text-logo" id="text-logo">ProDetaļas</a>
                <i class="fas fa-bars" id="hamburger-menu"></i>
                <ul class="ul-links" id="ul-links">
                    <li class="li-links">
                        <a href="index.php" class="a-links">Māja</a>
                    </li>
                    <li class="li-links">
                        <a href="veikals.php" class="a-links">Veikals</a>
                    </li>
                    <li class="li-links">
                        <a href="groza.php" class="a-links">Groza</a>
                    </li>
                    <li class="li-links">
                        <a href="konta.php" class="a-links">Konts</a>
                    </li>
                    <li class="li-links">
                        <a href="contact.php" class="a-links">Kontakti</a>
                    </li>
                    <li class="li-links">
                        <a href="php/logout.php" class="a-links">Iziet</a>
                    </li>
                </ul>
            </nav>
        </header>
        
        <section class="container">
            <div class="content">

                

                <div class="preces-photos">
                    <img src="assets/img/<?php echo $row['preces_image']; ?>" alt="" class="main-photo" id="mainPhoto">
                    <div class="more-imgs">
                        <img src="assets/img/<?php echo $row['preces_image2']; ?>" alt="" class="secondary-photo" width="100px" height="100px">
                        <img src="assets/img/<?php echo $row['preces_image3']; ?>" alt="" class="secondary-photo" width="100px" height="100px">
                        <img src="assets/img/<?php echo $row['preces_image4']; ?>" alt="" class="secondary-photo" width="100px" height="100px">
                    </div>
                </div>
                <div class="device-information">
                    <div class="top">
                        <p class="category"><?php echo $row['preces_brand']; ?> / <?php echo $row['preces_category']; ?></p>
                    </div>
                    <div class="middle">
                        <p><?php echo $row['preces_name']; ?></p>
                        <p><?php echo $row['preces_price']; ?>€</p>
                        <p><?php echo $row['preces_description']; ?></p>
                        <p>Noliktava: <?php echo $row['skaits_noliktava']; ?>gb.</p>

                        <form action="groza.php" method="POST">
                            <input type="hidden" name="preces_id" value="<?php echo $row['preces_id']; ?>">
                            <input type="hidden" name="preces_image" value="<?php echo $row['preces_image']; ?>">
                            <input type="hidden" name="preces_name" value="<?php echo $row['preces_name']; ?>">
                            <input type="hidden" name="preces_price" value="<?php echo $row['preces_price']; ?>">
                                <input type="number" name="preces_daudzums" value="1" class="singleproduct-input-number-daudzums">
                                <button class="single-product-btn btn" type="submit" name="preces_to_groza">Ielikt grozā</button>
                        </form>
                        
                    </div>
                </div>

                <?php } ?>

            </div>
        </section>

        <script src="assets/js/hamburgermenu.js"></script>
        <script src="assets/js/singleproductimgchange.js"></script>
    </body>
</html>