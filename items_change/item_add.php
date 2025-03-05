<?php 
    include "../php/functions.php";
    session_start();
    $products = load_products("../data/products.json");
    $error = [];
    if($_SESSION["user"]["admin"] === false){
        header("Location: ../index.php");
    }
    if(isset($_POST["add"])){
        $name = $_POST["name"];
        $price = $_POST["price"];
        $kcal = $_POST["kcal"];
        $description = $_POST["description"];
        
        foreach($products["products"] as $product){
            if($product["name"] === $name){
                $error[] = "A termék már létezik!";
                break;
            }
        }
        if(count($error) > 0){
            foreach($error as $err){
                echo $err;
            }
        }
        if($_FILES["image"]["name"] != "" && isset($_FILES["image"])){
            $image = $_FILES["image"]["name"];
            $dest = "../img/".$_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], $dest);
        }
        else{
            $error[] = "Nincs kép kiválasztva!";
        }
        if(count($error) > 0){
            foreach($error as $err){
                echo $err;
            }
        }
        if(count($error) === 0){
            $new_product = [
                "name" => $name,
                "price" => $price,
                "kcal" => $kcal,
                "description" => $description,
                "image" => $image,
                "new_price" => null
            ];
            $products["products"][] = $new_product;
            save_products("../data/products.json", $products);
            header("Location: ../index.php");
        }
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

<div>
    <form class="forms" action="item_add.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Termék hozzáadása</legend>
            <label for="name">Név:
            <input type="text" id="name" name="name" required>
            </label>
            <label for="price">Ár:
            <input type="number" id="price" name="price" required>
            </label>
            <label for="kcal">Kalória:
            <input type="number" id="kcal" name="kcal" required>
            </label>
            <label for="description">Leírás:
            <textarea type="text" id="description" name="description" rows="5" cols="65" required></textarea>
            </label>
            <label for="image">Kép:
            <input type="file" id="image" name="image" accept="image/*" required>
            </label>
            <button type="submit" name="add" class="button">Hozzáadás</button>
        </fieldset>
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
