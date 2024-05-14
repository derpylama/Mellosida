<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/artistcss.css">
    <script src="js/artistjs.js"></script>
</head>
<body>
    <header>
        <img src="MelloLogga.png" alt="" id="MelloLogga">
        <img src="MelloText.png" alt="" id="MelloText">
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
    <div id="infoScreen"> php and js
        <div id="artph">
            <?php if (isset($_FILES["image"]) && $uploadOk == 1) : ?>
                    <img src="<?php echo $targetFile; ?>" alt="Uploaded Image">;
                    <?php endif;?>
                    
            </div>
        </div>
        <div id="autoboz"></div>
    </main>
    <footer>
        <p>för mer information:</p>
        <p>mums</p>
        <p>korvkakor</p>
    </footer>
    <a id="AdminL" href="php/adminInlogg.php">adminInlogg</a>
</body>
</html>