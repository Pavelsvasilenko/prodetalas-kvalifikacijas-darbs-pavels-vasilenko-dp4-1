<?php
session_start();

if(!empty($_SESSION['groza'])) {

} else {
    header('location: groza.php');
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
            <div class="content">
                <form action="php/pasutijumanoformesana.php" method="POST">
                    <div class="checkout-header">
                        <p>Pasūtījuma noformēšana</p>
                    </div>
                    <div class="checkout-fields">
                        <input type="text" placeholder="Vārds" required class="checkout-input-field" name="name" id="name">
                        <input type="email" placeholder="E-pasts" required class="checkout-input-field" name="email" id="email">
                        <input type="tel" placeholder="Telefona numurs" required class="checkout-input-field" name="phone" id="phone">
                        <input type="text" placeholder="Pilseta" required class="checkout-input-field" name="city" id="city">
                        <input type="text" placeholder="Adrese" required class="checkout-input-field" name="address" id="address"> 
                        <p class="noformesana-kopeja-summa">Kopeja summa: <?php echo $_SESSION['kopejasumma'] ?>€</p>
                        <input type="submit" value="Noformēt" class="checkout-btn btn" name="atsutit_pasutijumu">
                    </div>
                </form>
            </div>  
        </section>  
        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>