<?php
$sql = new mysqli("localhost", "root", "", "mello");

$result = $sql -> query("SELECT * FROM admininlogg");

print_r($result -> fetch_assoc());


//$loginQuery = $sql -> prepare("SELECT * FROM `admininlogg` WHERE losenord = ? AND andvandarnamn = ?");

/*
if(!empty($_POST["anvandarnamn"]) && !empty($_POST["losenord"])){
    $username = $_POST["anvandarnamn"];
    $password = $_POST["losenord"];
    
    $loginQuery -> bind_param("ss", $username, $password);
    

    
}
*/
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
        <div id = "inlogg">    
            <form action="" method = "POST">
                <input type="text" name="anvandarnamn" placeholder = "användanamn">
                <input type="text" name="losenord" placeholder = "lösenord">
                <input type="submit" id = "button">
            </form>
        </div>
    </body>
</html>