<?php
$mysqli = new mysqli("localhost", "root", "", "mello");

require "funktioner.php";


$loginQuery = $mysqli -> prepare("SELECT * FROM admininlogg WHERE losenord = ? AND anvandarnamn = ?");

if(!empty($_POST)){
    if(!empty($_POST["anvandarnamn"] && !empty($_POST["losenord"]))){
        $username = $_POST["anvandarnamn"];
        $password = $_POST["losenord"];
    }
}

$loginQuery -> bind_param("ss", $username, $password);
$loginQuery -> execute();

$result = $loginQuery -> get_result() -> fetch_assoc();

if(empty($result)){
    header("Location: admininlogg.php");
    exit();
}

function saveAllData(){
    global $mysqli;
    
    $deltavlingsNamn = getDeltavlingsInfo("deltavling");
    
    $saveArtist = $mysqli -> prepare("INSERT INTO artist (`namn`, `beskrivning`, `bildURL`) VALUES ( ?, ?, ?)");
    $saveBidrag = $mysqli -> prepare("INSERT INTO `bidrag`(`låtNamn`, `url`, `låtskrivare`, `artistNamn`) VALUES ( ?, ?, ?, ?)");
    $saveJoin = $mysqli -> prepare("INSERT INTO `bidragdeltavlingjoin`(`deltavlingNamnJoin`, `artistNamnJoin`) VALUES ( ?, ?)");
    $saveTidochDatum = $mysqli -> prepare("UPDATE `deltavlingar` SET `startTid`= ?,`slutTid`= ? ,`datum`= ? WHERE deltavlingsNamn = '$deltavlingsNamn'");

    
    if(!empty($_POST)){
        if(!empty($_POST["artistNamn"]) && !empty($_POST["beskrivning"]) && !empty($_POST["bildURL"]) && !empty($_POST["latNamn"] && !empty($_POST["latskrivare"]) && !empty($_POST["ytURL"]))){
            $artistNamn = $_POST["artistNamn"];
            $beskrivning = $_POST["beskrivning"];
            $bildURL = $_POST["bildURL"];
            
            
            $saveArtist -> bind_param("sss", $artistNamn, $beskrivning, $bildURL);
            $saveArtist -> execute();            

            $latNamn = $_POST["latNamn"];
            $ytURL = $_POST["ytURL"];
            $latskrivare = $_POST["latskrivare"];
            

            $saveBidrag -> bind_param("ssss", $latNamn, $ytURL, $latskrivare, $artistNamn);
            $saveBidrag -> execute();
            

            $saveJoin -> bind_param("ss", $deltavlingsNamn, $artistNamn);
            $saveJoin -> execute();


        }
    }

    if(!empty($_GET)){
        if(!empty($_GET["datum"] && !empty($_GET["startTid"] && !empty($_GET["slutTid"])))){
            $datum = $_GET["datum"];
            $startTid = $_GET["startTid"];
            $slutTid = $_GET["slutTid"];

            $saveTidochDatum -> bind_param("sss", $startTid, $slutTid, $datum);
            $saveTidochDatum -> execute();
        }
    }


}

saveAllData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/admin.js"></script>
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
                </select>
                <form action="" id = "dropDown" method = "get">
                    

                    <label for="datum">Välj datum och tid för denna deltävling</label>
                    <input type="date" name="datum" id = "datum">

                    <label for="startTid">Välj start tid</label>
                    <input type="time" name = "startTid" id = "startTid">

                    <label for="slutTid">Välj slut tid</label>
                    <input type="time" name = "slutTid">
                    <input type="submit" name="" class = "submit">
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
                <input type="text" name ="bildURL" id = "BildURL">

                <input type="submit" name="" class = "submit">
            </form>
        </section >

        <section id ="deltagarLista">
            
        </section>


    </main>
</body>
</html>