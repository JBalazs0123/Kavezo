<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Asztalfoglalás</title>
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
<h1>Asztalfoglalás</h1>
<p>Kérjük adja meg a szükséges adatokat az asztalfoglaláshoz.</p>
<main>
    <form method="get" enctype="application/x-www-form-urlencoded">
        <fieldset>
            <label>Név: <input type="text" name="name" size="25" required></label><br/>
            <label>Email: <input type="email" name="email" size="30" required></label><br>
            <label>Érkező vendégek száma: <input type="number" name="fo" required></label><br>
            <label>Dátum és időpont: <input type="datetime-local" name="date-time" required></label><br/>
            <label>Telefonszám: <input type="tel" name="tel"></label><br/>
            <label for="moreInformation">Egyéb információk: </label><br>
            <textarea id="moreInformation" name="info" rows="7" cols="36" maxlength="300" placeholder="Megjegyzés (max. 300 karakter)!"></textarea><br>
            <input type="reset" name="reset-btn" value="Adatok törlése"/>
            <input type="submit" name="submit-btn" value="Adatok elküldése"/>
        </fieldset>
    </form>
</main>
</body>
</html>