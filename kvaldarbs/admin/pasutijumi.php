<?php 
    include('../php/connection.php');

    $variable = $conn->prepare("SELECT * FROM pasutijumi");
    $variable->execute(); 
    $pasutijumi = $variable->get_result();

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
        <title>Pasūtījumi</title>
    </head>

    <body>
        <header class="header">
            <nav class="nav">
                <a href="index.php" class="text-logo" id="text-logo">ProDetaļas admin</a>
                <i class="fas fa-bars" id="hamburger-menu"></i>
                <ul class="ul-links" id="ul-links">
                    <li class="li-links">
                        <a href="index.php" class="a-links">Visas preces</a>
                    </li>
                    <li class="li-links">
                        <a href="pasutijumi.php" class="a-links activated">Visi pasūtījumi</a>
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
                <table>
                    <tr>
                        <th class="groza-header">pasūtījuma ID</th>
                        <th class="groza-header">pasūtījuma cena</th>
                        <th class="groza-header">pasūtījuma status</th>
                        <th class="groza-header">lietotāja ID</th>
                        <th class="groza-header">lietotāja telefons</th>
                        <th class="groza-header">lietotāja pilsēta</th>
                        <th class="groza-header">lietotāja adrese</th>
                        <th class="groza-header">pasūtījuma datums</th>
                        <th class="groza-header">dzēst</th>
                    </tr>
                    <?php foreach($pasutijumi as $pasutijums) { ?>
                    <tr>
                        <th><?php echo $pasutijums['order_id']; ?></th>
                        <th><?php echo $pasutijums['order_price']; ?></th>
                        <th><?php echo $pasutijums['order_status']; ?></th>
                        <th><?php echo $pasutijums['user_id']; ?></th>
                        <th><?php echo $pasutijums['user_phone']; ?></th>
                        <th><?php echo $pasutijums['user_city']; ?></th>
                        <th><?php echo $pasutijums['user_address']; ?></th>
                        <th><?php echo $pasutijums['order_date']; ?></th>
                        <th><a href="dzest-pasutijumu.php?order_id=<?php echo $pasutijums['order_id']; ?>" class="btn-delete">dzēst</a></th>

                    </tr>
                    <?php } ?>
                </table>
            </div>
        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>