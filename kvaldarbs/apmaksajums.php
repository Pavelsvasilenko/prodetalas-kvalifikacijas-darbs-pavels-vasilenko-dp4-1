<?php
session_start();
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
        <title>Pasūtījuma noformēšana</title>
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
            <div class="content apmaksa-content">
                <div class="checkout-header">
                    <p>Apmaksa</p>
                </div>
                <div class="checkout-fields">
                    <p class="apmaksas-status"><?php if(isset($_GET['order_status'])){echo $_GET['order_status'];} ?></p>
                    <p class="noformesana-kopeja-summa apmaksas-summa">Kopeja summa: <?php if(isset($_SESSION['kopeja_summa'])){echo $_SESSION['kopejasumma'];} ?>€</p>    
                    <input type="submit" value="Veikt apmaksajumu" class="checkout-btn btn" name="atsutit_pasutijumu">
                </div>
            </div>  
        </section>  

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>