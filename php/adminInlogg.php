<?php
$mysqli = new mysqli("localhost", "root", "", "mello");



$loginQuery = $mysqli -> prepare("SELECT * FROM `admininlogg` WHERE losenord = ? AND anvandarnamn = ?");

if(!empty($_POST)){
    if(!empty($_POST["anvandarnamn"] && !empty($_POST["losenord"]))){
        $username = $_POST["anvandarnamn"];
        $password = $_POST["losenord"];
    }
}

$loginQuery -> bind_param("ss", $username, $password);
$loginQuery -> execute();

$result = $loginQuery -> get_result() -> fetch_assoc();

if(!empty($result)){
    header("Location: admin.php");
    exit();
}

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