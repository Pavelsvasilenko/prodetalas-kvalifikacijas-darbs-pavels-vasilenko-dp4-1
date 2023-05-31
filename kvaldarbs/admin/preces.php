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
        <title>Mājaslapa</title>
    </head>

    <body>
        <header class="header">
            <nav class="nav">
                <a href="index.php" class="text-logo" id="text-logo">ProDetaļas</a>
                <i class="fas fa-bars" id="hamburger-menu"></i>
                <ul class="ul-links" id="ul-links">
                    <li class="li-links">
                        <a href="index.php" class="a-links activated">Māja</a>
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

        <section class="under-nav">
            <p class="under-nav-text">Mēs piedāvājam saviem klientiem oriģinalos rezerves detaļas telefonu remontam</p>
        </section>

        <section class="container">
            <div class="content">
                <img src="assets/img/apple-logo.png" alt="" width="200px" height="200px" class="logo-brand-img">
                <img src="assets/img/samsung-logo.png" alt="" width="200px" height="200px" class="logo-brand-img">
                <img src="assets/img/huawei-logo.png" alt="" width="200px" height="200px" class="logo-brand-img">
                <img src="assets/img/xiaomi-logo.png" alt="" width="200px" height="200px" class="logo-brand-img">
                <img src="assets/img/sony-logo.png" alt="" width="200px" height="200px" class="logo-brand-img">
            </div>
        </section>

        <div class="outer-text">
            <p>Sasmsung displeji</p>
        </div>

        <section class="container">
            <div class="content">   
                <?php include('php/get_samsung_index_displej.php'); ?>
                <?php while($row = $samsung_displej->fetch_assoc()){ ?>
                <div class="piedavajums">
                    <img src="assets/img/<?php echo $row['preces_image']; ?>" alt="" width="300px" height="300px" class="piedavajums-img">
                    <p class="piedavajums-info"><?php echo $row['preces_name']; ?></p>
                    <p class="piedavajums-info"><?php echo $row['preces_price']; ?>€</p>
                    <a href="<?php echo "singleproduct.php?preces_id=". $row['preces_id']; ?>" class="btn" id="index-btn" name="toSingleProduct">Skatīt</a>
                </div>
                <?php } ?>
            </div>
        </section>

        <div class="outer-text">
            <p>Xiaomi displeji</p>
        </div>
        
        <section class="container">
            <div class="content">   
                <?php include('php/get_xiaomi_index_displej.php'); ?>
                <?php while($row = $xiaomi_displej->fetch_assoc()){ ?>
                <div class="piedavajums">
                    <img src="assets/img/<?php echo $row['preces_image']; ?>" alt="" width="300px" height="300px" class="piedavajums-img">
                    <p class="piedavajums-info"><?php echo $row['preces_name']; ?></p>
                    <p class="piedavajums-info"><?php echo $row['preces_price']; ?>€</p>
                    <a href="<?php echo "singleproduct.php?preces_id=". $row['preces_id']; ?>" class="btn" id="index-btn" name="toSingleProduct">Skatīt</a>
                </div>
                <?php } ?>
            </div>
        </section>

        <div class="outer-text">
            <p>Samsung plates ar lādēšanas konektoru</p>
        </div>

        <section class="container">
        <div class="content">   
                <?php include('php/get_samsung_index_plates.php'); ?>
                <?php while($row = $samsung_plates->fetch_assoc()){ ?>
                <div class="piedavajums">
                    <img src="assets/img/<?php echo $row['preces_image']; ?>" alt="" width="300px" height="300px" class="piedavajums-img">
                    <p class="piedavajums-info"><?php echo $row['preces_name']; ?></p>
                    <p class="piedavajums-info"><?php echo $row['preces_price']; ?>€</p>
                    <a href="<?php echo "singleproduct.php?preces_id=". $row['preces_id']; ?>" class="btn" id="index-btn" name="toSingleProduct">Skatīt</a>
                </div>
                <?php } ?>
            </div>
        </section>

        <div class="outer-text">
            <p>Pāvels Vasiļenko DP4-1</p>
        </div>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>