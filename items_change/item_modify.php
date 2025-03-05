<?php 
    include "../php/functions.php";
    session_start();
    $products = load_products("../data/products.json");

    $error;
    if($_SESSION["user"]["admin"] === false){
        header("Location: ../index.php");
    }
    if(isset($_GET["item_select"])){
        foreach($products["products"] as $product){
            if($product["name"] === $_GET["item_name"]){
                $prod = $product;
                break;
            }
        }
    }
    if(isset($_POST["modify"])){
        $name = $_POST["name"];
        $price = $_POST["price"];
        $kcal = $_POST["kcal"];
        $description = $_POST["description"];
        if($_FILES["image"]["name"] != "" && isset($_FILES["image"])){
            $image = $_FILES["image"]["name"];
            $dest = "../img/".$_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], $dest);
        }
        else{
            foreach($products["products"] as $product){
                if($product["name"] === $_POST["item_name"]){
                    $image = $product["image"];
                    break;
                }
            }
        }
        if($_POST["new_price"] == ""){
            $new_price = null;
        }
        else{
            $new_price = $_POST["new_price"];
        }
        $changed_product = [
            "name" => $name,
            "price" => $price,
            "kcal" => $kcal,
            "description" => $description,
            "image" => $image,
            "new_price" => $new_price
        ];
        $index = 0;
        foreach($products["products"] as $product){
            if($product["name"] === $_POST["item_name"] ){
                $products["products"][$index] = $changed_product;
                break;
            }
            $index++;
        }
        header("Location: ../index.php");
        save_products("../data/products.json", $products);
    }

    if(isset($_POST["product_delete"])){
        $index = 0;
        foreach($products["products"] as $product){
            if($product["name"] === $_POST["item_name"]){
                unset($products["products"][$index]);
                break;
            }
            $index++;
        }
        save_products("../data/products.json", $products);
        header("Location: item_delete.php");
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
    <h1>Válaszd ki mit szeretnél módosítani!</h1>
    <form action="item_modify.php" method="GET" class="forms">
        <fieldset>
            <legend>Termék választás</legend>
            <label for="name">Név
            <select name="item_name" required>
                <?php foreach($products["products"] as $product) { ?>
                <option type ="text"><?= $product["name"] ?></option>
            <?php } ?>
            </select>
            </label>
            <input type="submit" value="Módosítás" name="item_select" class="button">
        </fieldset>
    </form>
</div>

<div>
    <?php if(!isset($prod)){ ?>
    <?php } else{?> 
    <form action="item_modify.php" method="POST" class="forms" enctype="multipart/form-data">  
        <fieldset>
            <legend>Termék módosítása</legend>
            <label for="name">Név
            <input type="text" name="name" value="<?=$prod["name"] ?>" >
            </label>
            <label for="price">Ár
            <input type="number" name="price" value="<?=$prod["price"] ?>" >
            </label>
            <label for="kcal">Kalória
            <input type="number" name="kcal" value="<?=$prod["kcal"] ?>" >
            </label>
            <label for="description">Leírás
            <textarea type="text" name="description" rows="5" cols="64" ><?=$prod["description"]?></textarea>
            </label>
            <label for="image">Kép
            <img src="../img/<?=$prod["image"]?>" alt="product_img">
            <input type="file" id="file-upload" name="image" value="../img/<?=$prod["image"]?>" accept="image/*">
            </label>
            <label for="new_price">Akciós ár
            <input type="number" name="new_price" value="<?=$prod["new_price"]?>">
            </label>
            <input hidden name="item_name" value="<?=$prod["name"]?>">
        </fieldset>
        <input type="submit" value="Módosítás" name="modify" class="button">
        <input type="submit" value="Termék törlése" name="product_delete" class="remove-button">
    </form>
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
