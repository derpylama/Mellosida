<?php
$mysqli = new mysqli("bushcan.ntigskovde.se", "ntigskov_bushcan", "U8Tv5U9MMr2uaEzQ6A91", "ntigskov_bushcan");




$loginQuery = $mysqli -> prepare("SELECT * FROM admininlogg WHERE losenord = ? AND anvandarnamn = ?");

if(!empty($_POST)){
    if(!empty($_POST["losenord"] && !empty($_POST["anvandarnamn"]))){
        $username = $_POST["anvandarnamn"];
        $password = $_POST["losenord"];
    }
}

$loginQuery -> bind_param("ss", $username, $password);
$loginQuery -> execute();

$result = $loginQuery -> get_result() -> fetch_assoc();

if(empty($result)){
    header("Location:php/admininlogg.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/admin.js"></script>
    <link rel="icon" href="MelloLogga.png">
</head>
<body>
    <main>
        <section>
            <nav>    
                <select id="deltavling">
                    <option value="deltavling1">Deltävling 1</option>
                    <option value="deltavling2">Deltävling 2</option>
                    <option value="deltavling3">Deltävling 3</option>
                    <option value="deltavling4">Deltävling 4</option>
                    <option value="final">Final</option>
                </select>
                <form id="DateTime" method = "post">
                    

                    <label for="datum">Välj datum och tid för denna deltävling</label>
                    <input type="date" name="datum" id = "datum">

                    <label for="startTid">Välj start tid</label>
                    <input type="time" name = "startTid" id = "startTid">

                    <label for="slutTid">Välj slut tid</label>
                    <input type="time" name = "slutTid" id="slutTid">

                    <input type="hidden" name="anvandarnamn" value="<?php echo $_POST["anvandarnamn"] ?>">
                    <input type="hidden" name="losenord" value="<?php echo $_POST["losenord"] ?>">

                    <input type="button" class="submit save" value="Spara">
                </form>
            </nav>

        
            <label for="LaggtillDeltagare">Lägg till deltagare</label>
            <form action="" id = "LaggtillDeltagare" method = "post">
                <label for="ArtistNamn">Artist</label>
                <input type="text" name="artistNamn" id="ArtistNamn">
                <label for="latNamn">Låt namn</label>
                <input type="text" name="latNamn" id="LatNamn">
                <label for="Latskrivare">Låtskrivare</label>
                <input type="text" name="latskrivare" id="Latskrivare">
                <label for="YtURL">Youtube URL</label>
                <input type="text" name="ytURL" id="YtURL">
                <label for="Beskrivning">Beskrivning</label>
                <input type="text" name="beskrivning" id="Beskrivning">
                <label for="BildUrl">Bild URL</label>
                <input type="text" name="bildURL" id="BildURL">

                <input type="hidden" name="anvandarnamn" value="<?php echo $_POST["anvandarnamn"] ?>">
                <input type="hidden" name="losenord" value="<?php echo $_POST["losenord"] ?>">

                <input type="button" class ="submit save" value="Spara">
                <input type="button" class="submit" value="Populera final" id="populate">
            </form>
        </section >

        <section id ="deltagarLista">
            
        </section>


    </main>
</body>
</html>