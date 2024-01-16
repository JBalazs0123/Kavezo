<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Árlista</title>
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
<aside>
    <img style="position: absolute; top: 300px; left: 10px" src="../img/presszo.jpg" alt="Presszó kávé" title="Espresso" height="200"/>
    <img style="position: absolute; top: 550px; left: 10px" src="../img/cappuccino.jpg" alt="Cappucino" title="Cappucino" height="200"/>
    <img style="position: absolute; top: 550px; right: 10px" src="../img/melange.jpg" alt="Melange" title="Melange" height="200"/>
    <img style="position: absolute; top: 300px; right: 10px" src="../img/americano.jpg" alt="Iced-americano" title="Iced-americano" height="200"/>
    <img style="position: absolute; top: 800px; right: 10px" src="../img/hotchocolate.jpg" alt="Forró csoki" title="Forró csoki" height="200"/>
    <img style="position: absolute; top: 800px; left: 10px" src="../img/tea.jpg" alt="Gyümölcs tea" title="Gyümölcs tea" height="200"/>
</aside>
<main>
    <table>
        <caption>Árlistánk</caption>
        <thead>
        <tr>
            <th id="nev">Kávék</th>
        </tr>
        </thead>
    <tbody>
    <tr>
        <td headers="nev">Espresso</td>
        <td>490 Ft</td>
    </tr>
    <tr>
        <td headers="nev">Ristretto</td>
        <td>440 Ft</td>
    </tr>
    <tr>
        <td headers="nev">Hosszú kávé</td>
        <td>590 Ft</td>
    </tr>
    <tr>
        <td headers="nev">Americano</td>
        <td>590 Ft</td>
    </tr>
    <tr>
        <td headers="nev">Cappuccino</td>
        <td>690 Ft</td>
    </tr>
    <tr>
        <td headers="nev">Latte Macchiato</td>
        <td>690 Ft</td>
    </tr>
    <tr>
        <td headers="nev">Melange</td>
        <td>790 Ft</td>
    </tr>
    </tbody>
    </table>
    <table>
        <thead>
        <tr>
            <th id="extra">Extrák a kávéhoz</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td headers="extra">Laktózmentes tej</td>
            <td>200 Ft</td>
        </tr>
        <tr>
            <td headers="extra">Rizs/mandula/kókusz tej</td>
            <td>250 Ft</td>
        </tr>
        <tr>
            <td headers="extra">Méz</td>
            <td>100 Ft</td>
        </tr>
        <tr>
            <td headers="extra">Papír pohár</td>
            <td>50 Ft</td>
        </tr>
        </tbody>
    </table>
    <table>
        <thead>
        <tr>
        <th id="forro">Forró italok</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td headers="forro">Forró csoki</td>
            <td>690 Ft</td>
        </tr>
        <tr>
            <td headers="forro">Gyümölcs tea</td>
            <td>590 Ft</td>
        </tr>
        </tbody>
    </table>
        <table>
        <thead>
        <tr>
            <th id="italok">Üditők</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td headers="italok">Pepsi</td>
            <td>390 Ft</td>
        </tr>
        <tr>
            <td headers="italok">Pepsi Max</td>
            <td>390 Ft</td>
        </tr>
        <tr>
            <td headers="italok">Schweppes orange</td>
            <td>390 Ft</td>
        </tr>
        <tr>
            <td headers="italok">Schweppes citrus</td>
            <td>390 Ft</td>
        </tr>
        <tr>
            <td headers="italok">Canada Dry</td>
            <td>390 Ft</td>
        </tr>
        <tr>
            <td headers="italok">Cappy gyümölcslevek</td>
            <td>390 Ft</td>
        </tr>
        </tbody>
    </table>
</main>
</body>
</html>