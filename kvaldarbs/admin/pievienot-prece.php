<?php 
    include('../php/connection.php');
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
        <title>Preces pievienošana</title>
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
                        <a href="pasutijumi.php" class="a-links">Visi pasūtījumi</a>
                    </li>
                    <li class="li-links">
                        <a href="pievienot-prece.php" class="a-links activated">Pievienot preci</a>
                    </li>
                    <li class="li-links">
                        <a href="admin-logout.php" class="a-links">Iziet</a>
                    </li>
                </ul>
            </nav>
        </header>


        <section class="container">

            <div class="content">

                <form action="add_to_preces.php" method="POST" enctype="multipart/form-data"> 

                    <input type="text" name="nosaukums" placeholder="Preces nosaukums" class="piev-preces-input" required>
                    <input type="text" name="brands" placeholder="Preces zīmols" class="piev-preces-input" required>
                    <input type="text" name="kategorija" placeholder="Preces kategorija, piem: displejs/baterijas/plates" class="piev-preces-input" required>
                    <input type="text" name="description" placeholder="Preces apraksts" class="piev-preces-input" required>
                    <input type="text" name="price" placeholder="Preces cena" class="piev-preces-input" required>
                    <input type="text" name="color" placeholder="Preces krasa" class="piev-preces-input" required>
                    <input type="number" name="daudzums" placeholder="Daudzums noliktavā" class="piev-preces-input" required>

                    <div class="outer-text">
                        <p>Preces bildes</p>
                    </div>

                    <input type="file" name="imageFirst" class="piev-preces-input" required>
                    <input type="file" name="imageSecond" class="piev-preces-input">
                    <input type="file" name="imageThird" class="piev-preces-input">
                    <input type="file" name="imageFourth" class="piev-preces-input">

                    <input type="submit" value="Pievienot" class="pievienotbtn" name="pievienotBtn">

                </form>

            </div>

        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>