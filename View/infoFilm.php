<section id = "infoP">
    <h1><?php echo $data["titre"] ?></h1>
    <div>
        <time><?php echo date($data["datesortie"]); ?></time>
        <p>Acteurs principaux : <?php foreach ($data['acteurs'] as $acteur){
            echo $acteur["nom"];
            }?></p>
    </div>
    <p><?php echo $data["synopsis"]; ?></p>
    <p>Note sur 5 :
        <meter min="0" max="5" value=<?php echo $data["note"]; ?>>3</meter>
    </p>
</section>