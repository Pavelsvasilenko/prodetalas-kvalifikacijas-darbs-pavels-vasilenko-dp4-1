<?php 

session_start();
//Parbaude vai lietotajs ir pievienojis kaut ko grozai iepriekš vai ne
if(isset($_POST['preces_to_groza'])) {
    //
    if(isset($_SESSION['groza'])) {

        $prece_arr_id = array_column($_SESSION['groza'], "preces_id");
        if(!in_array($_POST['preces_id'], $prece_arr_id) ) {

            $preces_id = $_POST['preces_id'];
            
            $prece_arr = array(
                'preces_id' => $_POST['preces_id'],
                'preces_name' => $_POST['preces_name'],
                'preces_price' => $_POST['preces_price'],
                'preces_image' => $_POST['preces_image'],
                'preces_daudzums' => $_POST['preces_daudzums']
            );
            //Veidoju sessiju kura glabas preces groza kamer brauzers ir atverts
            $_SESSION['groza'][$preces_id] = $prece_arr;

        } else {

            echo '<script>alert("Prece jau ir groza");</script>';

        }
        //Gadijuma, ja tas ir pirma prece
    } else {

        $preces_id = $_POST['preces_id'];
        $preces_name = $_POST['preces_name'];
        $preces_price = $_POST['preces_price'];
        $preces_image = $_POST['preces_image'];
        $preces_daudzums = $_POST['preces_daudzums'];

        $prece_arr = array(
            'preces_id' => $preces_id,
            'preces_name' => $preces_name,
            'preces_price' => $preces_price,
            'preces_image' => $preces_image,
            'preces_daudzums' => $preces_daudzums
        );
        //ka pirmaja parbaude visas preces glabas sessija.
        $_SESSION['groza'][$preces_id] = $prece_arr;

    }

    kopejasGrozasSumma();
//Šis kods tiek lietots, ja lietotājs velas izdest preci no groza
} else if(isset($_POST['dzest_prece'])) {

    $preces_id = $_POST['preces_id'];

    unset($_SESSION['groza'][$preces_id]);

    kopejasGrozasSumma();
//Šis kods tiek lietots, ja lietotajs velas nomainit preces daudzumu groza
} else if(isset($_POST['mainit_daudzumu'])) {

    $preces_id = $_POST['preces_id'];
    $preces_daudzums = $_POST['preces_daudzums'];

    $prece_arr = $_SESSION['groza'][$preces_id];

    $prece_arr['preces_daudzums'] = $preces_daudzums;

    $_SESSION['groza'][$preces_id] = $prece_arr;

    kopejasGrozasSumma();

} else {

}
//funkcija, kura skaita grozas kopejo summu. 
function kopejasGrozasSumma() {
    //No sakuma kopeja summa = 0;
    $kopejasumma = 0;
    //Šeit es ņemu visas preces no esošas sessijas
    foreach($_SESSION['groza'] as $key => $value) {

        $prece = $_SESSION['groza'][$key];
        $price = $prece['preces_price'];
        $daudzums = $prece['preces_daudzums'];
        //un šeit es skaitu kopeju summu. Katru reizi kad es mainu daudzumu paramers $kopejasumma tiek parrakstits ar jauno mainigo
        $kopejasumma = $kopejasumma + ($price * $daudzums);

    }

    $_SESSION['kopejasumma'] = $kopejasumma;

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
        <title>Groza</title>
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
                        <a href="groza.php" class="a-links activated">Groza</a>
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
                <table>
                    <tr>
                        <th class="groza-header">Prece</th>
                        <th class="groza-header">Daudzums</th>
                        <th class="groza-header">Summa</th>
                    </tr>

                    <?php if(isset($_SESSION['groza'])) {foreach($_SESSION['groza'] as $key => $value){ ?>

                    <tr>
                        <td>
                            <div class="groza-products">
                                <img src="assets/img/<?php echo $value['preces_image']; ?>" alt="" width="100px" height="100px">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $value['preces_name']; ?></p>
                                    <p class="groza-device-cena"><?php echo $value['preces_price']; ?>€</p>
                                    <form action="groza.php" method="POST">
                                        <input type="hidden" name="preces_id" value="<?php echo $value['preces_id']; ?>">
                                        <input type="submit" class="groza-device-dzest-btn btn" name="dzest_prece" value="Dzest">
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="groza-products">
                                <form action="groza.php " method="POST">
                                    <input type="hidden" name="preces_id" value="<?php echo $value['preces_id']; ?>">
                                    <input type="number" name="preces_daudzums" id="" class="groza-input-number-btn" value="<?php echo $value['preces_daudzums']; ?>">
                                    <input type="submit" value="Mainīt" class="groza-mainit-btn btn" name="mainit_daudzumu">
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="groza-products">
                                <p class="groza-sum"><?php echo $value['preces_daudzums'] * $value['preces_price']; ?>€</p>
                            </div>
                        </td>
                    </tr>
                    <?php }} ?>
                </table>
            </div>
        </section>

        <div class="groza-outer-text"></div>

        <section class="container">
            <div class="content">
                <div class="groza-kopeja-summa">
                    <table>        
                        <tr>        
                            <td>Kopeja summa:</td>
                            <td><?php if(isset($_SESSION['kopejasumma'])){echo $_SESSION['kopejasumma'];} ?>€</td>        
                        </tr>
                    </table>
                </div>
                <div class="noformet-btn">
                    <form action="noformesana.php" methos="POST">
                    <input type="submit" value="Noformēt" name="noformet" class="groza-noformet-btn btn">
                    </form>
                </div>
            </div>
        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>