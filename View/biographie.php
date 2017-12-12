<section id = "biographie">
    <h1><?php echo $data["nom"] ?></h1>
    <figure>
        <img src = <?php foreach ($data["photoRA"] as $photo){
            echo $photo["chemin"];
        }?>>
    </figure>
    <time>Date de naissance : <?php echo $data["datenaissance"] ?></time>
    <h2>Biographie</h2>
    <p><?php echo $data["biographie"] ?></p>
</section>

