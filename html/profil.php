<?PHP
    include "../php/functions.php";
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
    }
    $users = load_users("../data/users.json");
    $error = [];
    if (isset($_POST["user_change"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $age = $_POST["age"];
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        foreach ($users["users"] as $user) {
            if ($user["username"] === $username && $user["username"] !== $_SESSION["user"]["username"]) {
                $error[] = "A felhasználónév már foglalt!";
                break;
            }
        }
        foreach ($users["users"] as $user) {
            if ($user["email"] === $email && $user["email"] !== $_SESSION["user"]["email"]) {
                $error[] = "Az email cím már foglalt!";
                break;
            }
        }
        if (strlen($password) < 5) {
            $error[] = "A jelszónak legalább 5 karakter hosszúnak kell lennie!";
        }
        if ($age < 18) {
            $error[] = "Csak 18 éves kortól lehet regisztrálni!";
        }
        if (ctype_alpha(str_replace($fullname, " ", "")) && strlen($fullname) > 0) {
            $error[] = "A név csak betűt tartalmazhat!";
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
            update_user("../data/users.json", $user);
            $_SESSION["user"] = $user;
            echo "Sikeres frissítés!";
        }
    }
    if(isset($_POST["user_delete"])){
        delete_user("../data/users.json");
       session_destroy();
       header("Location: logout.php");
    }

    if(isset($_POST['upload-btn']) && isset($_FILES['profile-pic'])) {
        $profilePic = $_FILES['profile-pic'];    
        $fileDestination = '../uploads/' . $profilePic['name'];
        move_uploaded_file($profilePic['tmp_name'], $fileDestination);
        $users["users"]["profile-pic"] = $fileDestination;
        $_SESSION["user"]["profile-pic"] = $fileDestination;
        update_user("../data/users.json", $_SESSION["user"]);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profilom</title>
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

<h1 id="title">Profilom</h1>
<div>
    <form class="forms" action="profil.php" method="POST" enctype="multipart/form-data">
        <label for="file-upload">Profilkép:</label>
        <img src="<?php echo $_SESSION["user"]["profile-pic"] ?? ''; ?>"  id="profpic" alt="Profilkép" width="120">
        <input type="file" id="file-upload" name="profile-pic" accept="image/*"/> <br/>
        <input type="submit" name="upload-btn" value="Feltöltés"/>
    </form>
    <form class="forms" action="profil.php" method="POST">
        <fieldset>
            <legend>Profil szerkesztése</legend>
            <label>Teljes név:
                <input type="text" name="fullname" value="<?php echo $_SESSION["user"]["fullname"]?>"required>
            </label>
            <label>Felhasználónév:
                <input type="text" name="username" value="<?php echo $_SESSION["user"]["username"]?>"required>
            </label>
            <label>Email cím:
                <input type="email" name="email" value="<?php echo $_SESSION["user"]["email"]?>"required>
            </label>
            <label>Lakcím:
                <input type="text" name="address" value="<?php echo $_SESSION["user"]["address"]?>"required>
            </label>
            <label>Életkor:
                <input type="number" name="age" value="18" min="1" max="99" value="<?php echo $_SESSION["user"]["age"]?>">
            </label>
            <label>Telefonszám:
                <input type="tel" name="phone" value="<?php echo $_SESSION["user"]["phone"]?>"maxlength="12" required>
            </label>
            <label>Jelszó:
                <input type="password" name="password" placeholder="****">
            </label>
        </fieldset>
        <?php if (count($error) > 0) { ?>
            <div class="error">
                <?php foreach ($error as $err) {
                    echo $err . "<br>";
                } ?>
            </div>
        <?php } ?>
        <input type="submit" value="Profil frissítése" name="user_change" class="button">
        <input type="submit" value="Profil törlése" name="user_delete" class="remove-button">
       
    </form>
</div>
<?php if ($_SESSION["user"]["admin"] == true) { ?>
    <div>
        <a href="item_change.php" class="button"> Termékek módosítása</a>
    </div>
<?php } ?>


<div class="space"></div>


<footer>
    <p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
        tanítási célból használtuk fel.</i></p>
</footer>
<a href="#" id="up-button"> 👆</a>
</body>
</html>