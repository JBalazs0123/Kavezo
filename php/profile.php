<?php
  session_start();
include "kozos.php";

  if (!isset($_SESSION["user"])) {
  	// ha a felhasználó nincs belépve (azaz a "user" munkamenet-változó értéke nem került korábban beállításra), akkor a login.php-ra navigálunk
  	header("Location: login.php");
  }

  function nemet_konvertal($betujel) {		// egy segédfüggvény, amely visszaadja a betűjelnek megfelelő nemet
  	switch ($betujel) {
  		case "F" : return "férfi"; break;
  		case "N" : return "nő"; break;
  		case "E" : return "egyéb"; break;
  	}
  }
?>

<!DOCTYPE html>
<html lang="hu">
  <head>
    <title>Profilom</title>
    <meta charset="UTF-8"/>
      <link rel="stylesheet" type="text/css" href="../css/kavezo.css">
  </head>
  <body>
  <div class="header">
      <h3>Üdvözöljük a NANO Speciality Coffee oldalán</h3>
  </div>
    <main>
      <nav>
        <ul>
            <li><a onclick="document.location='Kezdolap.php'">Kezdőoldal</a></li>
            <li><a onclick="document.location='Kaverol.php'" >Kávéinkról</a></li>
            <li><a onclick="document.location='Arlista.php'">Árlista</a></li>
            <li><a onclick="document.location='Elhelyezkedes.php'">Kapcsolat</a></li>
            <li><a onclick="document.location='Asztalfoglalas.php'">Asztalfoglalás</a></li>
          <?php if (isset($_SESSION["user"])) { ?>
            <li class="active"><a href="profile.php">Profilom</a></li>
            <li><a href="logout.php">Kijelentkezés</a></li>
          <?php } else { ?>
              <li><a onclick="document.location='signup.php'">Regisztráció</a></li>
              <li><a onclick="document.location='login.php'">Bejelentkezés</a></li>
          <?php } ?>
        </ul>
      </nav>

        <section id="content">
            <h2>Profilom</h2>
            <hr/>

            <?php
            // a profilkép elérési útvonalának eltárolása egy változóban

            $profilkep = "images/default.png";      // alapértelmezett kép, amit akkor jelenítünk meg, ha valakinek nincs feltöltött profilképe
            $utvonal = "images/" . $_SESSION["user"]["felhasznalonev"]; // a kép neve a felhasználó nevével egyezik meg

            $kiterjesztesek = ["png", "jpg", "jpeg"];     // a lehetséges kiterjesztések, amivel egy profilkép rendelkezhet

            foreach ($kiterjesztesek as $kiterjesztes) {  // minden kiterjesztésre megnézzük, hogy létezik-e adott kiterjesztéssel profilképe a felhasználónak
                if (file_exists($utvonal . "." . $kiterjesztes)) {
                    $profilkep = $utvonal . "." . $kiterjesztes;  // ha megtaláltuk a felhasználó profilképét, eltároljuk annak az elérési útvonalát egy változóban
                }
            }
            ?>

            <table class="profile-data">
                <tr>
                    <th colspan="2">
                        <img src="<?php echo $profilkep; ?>" alt="Profilkép" height="200"/>
                        <?php if ($_SESSION["user"]["felhasznalonev"] !== "default") { /* a "default" nevű példa felhasználó esetén ne engedélyezzük a profilkép módosítását */ ?>
                            <form action="profile.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="profile-pic" accept="image/*"/>
                                <input type="submit" name="upload-btn" value="Profilkép módosítása"/>
                            </form>
                        <?php } ?>
                    </th>
                </tr>
                <tr>
                    <th>Felhasználónév:</th>
                    <td><?php echo $_SESSION["user"]["felhasznalonev"]; ?></td>
                </tr>
                <tr>
                    <th>Életkor:</th>
                    <td><?php echo $_SESSION["user"]["eletkor"]; ?></td>
                </tr>
                <tr>
                    <th>Nem:</th>
                    <td><?php echo nemet_konvertal($_SESSION["user"]["nem"]); ?></td>
                </tr>
                <tr>
                    <th>Kávek:</th>
                    <td><?php echo implode(", ", $_SESSION["user"]["kavek"]); ?></td>
                </tr>
            </table>

            <?php
            // a profilkép módosítását elvégző PHP kód

            if (isset($_POST["upload-btn"]) && is_uploaded_file($_FILES["profile-pic"]["tmp_name"])) {  // ha töltöttek fel fájlt...
                $fajlfeltoltes_hiba = "";                                       // változó a fájlfeltöltés során adódó esetleges hibaüzenet tárolására
                uploadProfilePicture($_SESSION["user"]["felhasznalonev"]);      // a kozos.php-ban definiált profilkép feltöltést végző függvény meghívása

                $kit = strtolower(pathinfo($_FILES["profile-pic"]["name"], PATHINFO_EXTENSION));    // a feltöltött profilkép kiterjesztése
                $utvonal = "images/" . $_SESSION["user"]["felhasznalonev"] . "." . $kit;            // a feltöltött profilkép teljes elérési útvonala

                // ha nem volt hiba a fájlfeltöltés során, akkor töröljük a régi profilképet, egyébként pedig kiírjuk a fájlfeltöltés során adódó hibát

                if ($fajlfeltoltes_hiba === "") {
                    if ($utvonal !== $profilkep && $profilkep !== "images/default.png") {   // az ugyanolyan névvel feltöltött képet és a default.png-t nem töröljük
                        unlink($profilkep);                         // régi profilkép törlése
                    }

                    header("Location: profile.php");              // weboldal újratöltése
                } else {
                    echo "<p>" . $fajlfeltoltes_hiba . "</p>";
                }
            }
            ?>
        </section>
            
        
    </main>
  </body>
</html>