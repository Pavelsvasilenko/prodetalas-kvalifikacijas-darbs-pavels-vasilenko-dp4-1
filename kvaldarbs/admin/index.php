<?php 
    include('../php/connection.php');

    $variable = $conn->prepare("SELECT * FROM preces");
    $variable->execute(); 
    $preces = $variable->get_result();

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
        <title>Admin mājaslapa</title>
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

                <table>

                    <tr>
                        <th class="groza-header">preces ID</th>
                        <th class="groza-header">preces bilde</th>
                        <th class="groza-header">preces nosaukums</th>
                        <th class="groza-header">preces cena</th>
                        <th class="groza-header">preces atlaide</th>
                        <th class="groza-header">preces kategorija</th>
                        <th class="groza-header">mainīt</th>
                        <th class="groza-header">dzēst</th>
                    </tr>
                    <?php foreach($preces as $prece) { ?>
                    <tr>
                        <th><?php echo $prece['preces_id']; ?></th>
                        <th><img src="../assets/img/<?php echo $prece['preces_image']; ?>" alt="" width="100px" height="100px"></th>
                        <th><?php echo $prece['preces_name']; ?></th>
                        <th><?php echo $prece['preces_price']; ?>€</th>
                        <th><?php echo $prece['preces_category']; ?></th>
                        <th><a href="edit-prece.php?preces_id=<?php echo $prece['preces_id']; ?>" class="btn-change">mainīt</a></th>
                        <th><a href="dzest-prece.php?preces_id=<?php echo $prece['preces_id']; ?>" class="btn-delete">dzēst</a></th>
                    </tr>
                    <?php } ?>
                </table>

            </div>

        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>