<?php 

session_start();

if(isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}

include('php/connection.php');
//jauna lietotaja reģistracija
if(isset($_POST['register'])) {
//ņemu visus datus no formas
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
//parbaude parolem, vai tie sakrit
    if($password !== $confirmpassword) {
        header('location: register.php?error=Paroles nesakrīt');
//parolem jabut vismaz 8 simboliem garuma    
    } else if(strlen($password) < 8) {
        header('location: register.php?error=Parolem jabut vismaz 8 simboliem');
    //parbaude, vai e-pasts jau eksiste datu baze
    } else {
        $variable2 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $variable2->bind_param('s', $email);
        $variable2->execute();
        $variable2->bind_result($num_rows);
        $variable2->store_result();
        $variable2->fetch();
        //ja e-pasts jau eksiste, tad lietotajs tiek paziņots
        if($num_rows != 0) {
            header('location: register.php?error=Šis e-pasts jau ir aizņemts');
        } else { //un ja viss ir ok, tad lietotajs var piereģistreties sistema
            $variable = $conn->prepare("INSERT INTO users (user_name, user_lastname, user_email, user_password)
            VALUES (?, ?, ?, ?);");

            $variable->bind_param('ssss', $name, $lastname, $email, md5($password));

            if($variable->execute()) {
                $user_id = $variable->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: index.php?register=Reģistracija ir pabeigta');
            } else {

                header('location: register.php?error=Nevaram izveidot kontu');

            }
        }
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
        <title>Reģistracija</title>
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
                    <p>Reģistracija</p>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="content">
                <form action="register.php" method="POST" class="auth-fields">
                    
                    <input type="text" name="name" id="name" class="auth-input-field" required placeholder="Jūsu vārds"> 
                    <input type="text" name="lastname" id="lastname" class="auth-input-field" required placeholder="Jūsu uzvārds"> 
                    <input type="email" name="email" id="email" class="auth-input-field" required placeholder="Jūsu e-pasts"> 
                    <input type="password" name="password" id="password" class="auth-input-field" required placeholder="Jūsu parole"> 
                    <input type="password" name="confirmpassword" id="confirmpassword" class="auth-input-field" required placeholder="Atkārtojiet paroli"> 
                    <p class="help-message-register">Jau ir konta? <a href="login.php">Ieeja</a></p>
                    <p class="error-message"><?php if(isset($_GET['error'])) {echo $_GET['error']; }?></p>
                    <input type="submit" name="register" id="register" class="auth-input-btn" required value="Ieeja"> 
                </form>
            </div>
        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>