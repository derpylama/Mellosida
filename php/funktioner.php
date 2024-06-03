<?php
$mysqli = new mysqli("bushcan.ntigskovde.se", "ntigskov_bushcan", "U8Tv5U9MMr2uaEzQ6A91", "ntigskov_bushcan");



if(isset($_GET["deltavling"])){
    getDeltavlingsInfo();
}

if(isset($_GET["data"])){
    saveAllData();
}

if(isset($_GET["delete"])){
    deleteDeltagare();
}

if(isset($_GET["artist"])){
    increaseVotes();
}

if(isset($_GET["tid"])){
    getAllDeltavlingTid();
}

if(isset($_GET["finalist"])){
    populateFinal();
};
//Hämtar ur all information från databasen, Kan ge både deltävlings id som svar eller all data.
function getDeltavlingsInfo(){
    global $mysqli; 
    
    
    if(!empty($_GET["deltavling"])){
        $deltavling = $_GET["deltavling"];
    
    }
    else{
        $deltavling = "deltavling1";
    }
    

    $getInfo = $mysqli -> query("SELECT * FROM artist JOIN bidragdeltavlingjoin ON artist.namn = bidragdeltavlingjoin.artistNamnJoin JOIN deltavlingar ON bidragdeltavlingjoin.deltavlingNamnJoin = deltavlingar.deltavlingsNamn JOIN bidrag ON artist.namn = bidrag.artistNamn WHERE deltavlingar.deltavlingsNamn = '$deltavling'");

    
    
    echo json_encode($getInfo -> fetch_all(MYSQLI_ASSOC));
        
    


}

//Sparar ner all data till databasen
function saveAllData(){
    global $mysqli;
    
    $data = json_decode($_GET["data"]);
    
    $deltavling = $data -> deltavling;
    
    
    $saveArtist = $mysqli -> prepare("INSERT INTO artist (`namn`, `beskrivning`, `bildURL`) VALUES ( ?, ?, ?)");
    $saveBidrag = $mysqli -> prepare("INSERT INTO `bidrag`(`låtNamn`, `url`, `låtskrivare`, `artistNamn`) VALUES ( ?, ?, ?, ?)");
    $saveJoin = $mysqli -> prepare("INSERT INTO `bidragdeltavlingjoin`(`deltavlingNamnJoin`, `artistNamnJoin`) VALUES ( ?, ?)");
    $saveTidochDatum = $mysqli -> prepare("UPDATE `deltavlingar` SET `startTid`= ?,`slutTid`= ? ,`datum`= ? WHERE deltavlingsNamn = '$deltavling'");

    
    
    if(!empty($data -> artistNamn) && !empty($data -> beskrivning) && !empty($data -> bildURL) && !empty($data -> latNamn && !empty($data -> latskrivare) && !empty($data -> ytURL))){
        $artistNamn = $data -> artistNamn;
        $beskrivning = $data -> beskrivning;
        $bildURL = $data -> bildURL;
            
            
        $saveArtist -> bind_param("sss", $artistNamn, $beskrivning, $bildURL);
        $saveArtist -> execute();            

        $latNamn = $data -> latNamn;
        $ytURL = $data -> ytURL;
        $latskrivare = $data -> latskrivare;
            

        $saveBidrag -> bind_param("ssss", $latNamn, $ytURL, $latskrivare, $artistNamn);
        $saveBidrag -> execute();
            

        $saveJoin -> bind_param("ss", $deltavling, $artistNamn);
        $saveJoin -> execute();


    }
    

    
    if(!empty($data -> datum) && !empty($data -> startTid) && !empty($data -> slutTid)){
        $datum = $data -> datum;
        $startTid = $data -> startTid;
        $slutTid = $data -> slutTid;

        $saveTidochDatum -> bind_param("sss", $startTid, $slutTid, $datum);
        $saveTidochDatum -> execute();
    }
    


}

//Tarbort deltagare från databasen
function deleteDeltagare (){
    global $mysqli;
    $artist = $_GET["delete"];

    $mysqli -> query("DELETE FROM `artist` WHERE namn = '$artist'");
    $mysqli -> query("DELETE FROM `bidrag` WHERE artistNamn = '$artist'");
    $mysqli -> query("DELETE FROM `bidragdeltavlingjoin` WHERE artistNamnJoin = '$artist'");
}

function increaseVotes(){
    global $mysqli;

    $artist = $_GET["artist"];

    $votes = $mysqli -> query("SELECT roster FROM bidrag WHERE artistNamn = '$artist'");
    $votes = $votes -> fetch_assoc();
    $voteCount = $votes["roster"];
    $voteCount += 1;

    $mysqli -> query("UPDATE bidrag SET roster= '$voteCount' WHERE artistNamn = '$artist'");
}

function getAllDeltavlingTid(){
    global $mysqli;

    $deltavling = $mysqli -> query("SELECT * FROM deltavlingar");
    echo json_encode($deltavling -> fetch_all(MYSQLI_ASSOC));
}

//Populerar finalen vid kanpp tryck på admin sidan
function populateFinal(){
    global $mysqli;

    $finalist = $_GET["finalist"];
    
    $mysqli -> query("INSERT INTO bidragdeltavlingjoin (deltavlingNamnJoin, artistNamnJoin) VALUES ('final','$finalist')");
    echo json_encode($finalist);
}