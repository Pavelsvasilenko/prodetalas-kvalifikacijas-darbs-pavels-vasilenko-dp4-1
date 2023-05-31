<?php 

include('php/connection.php');
//ja lietotajs izmantoja filtrus veikalas lapa, tad sistema paradis viņam
if(isset($_POST['precizet'])) {

    if(isset($_POST['category'])){$category = $_POST['category'];}
    $price = $_POST['precesCena'];
    //to, ko lietotajs izvelejas, no zemakam cenam uz augšu
    $variable = $conn->prepare("SELECT * FROM preces WHERE preces_category = ? AND preces_price >= ? ORDER BY preces_price");

    $variable->bind_param("si", $category, $price);

    $variable->execute(); 

    $visaspreces = $variable->get_result();

} else {
    //pec noklusejuma lietotajs var apskatit visas preces. Pirma prece bus tada, kuru administators ir pievienojis pedejai
    $variable = $conn->prepare("SELECT * FROM preces ORDER BY preces_id DESC");
    $variable->execute(); 
    $visaspreces = $variable->get_result();

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
        <title>Veikals</title>
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
                        <a href="veikals.php" class="a-links activated">Veikals</a>
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

        <section class="veikals-kategorijas-container">
            <div class="veikals-kategorijas-content">
                <div class="veikals-kategorijas-header">
                    <p>Kategorijas</p>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="content">
                <form action="veikals.php" method="POST" class="form-for-categories">
                    <div class="kategorijas-check">
                        <input type="radio" name="category" id="pirmaCategory" value="displejs">
                        <label for="pirmaCategory">Displejs</label>
                    </div>
                    <div class="kategorijas-check">
                        <input type="radio" name="category" id="otraCategory" value="baterijas">
                        <label for="otraCategory">Baterijas</label>
                    </div>
                    <div class="kategorijas-check">
                        <input type="radio" name="category" id="tresaCategory" value="plates">
                        <label for="tresaCategory">Plates ar lad. konektoru</label>
                    </div>
                    <div class="kategorijas-check">
                        <div class="range-input-veikals">
                            <input id="range-no" type="range" min="0" max="1000" name="precesCena" value="200" step="10" class="veikals-range-input">
                            <p>Cenas no: <output id="rezultats"></output>€</p>
                        </div>
                    </div>
                    <div>
                        <input type="submit" value="Meklēt" class="btn" name="precizet">
                    </div>
                </form>
            </div>
        </section>

        <section class="container">
            <div class="content">    
                
                <?php while ($row=$visaspreces->fetch_assoc()) { ?>

                <div class="piedavajums">
                    <img src="assets/img/<?php echo $row['preces_image']; ?>" alt="" width="300px" height="300px" class="piedavajums-img">
                    <p class="piedavajums-info"><?php echo $row['preces_name']; ?></p>
                    <p class="piedavajums-info"><?php echo $row['preces_price']; ?>€</p>
                    <a href="<?php echo "singleproduct.php?preces_id=". $row['preces_id']; ?>" class="btn" name="toSingleProduct">Skatīt</a>
                </div>

                <?php } ?>
            </div>
        </section>

        <div class="outer-text">
            <p>Pāvels Vasiļenko DP4-1</p>
        </div>

        <script src="assets/js/hamburgermenu.js"></script>
        <script src="assets/js/range-output.js"></script>
    </body>
</html>