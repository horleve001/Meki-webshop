<?PHP
include "../php/functions.php";
session_start();

$ratings = load_ratings("../data/ratings.json");

if (isset($_POST["submit"])) {
    $rating = $_POST["rating"];
    $review = $_POST["review"];
    $user = $_SESSION["user"]["username"];
    if($review === "") {
        $error = "Nem adtál meg véleményt!";
    }
    else{
        $review = [
            "user" => $user,
            "rating" => $rating,
            "review" => $review,
        ];
        save_rating("../data/ratings.json", $review);
        header("Location: forum.php");
    }
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fórum</title>
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


<h1 id="title">Mondd el a véleményedet</h1>


<!-- Új értékelés -->
<div>
    <form class="forms" action="forum.php" method="POST">
        <fieldset>
            
        <label for="rating">Értékelés (1-5):
            <select name="rating">
                <option value="⭐⭐⭐⭐⭐" selected>⭐⭐⭐⭐⭐</option>
                <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                <option value="⭐⭐⭐">⭐⭐⭐</option>
                <option value="⭐⭐">⭐⭐</option>
                <option value="⭐">⭐</option>
            </select>
        </label>
        <label for="review">Vélemény:
            <textarea name="review" rows="5" cols="64"></textarea>
        </label>
        </fieldset>
        <input class="button" type="submit" name="submit" value="Értékelés és vélemény küldése">
        <?php if(isset($error)){ ?>
            <p class="error"><?=$error?></p>
        <?php } ?>
    </form>
        
</div>


<div class="reviews">
    <?php
    foreach ($ratings["ratings"] as $rating) {
        ?>
        <div class="review">
            <h2><?=$rating["user"]?></h2>
            <p class="ratings-text"><?=$rating["rating"]?></p>
            <p class="ratings-text"><?=$rating["review"]?></p>
        </div>
        <?php
    }
    ?>
</div>


<a href="#" id="up-button"> 👆</a>
<footer>
    <p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
            tanítási célból használtuk fel.</i></p>
</footer>
</body>
</html>