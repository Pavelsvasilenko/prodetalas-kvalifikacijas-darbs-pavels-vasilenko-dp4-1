<?php 

session_start();
include('../php/connection.php');

if(isset($_SESSION['admin_logged_in'])) {
    header('location: index.php');
    exit;
}

if(isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $variable = $conn->prepare("SELECT admin_id, admin_name, admin_lastname, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    $variable->bind_param('ss', $email, $password);

    if($variable->execute()) {
        $variable->bind_result($admin_id, $admin_name, $admin_lastname, $admin_email, $admin_password);
        $variable->store_result();

        if($variable->num_rows() == 1) {
            $variable->fetch();
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_lastname'] = $admin_lastname;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php'); 
        } else {
            header('location: login.php?error=Ši konta neeksiste');
        }

    } else {
        
    }
}
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
        <title>Autorizācija</title>
    </head>

    <body>
        <header class="header">
            <nav class="nav">
                <a href="index.php" class="text-logo" id="text-logo">ProDetaļas admin</a>
                <i class="fas fa-bars" id="hamburger-menu"></i>
            </nav>
        </header>

        <section class="container">
            <div class="content">
                <div class="auth-header">
                    <p>Autorizācija Administratoram</p>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="content">
                <form action="login.php" method="POST" class="auth-fields">
                    <input type="email" name="email" id="email" class="auth-input-field" required placeholder="Jūsu e-pasts"> 
                    <input type="password" name="password" id="password" class="auth-input-field" required placeholder="Jūsu parole"> 
                    <p class="error-message"><?php if(isset($_GET['error'])) {echo $_GET['error']; }?></p>
                    <p class="error-message"><?php if(isset($_GET['message'])) {echo $_GET['message']; }?></p>
                    <input type="submit" name="loginBtn" id="loginBtn" class="auth-input-btn" required value="Ieeja"> 
                </form>
            </div>
        </section>

        <script src="assets/js/hamburgermenu.js"></script>
    </body>
</html>