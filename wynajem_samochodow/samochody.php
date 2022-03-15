<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8' />
        <title>Wynajmujemy samochody</title>
        <link rel="stylesheet" href="styl.css" />
    </head>
    <body>
        <div id="baner">
            <h1>Wynajem samochodów</h1>
        </div>
        <div id="lewy">
            <h2>DZIŚ POLECAMY TOYOTĘ ROCZNIK 2014</h2>
            <form>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'wynajem');
                    $z1 = mysqli_query($conn, 'SELECT id, marka, model, kolor FROM samochody WHERE marka = "Toyota" AND rocznik = "2014";');
                    $il = mysqli_num_rows($z1);
                    echo "<table>";
                    for($i = 0; $i < $il; $i++) {
                        $row = mysqli_fetch_array($z1);
                        echo "<tr>"."<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>Kolor: ".$row[3]."</td></tr>";
                    }
                    echo "</table>";
                    $conn -> close();
                ?>
            </form>
            <h2>WSZYSTKIE DOSTĘPNE SAMOCHODY</h2>
            <form>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'wynajem');
                    $z1 = mysqli_query($conn, 'SELECT id, marka, model, rocznik FROM samochody;');
                    $il = mysqli_num_rows($z1);
                    echo "<table>";
                    for ($i = 0; $i < $il; $i++) {
                        $row = mysqli_fetch_array($z1);
                        echo "<tr>"."<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
                    }
                    echo "</table>";
                    $conn -> close();
                ?>    
            </form>
        </div>
        <div id="srodkowy">
            <h2>ZAMÓWIONE AUTA Z NUMERAMI TELEFONÓW KLIENTÓW</h2>
            <form>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'wynajem');
                    $z1 = mysqli_query($conn, 'SELECT zamowienia.Samochody_id, samochody.model, zamowienia.telefon FROM zamowienia, samochody WHERE zamowienia.Samochody_id = samochody.id;');
                    $il = mysqli_num_rows($z1);
                    echo "<table>";
                    for ($i = 0; $i < $il; $i++) {
                        $row = mysqli_fetch_array($z1);
                        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
                    }
                    echo "</table>";
                    $conn -> close();
                ?>
            </form>
        </div>
        <div id="prawy">
            <h2>NASZA OFERTA</h2>
            <ul>
                <li>Fiat</li>
                <li>Toyota</li>
                <li>Opel</li>
                <li>Mercedes</li>
            </ul>
            <p>Tu pobierzesz naszą <a id="" href="komis.sql">bazę danych</a></p>
            <p>autor strony: Andrii Shtokalo</p>
        </div>
    </body>
</html>