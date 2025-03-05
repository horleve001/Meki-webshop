<?php
include "../php/functions.php";
session_start();
$users = load_users("../data/users.json");
$cart = load_cart("../data/cart.json");
$calc = load_calc("../data/calc.json");

$error = [];
if (isset($_POST["signup"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["address"]) && isset($_POST["phone"]) && isset($_POST["age"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];


    foreach ($users["users"] as $user) {
        if ($user["username"] === $username) {
            $error[] = "A felhasználónév már foglalt!";
            break;
        }
    }

    foreach ($users["users"] as $user) {
        if ($user["email"] === $email) {
            $error[] = "Az email cím már foglalt!";
            break;
        }
    }

    if (strlen($password) < 5) {
        $error[] = "A jelszónak legalább 5 karakter hosszúnak kell lennie!";
        $error[] = "A telefonszám formátuma: +36203333333";
    }

    if ($age < 18) {
        $error[] = "Csak 18 éves kortól lehet regisztrálni!";
    }
    if (ctype_alpha(str_replace($username, " ", "")) && strlen($username) > 0) {
        $error[] = "A felhasználónév nem tartalmazhat szóközt!";
    }
    if (strlen($phone) != 12) {
        $error[] = "A telefonszám formátuma nem megfelelő!";
    }

    if (count($error) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $user = [
            "username" => $username,
            "password" => $password,
            "age" => $age,
            "fullname" => $fullname,
            "email" => $email,
            "address" => $address,
            "phone" => $phone,
            "admin" => false
        ];

        save_users("../data/users.json", $user);
        $_SESSION["user"] = $user;
        $cart[$_SESSION["user"]["username"]] = [""];
        $calc[$_SESSION["user"]["username"]] = [""];
        add_cart("../data/cart.json", $cart);
        add_calc("../data/calc.json", $calc);
        echo "Sikeres regisztráció!";
        header("Location: ../index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="space"></div>

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

<div>
    <form class="forms" action="reg.php" method="POST">
        <fieldset>
            <legend>Regisztráció</legend>
            <label> Teljes név:
                <input type="text" name="fullname" placeholder="Jóska Pista" required> </label>
            <label>Felhasználónév:
                <input type="text" name="username" placeholder="pistike123" required></label>
            <label>Email cím:
                <input type="email" name="email" placeholder="joskapista@citromail.hu" required></label>
            <label>Lakcím:
                <input type="text" name="address" placeholder="6255 Érmihályfalva, Tök u. 91" required></label>
            <label>Életkor:
                <input type="number" name="age" value="18" min="1" max="99"></label>
            <label>Telefonszám:
                <input type="tel" name="phone" placeholder="+36203333333" maxlength="12" required></label>
            <label>Jelszó:
                <input type="password" name="password" placeholder="****" required> </label>
        </fieldset>
        <input type="submit" value="Regisztrálok" name="signup" class="button">
        <?php foreach ($error as $err) { ?>
            <p><?= $err ?></p>
        <?php } ?>
        <br>
        <p>Már van accod? <a href="login.php">Lépj be!</a></p>
    </form>
</div>

<footer>
    <p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
            tanítási célból használtuk fel.</i></p>
</footer>
<a href="#" id="up-button"> 👆</a>
</body>
</html>