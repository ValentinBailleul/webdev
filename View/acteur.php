<!doctype html>
<html>
<head>
    <title>WebDev</title>
    <link rel="stylesheet" href="../css/index.css"/>
    <meta charset="utf-8">
</head>
<body>
<?php include "./header.php" ?>
    <article>
        <?php
        foreach ($data as $photo){
            getBlock("./biographie.php", $photo);
        }
        //appeler getAllActors
        ?>
    </article>
</body>
<footer></footer>
</html>