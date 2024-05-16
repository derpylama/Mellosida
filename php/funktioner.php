<?php
$mysqli = new mysqli("localhost", "root", "", "mello");


#Hämtar ur all information från databasen, Kan ge både deltävlings id som svar eller all data.
if(!empty($_GET)){
    getDeltavlingsInfo("info");
}
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
        echo json_encode($getInfo -> fetch_assoc());
        return $getInfo;
    }

    if($getData == "deltavling"){
        return $deltavling;
    }

}

