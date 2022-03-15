<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Dodaj ogłoszenie</title>
        <link rel="stylesheet" href="styl3.css" />
    </head>
    <body>
        <div id="baner">
            <h2>Portal Ogłoszeniowy</h2>
        </div>
        <div id="lewy">
            <h2>Kategorie</h2>
            <ol>
                <li>Książki</li>
                <li>Muzyka</li>
                <li>Filmy</li>
            </ol> <br />
            <h2>Podkategorie</h2>
            <ol>
                <li>Romans</li>
                <li>Biografia</li>
                <li>Kryminał</li>
                <li>Komiks</li>
            </ol>
            <img src="ksiazki.jpg" /><br />
            <a id="link" href="kwerendy.txt">Pobierz kwerendy</a>
        </div>
        <div id="prawy">
            <h2>Anna Kowalska — dodanie ogłoszenia</h2>
            <form method="POST">
                <label>Kateforia: <br /><input type="number" name="kategoria"/></label><br />
                <label>Podkategoria: <br /><input type="number" name="podkategoria" /></label><br />
                <label>Tytuł: <br /><input type="text" name="tytul" /></label><br />
                <label>Treść: <br /><textarea name="tresc" cols="40" rows="10" id="text-field"></textarea></label><br />
                <input id="przycisk" type="reset" value="WYCZYŚĆ" /><input id="przycisk" type="submit" value="ZAPISZ" />
            </form>
            <?php 
                $conn = mysqli_connect("localhost", "root", "", "ogloszenia");
                if($conn && isset($_POST)){
                    $stm = $conn -> prepare("INSERT INTO ogloszenie VALUES (NULL, '1', ?, ?, ?, ?);");
                    $stm -> bind_param('ssss', $_POST["kategoria"], $_POST["podkategoria"], $_POST["tytul"], $_POST["tresc"]);
                    $stm -> execute();
                }
                $conn -> close();
            ?>
        </div>
        <div id="stopka">
            <p>Portal ogłoszeniowy opracował: Andrii Shtokalo</p>
        </div>
    </body>
</html>