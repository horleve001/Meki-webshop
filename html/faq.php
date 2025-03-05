<?PHP
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kapcsolat</title>
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

<h1 id="title">Gyakori kérdések</h1>

<div class="faq">
    <ul>
        <li class="question"><a href="#answer1"> Mennyire gyors a kiszállítás?</a></li>
        <li id="answer1" class="answer">A rendelés leadást követő 5 percen belül útnak indul futárszolgálatunk.</li>

        <li class="question"><a href="#answer2">Jól lehet lakni 2 szendviccsel?</a></li>
        <li id="answer2" class="answer">Ez függ a szendvicsek méretétől és tartalmától, valamint az egyéni táplálkozási
            igényektől.
        </li>

        <li class="question"><a href="#answer3">Mennyi ideig lehet tárolni a termékeket?</a></li>
        <li id="answer3" class="answer">A termékek tárolási ideje függ a terméktől és a tárolási körülményektől.</li>

        <li class="question"><a href="#answer4">Milyen fizetési módokat fogadunk el?</a></li>
        <li id="answer4" class="answer">Elfogadott fizetési mód: online bankkártyás fizetés.</li>

        <li class="question"><a href="#answer5">Milyen termékeket kínálunk?</a></li>
        <li id="answer5" class="answer">Kínálatunkban megtalálhatóak a hagyományos MekDonáldc termékek.</li>

        <li class="question"><a href="#answer6">Milyen allergéneket tartalmaznak a termékeink?</a></li>
        <li id="answer6" class="answer">Az allergénekről bővebb információt a termékek leírásában találhat.</li>

        <li class="question"><a href="#answer7">Milyen minőségű alapanyagokat használunk?</a></li>
        <li id="answer7" class="answer">Alapanyagainkat a legjobb minőségű beszállítóktól szerezzük be.</li>

        <li class="question"><a href="#answer8">Milyen szállítási díjakat számolunk fel?</a></li>
        <li id="answer8" class="answer">A szállítási díj függ a szállítási címtől és a rendelés összegétől.</li>

        <li class="question"><a href="#answer9">Milyen garanciát vállalunk a termékeinkre?</a></li>
        <li id="answer9" class="answer">Garanciát vállalunk a termékeink minőségére és azok frissességére.</li>

        <li class="question"><a href="#answer10">Milyen módon lehet reklamálni?</a></li>
        <li id="answer10" class="answer">Reklamáció esetén kérjük, vegye fel velünk a kapcsolatot a 20/33955464
            telefonszámon, vagy írjon emailt a mekweb@gmail.com e-mail címre.
        </li>
    </ul>
</div>

<a href="#" id="up-button"> 👆</a>

<footer>
    <p><b>© 2024 MEKweb </b><i>Az adatokat az alábbi <a href="https://www.mcdonalds.com/hu/hu-hu.html" target="_blank">linkről</a>
        tanítási célból használtuk fel.</i></p>
</footer>
<div class="space"></div>

</body>
</html>