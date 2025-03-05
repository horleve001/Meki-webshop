<?PHP
    include "../php/functions.php";
    $products = load_products("../data/products.json");
    $calc = load_cart("../data/calc.json");
    session_start();

    if(isset($_POST["delete"]) && isset($_SESSION["user"])) {
        delete_cart("../data/calc.json");
        header("Location: ../index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kalkulátor</title>
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
    <h1>Kalóriakalkulátor</h1>
    <form action="calc.php" method="POST" >
        <?php if($calc[$_SESSION["user"]["username"]] === null){ ?>
            <h2>A Kalkulátor üres!</h2>
        <?php } else { ?>
        <table class="tables">
            <tr>
                <th>Termék neve</th>
                <th id="cost">Kalória</th>
            </tr>
            <?php
                $total = 0;
                foreach ($calc[$_SESSION["user"]["username"]] as $item) {
                    foreach ($products["products"] as $product) {
                        if ($product["name"] === $item) {
                            $total += $product["kcal"];
                            ?>
                            <tr>
                                <td class="td_left"><?php echo $product["name"]; ?></td>
                                <td class="td_right"><?php echo $product["kcal"]; ?> kcal</td>
                            </tr>
                            <?php
                        }
                    }
                }
            ?>
            <tr>
                <td><b>Összesen:</b></td>
                <td class="total"><?php echo $total; ?> kcal</td>
            </tr>
        </table>
        <br>
        <button type="submit" name="delete" class="remove-button">Kalkulátor ürítése</button>
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