<?php
    include "kozos.php";              // beágyazzuk a loadUsers() és saveUsers() függvényeket tartalmazó PHP fájlt
    $fiokok = loadUsers("users.txt"); // betöltjük a regisztrált felhasználók adatait, és eltároljuk őket a $fiokok változóban

  // az űrlapfeldolgozás során keletkező hibákat ebbe a tömbbe fogjuk gyűjteni
  $hibak = [];

  // űrlapfeldolgozás

  if (isset($_POST["regiszt"])) {   // ha az űrlapot elküldték...
    // a kötelezően kitöltendő mezők ellenőrzése
    if (!isset($_POST["felhasznalonev"]) || trim($_POST["felhasznalonev"]) === "")
      $hibak[] = "A felhasználónév megadása kötelező!";

    if (!isset($_POST["jelszo"]) || trim($_POST["jelszo"]) === "" || !isset($_POST["jelszo2"]) || trim($_POST["jelszo2"]) === "")
      $hibak[] = "A jelszó és az ellenőrző jelszó megadása kötelező!";

    if (!isset($_POST["eletkor"]) || trim($_POST["eletkor"]) === "")
      $hibak[] = "Az életkor megadása kötelező!";

    if (!isset($_POST["nem"]) || trim($_POST["nem"]) === "")
      $hibak[] = "A nem megadása kötelező!";

    // legalább 2 kavet kötelező kiválasztani
    if (!isset($_POST["kavek"]) || count($_POST["kavek"]) < 2)
      $hibak[] = "Legalább 2 kávét kötelező kiválasztani!";

    // űrlapadatok lementése változókba
    $felhasznalonev = $_POST["felhasznalonev"];
    $jelszo = $_POST["jelszo"];
    $jelszo2 = $_POST["jelszo2"];
    $eletkor = $_POST["eletkor"];
    $nem = NULL;
    $kavek = NULL;

    if (isset($_POST["nem"]))           // csak akkor kérjük le a nemet, ha megadták
      $nem = $_POST["nem"];
    if (isset($_POST["kavek"]))        // csak akkor kérjük le a hobbikat, ha megadták
      $kavek = $_POST["kavek"];       // (ez egy tömb lesz)

    // foglalt felhasználónév ellenőrzése
    foreach ($fiokok as $fiok) {
      if ($fiok["felhasznalonev"] === $felhasznalonev)  // ha egy regisztrált felhasználó neve megegyezik az űrlapon megadott névvel...
        $hibak[] = "A felhasználónév már foglalt!";
    }

    // túl rövid jelszó
    if (strlen($jelszo) < 5)
      $hibak[] = "A jelszónak legalább 5 karakter hosszúnak kell lennie!";

    // a két jelszó nem egyezik
    if ($jelszo !== $jelszo2)
      $hibak[] = "A jelszó és az ellenőrző jelszó nem egyezik!";

    // 18 év alatti életkor
    if ($eletkor < 14)
      $hibak[] = "Csak 14 éves kortól lehet regisztrálni!";

    // regisztráció sikerességének ellenőrzése
    if (count($hibak) === 0) {   // ha nem történt hiba a regisztráció során, hozzáadjuk az újonnan regisztrált felhasználót a $fiokok tömbhöz
        $jelszo = password_hash($jelszo, PASSWORD_DEFAULT);       // jelszó hashelése
        // hozzáfűzzük az újonnan regisztrált felhasználó adatait a rendszer által ismert felhasználókat tároló tömbhöz
        $fiokok[] = ["felhasznalonev" => $felhasznalonev, "jelszo" => $jelszo, "eletkor" => $eletkor, "nem" => $nem, "kavek" => $kavek];
        // elmentjük a kibővített $fiokok tömböt a users.txt fájlba
        saveUsers("users.txt", $fiokok);
        $siker = TRUE;
    } else {                    // ha voltak hibák, akkor a regisztráció sikertelen
      $siker = FALSE;
    }
  }
?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <title>Regisztráció</title>
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
      <li><a onclick="document.location='signup.php'">Regisztráció</a></li>
      <li><a onclick="document.location='login.php'">Bejelentkezés</a></li>
  </ul>
  <h1>Regisztráció</h1>
  <p>Kérjük adja meg a szükséges adatokat a regisztrációhoz, majd kedvezményekben részesítjük.</p>
  
    <form action="signup.php" method="POST">
      <label>Felhasználónév: <input type="text" name="felhasznalonev" value="<?php if (isset($_POST['felhasznalonev'])) echo $_POST['felhasznalonev']; ?>"/></label> <br/>
      <label>Jelszó: <input type="password" name="jelszo"/></label> <br/>
      <label>Jelszó ismét: <input type="password" name="jelszo2"/></label> <br/>
      <label>Életkor: <input type="number" name="eletkor" value="<?php if (isset($_POST['eletkor'])) echo $_POST['eletkor']; ?>"/></label> <br/>
      Nem:
      <label><input type="radio" name="nem" value="F" <?php if (isset($_POST['nem']) && $_POST['nem'] === 'F') echo 'checked'; ?>/> Férfi</label>
      <label><input type="radio" name="nem" value="N" <?php if (isset($_POST['nem']) && $_POST['nem'] === 'N') echo 'checked'; ?>/> Nő</label>
      <label><input type="radio" name="nem" value="E" <?php if (isset($_POST['nem']) && $_POST['nem'] === 'E') echo 'checked'; ?>/> Egyéb</label> <br/>
      Kávék:
      <label><input type="checkbox" name="kavek[]" value="espresso" <?php if (isset($_POST['kavek']) && in_array('espresso', $_POST['kavek'])) echo 'checked'; ?>/> espresso</label>
      <label><input type="checkbox" name="kavek[]" value="latte" <?php if (isset($_POST['kavek']) && in_array('latte', $_POST['kavek'])) echo 'checked'; ?>/> latte</label>
      <label><input type="checkbox" name="kavek[]" value="melange" <?php if (isset($_POST['kavek']) && in_array('melange', $_POST['kavek'])) echo 'checked'; ?>/> melange</label>
      <label><input type="checkbox" name="kavek[]" value="cappucino" <?php if (isset($_POST['kavek']) && in_array('cappucino', $_POST['kavek'])) echo 'checked'; ?>/> cappucino</label>
      <label><input type="checkbox" name="kavek[]" value="ristretto" <?php if (isset($_POST['kavek']) && in_array('ristretto', $_POST['kavek'])) echo 'checked'; ?>/> ristretto</label> <br/>
      <input type="submit" name="regiszt" value="Regisztráció"/> <br/><br/>
    </form>
    <?php
      if (isset($siker) && $siker === TRUE) {  // ha nem volt hiba, akkor a regisztráció sikeres
        echo "<p>Sikeres regisztráció!</p>";
      } else {                                // az esetleges hibákat kiírjuk egy-egy bekezdésben
        foreach ($hibak as $hiba) {
          echo "<p>" . $hiba . "</p>";
        }
      }
    ?>
  </body>
</html>