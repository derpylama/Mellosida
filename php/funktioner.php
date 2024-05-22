<?php
// Server koppling
//$mysqli = new mysqli("bushcan.ntigskovde.se", "ntigskov_bushcan", "U8Tv5U9MMr2uaEzQ6A91", "ntigskov_bushcan");

$mysqli = new mysqli("localhost", "root", "", "mello");


if(isset($_GET["deltavling"])){
    getDeltavlingsInfo("info");
}

#Hämtar ur all information från databasen, Kan ge både deltävlings id som svar eller all data.
function getDeltavlingsInfo($getData){
    global $mysqli; 
    
    
    if(!empty($_GET["deltavling"])){
        $deltavling = $_GET["deltavling"];
    
    }
    else{
        $deltavling = "deltavling1";
    }
    

    $getInfo = $mysqli -> query("SELECT * FROM artist JOIN bidragdeltavlingjoin ON artist.namn = bidragdeltavlingjoin.artistNamnJoin JOIN deltavlingar ON bidragdeltavlingjoin.deltavlingNamnJoin = deltavlingar.deltavlingsNamn JOIN bidrag ON artist.namn = bidrag.artistNamn WHERE deltavlingar.deltavlingsNamn = '$deltavling'");

    
    if($getData == "info"){
        echo json_encode($getInfo -> fetch_array());
        return $getInfo;
    }


    /*
    if($getData == "deltavling"){
        return $deltavling;
    }
    */
}


function saveAllData(){
    global $mysqli;
    
    if(!empty($_GET["deltavling"])){
        $deltavling = $_GET["deltavling"];
    
    }
    else{
        $deltavling = "deltavling1";
    }
    
    
    $saveArtist = $mysqli -> prepare("INSERT INTO artist (`namn`, `beskrivning`, `bildURL`) VALUES ( ?, ?, ?)");
    $saveBidrag = $mysqli -> prepare("INSERT INTO `bidrag`(`låtNamn`, `url`, `låtskrivare`, `artistNamn`) VALUES ( ?, ?, ?, ?)");
    $saveJoin = $mysqli -> prepare("INSERT INTO `bidragdeltavlingjoin`(`deltavlingNamnJoin`, `artistNamnJoin`) VALUES ( ?, ?)");
    $saveTidochDatum = $mysqli -> prepare("UPDATE `deltavlingar` SET `startTid`= ?,`slutTid`= ? ,`datum`= ? WHERE deltavlingsNamn = '$deltavling'");

    
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
            

            $saveJoin -> bind_param("ss", $deltavling, $artistNamn);
            $saveJoin -> execute();


        }
    }

    if(!empty($_POST)){
        if(!empty($_POST["datum"]) && !empty($_POST["startTid"]) && !empty($_POST["slutTid"])){
            $datum = $_POST["datum"];
            $startTid = $_POST["startTid"];
            $slutTid = $_POST["slutTid"];

            $saveTidochDatum -> bind_param("sss", $startTid, $slutTid, $datum);
            $saveTidochDatum -> execute();
        }
    }


}
