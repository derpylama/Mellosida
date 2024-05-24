<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Index.css">
</head>
<body>
    <header>
        <img src="MelloLogga.png" alt="" id="MelloLogga">
        <img src="MelloText.png" alt="" id="MelloText">
    </header>
    <main>
    <nav class="prevent-select">
            <p>Deltävling 1</p>
            <p>Deltävling 2</p>
            <p>Deltävling 3</p>
            <p>Deltävling 4</p>
            <p>Final</p>
        </nav>

        <div id="container">
            <?php
                require "funktioner.php";

                $x = getDeltavlingsInfo("info");
                $x = json_decode($x);

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
    <a id="AdminL" href="adminInlogg.php">adminInlogg</a>
</body>
</html>