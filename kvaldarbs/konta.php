<?php 

session_start();
include('php/connection.php');
//parbaude vai lietotajs ir iegajis sava konta. Gadijuma ja nav, tad viņš tiek parsutits uz ieejas lapu
if(!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}
//šis kods tiek lietots ja lietotajs velas nomainit paroli
if(isset($_POST['confirmPasswordChange'])) {
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $user_email = $_SESSION['user_email'];
    //ja paroles nesakrit, tad lietotajs tiek paziņots.
    if($password !== $confirmpassword) {
        header('location: konta.php?error=Paroles nesakrīt');
    //ja parola garums ir mazak par 8 simboliem tad lietotajs tiek paziņots
    } else if(strlen($password) < 8) {
        header('location: konta.php?error=Parolem jabut vismaz 8 simboliem');
    } else {
        //Ja nekadas kļudas nav, tad parols bus nomainits un datu baze bus jau cits, jaunais parols
        $variable = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
        $variable->bind_param('ss', md5($password), $user_email);
        //md5 ir paroles hash. izmantoju drošibas deļ
        if($variable->execute()) {
            header('location: konta.php?message=Parole ir nomainīta');
        } else {
            header('location: konta.php?error=Notika kļuda');
        }
    }
}
//Šeit izvadas visi pasutijumi, kurus lietotajs ir izveidojies iepriekš
if(isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];
    $variable = $conn->prepare("SELECT * FROM pasutijumi WHERE user_id = ?");
    $variable->bind_param('i', $user_id);
    $variable->execute();
    $orders = $variable->get_result();
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
        <title>Preces name</title>
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
            <p>Jusu dati</p>
        </div>

        <section class="container">
            <div class="content">
                <div class="konta-info">
                    <p class="lietotaja-dati">Vārds: <span><?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];} ?></span></p>
                    <p class="lietotaja-dati">Uzvārds: <span><?php if(isset($_SESSION['user_lastname'])) {echo $_SESSION['user_lastname'];} ?></span></p>
                    <p class="lietotaja-dati">E-pasts: <span><?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];} ?></span></p>
                    <p class="lietotaja-dati"><a href="#klietna-pasutijumi">Pasūtījumi</a></p>
                </div>
            </div>
        </section>

        <div class="outer-text konta-outer-text">
            <p>Mainīt paroli</p>
        </div>

        <section class="container">
            <div class="content">
                <form action="konta.php" method="POST">
                    <input type="password" placeholder="Jauna parole" class="konta-change-password-input" required name="password">
                    <input type="password" placeholder="Atkārtojiet paroli" class="konta-change-password-input" required name="confirmpassword">
                    <p class="error-message"><?php if(isset($_GET['error'])) {echo $_GET['error']; }?></p>
                    <p class="error-message success"><?php if(isset($_GET['message'])) {echo $_GET['message']; }?></p>
                    <input type="submit" value="Mainīt" class="konta-change-password-btn btn" required name="confirmPasswordChange">
                </form>
            </div>
        </section>

        <div class="outer-text konta-outer-text">
            <p>Jūsu Pasutījumi</p>
        </div>

        <section class="container" id="klietna-pasutijumi">
            <div class="content">
                <table>
                    <tr>
                        <th class="groza-header">Pasutijuma ID</th>
                        <th class="groza-header">Pasutijuma cena</th>
                        <th class="groza-header">Pasutijuma status</th>
                        <th class="groza-header">Datums</th>
                        <th class="groza-header">Pasūtījuma detaļas</th>
                    </tr>

                    <?php while($row = $orders->fetch_assoc()){ ?>

                    <tr>
                        <td>
                            <div class="groza-products">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $row['order_id']; ?></p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="groza-products">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $row['order_price']; ?>€</p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="groza-products">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $row['order_status']; ?></p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="groza-products">
                                <div class="groza-device-info">
                                    <p class="groza-device-name"><?php echo $row['order_date']; ?></p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <form method="POST" action="pasutijuma_detalas.php">
                                <input type="hidden" name="order_status" value="<?php $row ['order_status']; ?>">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <input type="submit" type="submit" value="Pasūtījuma detaļas" class="btn" name="pasutijumaDetalas">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table>    
            </div> 
        </section>
        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>