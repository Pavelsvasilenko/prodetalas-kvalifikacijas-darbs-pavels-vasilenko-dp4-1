<?php 

include('php/connection.php');
//Šeit es ņemu visus parametrus par lietotaja pasutijumiem
if(isset($_POST['pasutijumaDetalas'])) {
//gadijuma, ja viņs velas apskatit ko viņš pasutijis
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
//un ja viņš velas apmaksat pasutijumu 
    $variable = $conn->prepare("SELECT * FROM pasutitas_preces WHERE order_id = ?");

    $variable->bind_param('i', $order_id);
    
    $variable->execute();

    $pasutija_detalas = $variable->get_result();

} else {
    header('location: konta.php');
    exit;
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
        <title>Pasūtījuma detaļas</title>
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
                        <a href="konta.php" class="a-links activated">Konts</a>
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
        
        <div class="outer-text konta-outer-text">
            <p>Pasūtījuma detaļas</p>
        </div>

        <section class="container" id="klietna-pasutijumi">
            <div class="content">
                <table>
                    <tr>
                        <th class="groza-header">Preces nosaukums</th>
                        <th class="groza-header">Preces cena</th>
                        <th class="groza-header">Preces daudzums</th>
                    </tr>
                    <?php while($row= $pasutija_detalas->fetch_assoc()){ ?>
                    <tr>
                        <td>
                            <div class="groza-products">
                                <img src="assets/img/<?php echo $row['preces_image']; ?>" alt="" width="100px" height="100px">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $row['preces_name']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="groza-products">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $row['preces_price']; ?>€</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="groza-products">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $row['preces_daudzums']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php 
                        if($order_status = "pagaidam nav apmaksats") { ?>
                            <form action="" class="apmaksat-form">
                            <input type="hidden" name="total_cena" value="<?php echo $total_cena; ?>">
                            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
                            <input type="submit" name="apmaksat_pasutijumu_btn" value="Apmaksat" class="btn">
                            </form>
                        <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>    
            </div> 
        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>