<?php
  include "../php/functions.php";
  session_start();      
  $users = load_users("../data/users.json"); 
  $siker = false;                   

  if (isset($_POST["login"]) && isset($_POST["username"]) && isset($_POST["password"])) {    
    $username = $_POST["username"];
    $password = $_POST["password"];

    foreach ($users["users"] as $user) {              
        if ($user["username"] === $username && password_verify($password, $user["password"])) {
            $siker = true;
            $_SESSION["user"] = $user;
            header("Location: ../index.php");
            break;

        }
    }
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Belépés/Regisztráció</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="space"></div>

<!-- Navbár -->
<nav>
    <ul class="navbar">
        <li class="nav"><a href="../index.php"> <img src="../img/mekweb_logo.png" alt="logo"> </a>
        </li>
        <li class="nav"><a href="calc.php">Kalkulátor</a></li>
        <li class="nav"><a href="forum.php"> Fórum </a></li>
        <li class="nav"><a href="faq.php">Gyakori kérdések</a></li>
        <li class="nav"><a href="cart.php">Kosár</a></li>
        <?php if (isset($_SESSION["user"])) { ?>
        <li class="nav"><a href="profil.php">Profilom</a></li>
        <li class="nav"><a href="logout.php">Kijelentkezés</a></li>
        <?php } else { ?>  
        <li class="nav"><a href="login.php">Belépés/Regisztráció</a></li>
        <?php } ?>
        
    </ul>
</nav>

<div>
    <form class="forms" action="login.php" method="POST">
        <fieldset>
            <legend>Belépés</legend>
            <label>Felhasználónév:
                <input type="text" name="username" required></label>
            <label>Jelszó:
                <input type="password" name="password" required> </label>
        </fieldset>
        <input type="submit" value="Belépés" name="login" class="button">
        <?php if ($siker === false && isset($_POST["login"])) { ?>
            <p class="error_message">Hibás felhasználónév vagy jelszó!</p>
        <?php } ?>
        <p>Nincs még accod? <a href="reg.php">Regisztrálj!</a></p>
    </form>
</div>
<footer>
    <p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
        tanítási célból használtuk fel.</i></p>
</footer>
<a href="#" id="up-button"> 👆</a>
</body>
</html>