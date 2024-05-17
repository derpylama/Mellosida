<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/artistcss.css">
    <script src="js/artistjs.js"></script>
</head>
<body>
    <header>
        <img src="../MelloLogga.png" alt="" id="MelloLogga">
        <img src="../MelloText.png" alt="" id="MelloText">
        <div id="tabs">
            <div id="div1"><a href="index.html">Hemsida</a></div>
            <div id="div2"><a href="artist.php">Artister</a></div>
            <div id="div3"><a href="">Om oss</a></div>
            </div>
            
    </header>
    <main>
        <nav>
            <p>delttävling1</p>
            <p>delttävling2</p>
            <p>delttävling3</p>
            <p>delttävling4</p>
            
        </nav>


        <div id="container">
            <?php
                require "funktioner.php";

                $x = getDeltavlingsInfo("info");
                print_r($x);
            ?>
            <div id="infoScreen"></div>
                <div id="autoboz"></div>
        </div>
    </main>
    <footer>
        <p>Maila oss:</p>
        <p>FAQ</p>
        <p>Melodifestivalen &copy; 2024 All rights reserved</p>
    </footer>
    <a id="AdminL" href="php/adminInlogg.php">adminInlogg</a>
</body>
</html>