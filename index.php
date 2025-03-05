<?PHP
    include "php/functions.php";
    session_start();
    $products = load_products("data/products.json");
    $prod;
    $cart = load_cart("data/cart.json");
    $calc = load_calc("data/calc.json");

    if(isset($_GET["action"]) && isset($_GET["prod"])){
        $action = $_GET["action"];
        $prod = $_GET["prod"];
    }

    if(!isset($_SESSION["user"]) && isset($_POST["add_to_cart"]) && $action === "add"){
        header("Location: html/login.php");
    }

    if(!isset($_SESSION["user"]) && isset($_POST["add_to_calc"]) && $action === "add"){
        header("Location: html/login.php");
    }

    if(isset($_SESSION["user"]) && isset($_POST["add_to_cart"]) && $action === "add") {
        foreach ($products["products"] as $product){
            if($product["name"] === $prod){
                if($cart[$_SESSION["user"]["username"]] === null){
                    $cart[$_SESSION["user"]["username"]] = ["$prod"];
                }
                else{
                    array_push($cart[$_SESSION["user"]["username"]], $prod);
                }
                
                add_cart("data/cart.json", $cart);
                $action = "";
                $prod = "";
                header("Location: index.php");
                break;
            }
        }
    }
    if (isset($_SESSION["user"]) && isset($_POST["add_to_calc"]) && $action === "add"){
        foreach ($products["products"] as $product){
            if($product["name"] === $prod){
                if($calc[$_SESSION["user"]["username"]] === null){
                    $calc[$_SESSION["user"]["username"]] = ["$prod"];
                }
                else{
                    array_push($calc[$_SESSION["user"]["username"]], $prod);
                }
                add_calc("data/calc.json", $calc);
                $action = "";
                $prod = "";
                header("Location: index.php");
                break;
                
            }
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Termékeink</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="space"></div>

<!-- Navbár -->

<nav>
    <ul class="navbar">
        <li class="nav"><a href="index.php"> <img src="img/mekweb_logo.png" alt="logo"> </a></li>
        <li class="nav"><a href="html/calc.php">Kalkulátor</a></li>
        <li class="nav"><a href="html/forum.php"> Fórum </a></li>
        <li class="nav"><a href="html/faq.php">Gyakori kérdések</a></li>
        <li class="nav"><a href="html/cart.php">Kosár</a></li>
        <?php if (isset($_SESSION["user"])) { ?>
        <li class="nav"><a href="html/profil.php">Profilom</a></li>
        <li class="nav"><a href="html/logout.php">Kijelentkezés</a></li>
        <?php } else { ?>  
        <li class="nav"><a href="html/login.php">Belépés/Regisztráció</a></li>
        <?php } ?>
    </ul>
</nav>


<!-- Termékek -->

<h1 id="title">Termékeink</h1>
<h2 class="subtitle">Szendvicsek:</h2>

<div>
    <?php
    foreach ($products["products"] as $product){?>
            
        <div class="cards">
            <img src="img/<?=$product["image"]?>" alt="product_img">
            <h1 class="product_name"><?=$product["name"]?></h1>
            <?php if(isset($product["new_price"])){ ?>
            <p class="price-cross"><?=$product["price"]?>HUF</p>
            <p class="new-price"><?=$product["new_price"]?>HUF</p>
            <?php } else {?>
            <p class="price"><?=$product["price"]?>HUF</p>
            <?php } ?>
            <p class="product-details"><?=$product["description"]?></p>
            <p class="kcal">Kalóriaérték: <?=$product["kcal"]?>kcal</p>
            <form method="POST" action="index.php?action=add&prod=<?php echo $product["name"]; ?>">
                <button name="add_to_cart" class="add-to-cart" value="<?=$product["name"]?>">Kosárhoz adom</button>
            </form>
            <form method="POST" action="index.php?action=add&prod=<?php echo $product["name"]; ?>">
                <button name="add_to_calc" class="add-to-calc" value="<?=$product["name"]?>">Kalóriakalkulátorhoz adom</button>
            </form>
            <br><br>
        </div>

        <?php } ?> 
</div>
<div class="space"></div>
<footer>
    <p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
        tanítási célból használtuk fel.</i></p>
</footer>

<a href="#" id="up-button"> 👆</a>
</body>
</html>