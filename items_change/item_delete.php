<?php 
    include "../php/functions.php";
    session_start();
    $products = load_products("../data/products.json");
    if($_SESSION["user"]["admin"] === false){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Termék hozzáadása</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- Navbár -->
<nav>
    <ul class="navbar">
        <li class="nav"><a href="../index.php"> <img src="../img/mekweb_logo.png" alt="logo"> </a></li>
        <li class="nav"><a href="../html/calc.php">Kalkulátor</a></li>
        <li class="nav"><a href="../html/forum.php"> Fórum </a></li>
        <li class="nav"><a href="../html/faq.php">Gyakori kérdések</a></li>
        <li class="nav"><a href="../html/cart.php">Kosár</a></li>
        <?php if (isset($_SESSION["user"])) { ?>
        <li class="nav"><a href="../html/profil.php">Profilom</a></li>
        <li class="nav"><a href="../html/logout.php">Kijelentkezés</a></li>
        <?php } else { ?>  
        <li class="nav"><a href="../html/login.php">Belépés/Regisztráció</a></li>
        <?php } ?>
    </ul>
</nav>
<div class="space"></div>
<h1>Termék sikeresen törölve</h1>

<div class="space"></div>
<footer>
<p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
    tanítási célból használtuk fel.</i></p>
</footer>
<a href="#" id="up-button"> 👆</a>
</body>
</html>