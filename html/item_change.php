<?php
    include "../php/functions.php";
    session_start();
    $products = load_products("../data/products.json");
    if($_SESSION["user"]["admin"] === false){
        header("Location: ../index.php");
    }
    if(isset($_POST["change"])){
        header("Location: ../items_change/item_modify.php");
    }
    if(isset($_POST["add"])){
        header("Location: ../items_change/item_add.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Termék módosítása</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- Navbár -->
<nav>
    <ul class="navbar">
        <li class="nav"><a href="../index.php"> <img src="../img/mekweb_logo.png" alt="logo"> </a></li>
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

<div class="space"></div>


    <h1>Termék módosítása</h1>
    <form action="item_change.php" method="POST" class="forms">
        <fieldset>
            <legend>Termék karbantartás</legend>
            <label for="name">Meglévő módosítása
            <input type="submit" value="Módosítás" name="change" class="button">
            </label>
            <label for="name">Új termék hozzáadása
            <input type="submit" value="Hozzáadás" name="add" class="button">
            </label>

        </fieldset>
    </form>

<div class="space"></div>
<footer>
<p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
    tanítási célból használtuk fel.</i></p>
</footer>
<a href="#" id="up-button"> 👆</a>
</body>
</html>
