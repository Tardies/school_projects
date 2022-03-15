<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Poradnia</title>
        <link rel="stylesheet" href="poradnia.css" />
    </head>
    <body>
        <div id="baner"><h1>PORADNIA SPECJALISTYCZNA</h1></div>
        <div id="lewy">
            <h3>LEKARZE SPECJALIŚCI</h3>
            <table>
                <tr>
                    <td colspan="2">Poniedziałek</td>
                </tr>
                <tr>
                    <td>Anna Kowalska</td>
                    <td>otolaryngolog</td>
                </tr>
                <tr>
                    <td colspan="2">Wtorek</td>
                </tr>
                <tr>
                    <td>Jan Nowak</td>
                    <td>kardiolog</td>
                </tr>
            </table> <br />
            <h3>LISTA PACJENTÓW</h3>
            <?php 
                $conn = mysqli_connect('localhost', 'root', '', 'poradnia');
                $polecenie = mysqli_query($conn, 'SELECT id, imie, nazwisko, choroba FROM pacjenci;');
                $il = mysqli_num_rows($polecenie);
                echo "<table>";
                for ($i = 0; $i < $il; $i++)
                {
                    $row = mysqli_fetch_array($polecenie);
                    echo "<tr>"."<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td>"."</tr>";
                }
                echo "</table>";
                $conn -> close();
            ?>
            <br /><br />
            <form method="POST" action="pacjent.php">
                <label>Podaj id: <br /> <input type="number" value="id" id="id" name="id"/></label>
                <input type="submit" value="Pokaż szczegóły" />
            </form>
        </div>
        <div id="prawy">
            <h2>KARTA PACJENTA</h2>
            <?php 
                $id = $_POST['id'];
                $conn = mysqli_connect('localhost', 'root', '', 'poradnia');
                $ask1 = "SELECT imie, nazwisko, leki_przepisane, opis FROM `pacjenci` WHERE id = '$id'";
			$result1 = mysqli_query($conn,$ask1);
			while ($line1=mysqli_fetch_row($result1))
			{
				echo '<p>Imię i Nazwisko: '.$line1[0].' '.$line1[1].'</p>'.'<p>Przepisane leki: '.$line1
				[2].'</p>'.'<p>Opis choroby: '.$line1[3].'</p>';
			}

			mysqli_close($conn);
            ?>
        </div>
        <div id="stopka"><p>utworzone przez: Andrii Shtokalo</p><br /><a href="kwerendy.txt">Kwerendy do pobrania</a></div>
    </body>
</html>