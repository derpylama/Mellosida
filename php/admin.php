<?php
$mysqli = new mysqli("localhost", "root", "", "mello");



function getDeltavlingsInfo(){
    global $mysqli;    
    $QueryDeltavling = $mysqli -> prepare("SELECT deltavlingar.id FROM deltavlingar WHERE deltavlingsNamn = ?");

    if(!empty($_GET["deltavling"])){
        $deltavling = $_GET["deltavling"];
    
        $QueryDeltavling -> bind_param("s", $deltavling);
    
        $QueryDeltavling -> execute();
        $deltavlingID = $QueryDeltavling -> get_result() -> fetch_assoc();
        $deltavlingID = $deltavlingID["id"];
    }

    $getInfo = $mysqli -> query("SELECT * FROM bidrag JOIN artist ON artist.id = bidrag.artistID WHERE bidrag.deltavlingID = $deltavlingID");

    while($row = $getInfo -> fetch_assoc())
    {
        print_r($row);
    }

}

getDeltavlingsInfo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <main>
        <section>
            <nav>    
                <form action="" id = "dropDown">
                    <select name="deltavling" id="deltavling">
                        <option value="deltavling1">Deltävling 1</option>
                        <option value="deltavling2">Deltävling 2</option>
                        <option value="deltavling3">Deltävling 3</option>
                        <option value="deltavling4">Deltävling 4</option>
                    </select>
                    <input type="submit" name="" class = "submit">
                </form>
            </nav>

        
            <label for="LaggtillDeltagare">Lägg till deltagare</label>
            <form action="" id = "LaggtillDeltagare">
                <label for="ArtistNamn">Artist</label>
                <input type="text" name="" id="ArtistNamn">
                <label for="latnamn">Låt namn</label>
                <input type="text" name="" id="Latnamn">
                <label for="Latskrivare">Låtskrivare</label>
                <input type="text" name="" id="Latskrivare">
                <label for="URL">Youtube URL</label>
                <input type="text" name="" id="URL">
                <label for="Beskrivning">Beskrivning</label>
                <input type="text" name="" id="Beskrivning">

                <input type="submit" name="" class = "submit">
            </form>
        </section >

        <section id ="deltagarLista">

        </section>


    </main>
</body>
</html>