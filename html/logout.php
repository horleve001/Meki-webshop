<?php
  session_start();
  if(isset($_POST["logout"])){
    session_destroy();
    header("Location: login.php");
  }
  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
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

  <div>
    <?php if (!isset($_SESSION["user"])) { ?>
      <h1> Sikeres Fiók törlés! </h1>
    <?php } else{ ?> 
    <h1> Biztosan ki szeretnél jelentkezni? </h1>
    <div>
      <form action="logout.php" method="POST" class="forms">
        <button type="submit" name="logout" class="remove-button">Igen</button>
      </form>
    </div>
    <?php } ?>
  </div>
<a href="#" id="up-button"> 👆</a>
</body>
</html>