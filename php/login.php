<?php
    session_start();
  include "kozos.php";              // a loadUsers() függvény ebben a fájlban van
  $fiokok = loadUsers("users.txt"); // betöltjük a regisztrált felhasználók adatait, és eltároljuk őket a $fiokok változóban

  $uzenet = "";                     // az űrlap feldolgozása után kiírandó üzenet

  if (isset($_POST["login"])) {    // miután az űrlapot elküldték...
    if (!isset($_POST["felhasznalonev"]) || trim($_POST["felhasznalonev"]) === "" || !isset($_POST["jelszo"]) || trim($_POST["jelszo"]) === "") {
      // ha a kötelezően kitöltendő űrlapmezők valamelyike üres, akkor hibaüzenetet jelenítünk meg
      $uzenet = "<strong>Hiba:</strong> Adj meg minden adatot!";
    } else {
      // ha megfelelően kitöltötték az űrlapot, lementjük az űrlapadatokat egy-egy változóba
      $felhasznalonev = $_POST["felhasznalonev"];
      $jelszo = $_POST["jelszo"];

      // bejelentkezés sikerességének ellenőrzése
      $uzenet = "Sikertelen belépés! A belépési adatok nem megfelelők!";  // alapból azt feltételezzük, hogy a bejelentkezés sikertelen

      foreach ($fiokok as $fiok) {              // végigmegyünk a regisztrált felhasználókon
        // a bejelentkezés pontosan akkor sikeres, ha az űrlapon megadott felhasználónév-jelszó páros megegyezik egy regisztrált felhasználó belépési adataival
        // a jelszavakat hash alapján, a password_verify() függvénnyel hasonlítjuk össze
        if ($fiok["felhasznalonev"] === $felhasznalonev && password_verify($jelszo, $fiok["jelszo"])) {
          $uzenet = "Sikeres belépés!";        // ekkor átírjuk a megjelenítendő üzenet szövegét
            $_SESSION["user"] = $fiok;           // a "user" nevű munkamenet-változó a bejelentkezett felhasználót reprezentáló tömböt fogja tárolni
            header("Location: profile.php");       // átirányítás az profile.php oldalra
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <title>Bejelentkezés</title>
    <meta charset="UTF-8"/>
      <link rel="stylesheet" type="text/css" href="../css/kavezo.css">
  </head>
  <body>
  <div class="header">
      <h3>Üdvözöljük a NANO Speciality Coffee oldalán</h3>
  </div>
  <ul>
      <li><a onclick="document.location='Kezdolap.php'">Kezdőoldal</a></li>
      <li><a onclick="document.location='Kaverol.php'" >Kávéinkról</a></li>
      <li><a onclick="document.location='Arlista.php'">Árlista</a></li>
      <li><a onclick="document.location='Elhelyezkedes.php'">Kapcsolat</a></li>
      <li><a onclick="document.location='Asztalfoglalas.php'">Asztalfoglalás</a></li>
      <?php if (isset($_SESSION["user"])) { ?>
          <li><a href="profile.php">Profilom</a></li>
          <li><a href="logout.php">Kijelentkezés</a></li>
      <?php } else { ?>
      <li><a onclick="document.location='signup.php'">Regisztráció</a></li>
      <li><a onclick="document.location='login.php'">Bejelentkezés</a></li>
      <?php } ?>
  </ul>
  <h1>Bejelentkezés</h1>
  <p>Kérjük adja meg a szükséges adatokat a bejelentkezéshez, majd kedvezményekben részesítjük.</p>
  <form class="login" action="login.php" method="POST">
      <label>Felhasználónév: <input type="text" name="felhasznalonev"/></label> <br/>
      <label>Jelszó: <input type="password" name="jelszo"/></label> <br/>
      <input type="submit" name="login"/> <br/><br/>
  </form>
  <?php echo $uzenet . "<br/>"; ?>
  </body>
</html>