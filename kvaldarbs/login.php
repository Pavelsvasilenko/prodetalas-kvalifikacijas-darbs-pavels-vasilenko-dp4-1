<?php 

session_start();
include('php/connection.php');
//Ja lietotajs jau iegajis konta, tad viņš bus parsutits uz majas lapu.
if(isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}
//parbaude, vai lietotajs eksiste datu baze vai ne
if(isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    //sql pieprasijuma sagatovašana un parbaude
    $variable = $conn->prepare("SELECT user_id, user_name, user_lastname, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
    $variable->bind_param('ss', $email, $password);

    if($variable->execute()) {
        $variable->bind_result($user_id, $user_name, $user_lastname, $user_email, $user_password);
        $variable->store_result();

        if($variable->num_rows() == 1) {
            $variable->fetch();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_lastname'] = $user_lastname;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            //ja lietotajs eksiste datu baze, tad viņš bus parsutits majas lapa
            header('location: index.php'); 
        } else {
            header('location: login.php?error=Ši konta neeksiste');
        }

    } else {
        header('location: login.php?error=Notika kļuda');
    }
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
        <title>Autorizācija</title>
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
                <div class="auth-header">
                    <p>Autorizācija</p>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="content">
                <form action="login.php" method="POST" class="auth-fields">
                    <input type="email" name="email" id="email" class="auth-input-field" required placeholder="Jūsu e-pasts"> 
                    <input type="password" name="password" id="password" class="auth-input-field" required placeholder="Jūsu parole"> 
                    <p class="help-message-register">Nav konta? <a href="register.php">Reģistracija</a></p>
                    <p class="error-message"><?php if(isset($_GET['error'])) {echo $_GET['error']; }?></p>
                    <p class="error-message"><?php if(isset($_GET['message'])) {echo $_GET['message']; }?></p>
                    <input type="submit" name="loginBtn" id="loginBtn" class="auth-input-btn" required value="Ieeja"> 
                </form>
            </div>
        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>