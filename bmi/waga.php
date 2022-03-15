<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Twój wskaźnik BMI</title>
        <style>
            #baner {
                background-color: #4B0082;
                color: white;
                text-align: center;
                width: 75%;
                height: 100px;
                font-size: 150%;
                float: left;
            }
            #logo {
                width: 25%;
                height: 100px;
                float: left;
                text-align: center;
                background-color: #FFE4B5;
            }
            #rys {
                width: 375px;
                height: 300px;
            }
            #lewy {
                width: 45%;
                height: 300px;
                float: left;
                background-color: #FFE4B5;
            }
            #prawy {
                width: 55%;
                height: 300px;
                text-align: center;
                float: left;
                background-color: #FFE4B5;
            }
            #glowny {
                background-color: #4B0082;
                padding: 60px;
            }
            #stopka {
                background-color: #4B0082;
                color: white;
                padding: 40px;
            }
            body {
                font-family: Helvetica, sans-serif;
                background-color: #FFE4B5;
            }
            form {
                margin: 40px;
            }
            table {
                color: white;
                text-align: center;
                width: 90%;
                border: 1px dashed yellow;
            }
            tr:hover {
                background-color: #9370DB;
                color: yellow;
            }
        </style>
    </head>
    <body>
        <div id="baner"><h2>Oblicz wskaźnik BMI</h2></div>
        <div id="logo"><img src="wzor.png" alt="liczymy BMI"/></div>
        <div id="lewy"><img id="rys" src="rys.png" alt="zrzuć kalorie!" /></div>
        <div id="prawy">
            <h2>Podaj wagę i wzrost</h2>
            <form method="post">
                Waga:<input type="number" min="1" name="waga"><br>
                Wzrost w cm:<input type="number" min="1" name="wzrost"><br>
                <button type="submit">Oblicz i zapamietaj wynik</button><br>
                <?php
                $db = new mysqli('localhost', 'root', '', 'egzamin');
                if(isset($_POST['waga']) && isset($_POST['wzrost'])) {
                    $waga = $_POST['waga'];
                    $wzrost = $_POST['wzrost'];
                    $bmi = $waga / ($wzrost * $wzrost);
                    $bmi *= 10000;
                    echo "Twoja waga: $waga; Twój wzrost: $wzrost <br> BMI wynosi: $bmi";
                    $bmi_id = 0;
                    if($bmi <= 18) $bmi_id = 1;
                    if($bmi > 19 && $bmi <= 25) $bmi_id = 2;
                    if($bmi > 26 && $bmi <= 30) $bmi_id = 3;
                    if($bmi > 31 && $bmi <= 100) $bmi_id = 4;

                    $dataPomiaru = date("Y-m-d");

                    $query = $db->prepare("INSERT INTO wynik (id, bmi_id, data_pomiaru, wynik) 
                                            VALUES (NULL, ?, ?, ?)");
                    $query->bind_param("isi", $bmi_id, $dataPomiaru, $bmi);
                    $query->execute();
                    $db -> close();
                }

                ?>
            </form>
        </div>
        <div id="glowny">
            <table>
                <tr>
                    <th>lp.</th>
                    <th>Interpretacja</th>
                    <th>zaczyna się od...</th>
                </tr>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'egzamin');
                    $z1 = mysqli_query($conn, "SELECT id, informacja, wart_min FROM bmi;");
                    $il = mysqli_num_rows($z1);
                    for($i = 0; $i < $il; $i++) {
                        $row = mysqli_fetch_array($z1);
                        echo "<tr>"."<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
                    }
                    $conn -> close();
                ?>
            </table>
        </div>
        <div id="stopka">
            Autor: Andrii Shtokalo<br />
            <a href="kw2.jpg">Wynik działania kwerendy 2</a>
        </div>
    </body>
</html>