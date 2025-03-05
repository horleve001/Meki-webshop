<?PHP
    include "../php/functions.php";
    $products = load_products("../data/products.json");
    $cart = load_cart("../data/cart.json");
    session_start();

    if(isset($_POST["delete"]) && isset($_SESSION["user"])) {
        delete_cart("../data/cart.json");
        header("Location: ../index.php");
    }
    if(isset($_POST["order"]) && isset($_SESSION["user"])){ 
        delete_cart("../data/cart.json");
        header("Location: pay.php");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kosár</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
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

<div class="space"></div>

<div class="container">
    <h1>Kosár</h1>
    <form action="cart.php" method="POST" >
        <?php if($cart[$_SESSION["user"]["username"]] === null){ ?>
            <h2>A kosár üres!</h2>
        <?php } else { ?>
        <table class="tables">
            <tr>
                <th>Termék neve</th>
                <th id="cost">Ár</th>
            </tr>
            <?php
                $total = 0;
                
                foreach ($cart[$_SESSION["user"]["username"]] as $item) {
                    foreach ($products["products"] as $product) {
                        if ($product["name"] === $item) {
                            if(isset($product["new_price"])){
                            $total += $product["new_price"];
                            }
                            else{
                            $total += $product["price"];
                            }
                            ?>
                            <tr>
                                <td class="td_left"><?= $product["name"] ?></td>
                                <td class="td_right"><?= isset($product["new_price"]) ? $product["new_price"] : $product["price"] ?> Ft</td>
                            </tr>
                            <?php
                        }
                    }
                }
            ?>
            <tr>
                <td><b>Összesen:</b></td>
                <td class="total"><?= $total ?> Ft</td>
            </tr>
        </table>
        <br>
        <button type="submit" name="order" class="pay-button">Megrendelés</button>
        <button type="submit" name="delete" class="remove-button">Kosár ürítése</button>
        <?php } ?>
    </form>
</div>

<div class="space"></div>
<footer>
    <p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
        tanítási célból használtuk fel.</i></p>
</footer>
<a href="#" id="up-button"> 👆</a>
</body>
</html>