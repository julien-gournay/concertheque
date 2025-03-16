<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/infolieu.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Concert - Lieu</title>
</head>
<body>
    <?php
        include "config.php";

        if(isset($_GET["id"])){
            $id = $_GET["id"];
        }

        if($mabase){
            $res = mysqli_query($cnt,"SELECT * FROM `lieu` WHERE idLieu=$id");
            $res2 = mysqli_query($cnt,"SELECT COUNT(evenement.lieu=3) FROM evenement WHERE evenement.lieu=$id");
            $res3 = mysqli_query($cnt,"SELECT evenement.nomEvent,evenement.date,evenement.affiche,evenement.idEvent FROM evenement WHERE evenement.lieu=$id;");
            $res4 = mysqli_query($cnt,"SELECT DISTINCT artiste.nom,artiste.photo,artiste.idArtiste FROM evenement,association,artiste WHERE evenement.lieu=$id AND evenement.idEvent=association.evenement AND association.artiste=artiste.idArtiste;");
            $res5 = mysqli_query($cnt,"SELECT DISTINCT COUNT(artiste.idArtiste)  FROM evenement,association,artiste WHERE evenement.lieu=$id AND evenement.idEvent=association.evenement AND association.artiste=artiste.idArtiste;");
        }

        
        // Itérer sur les résultats
        while ($tab = mysqli_fetch_row($res)) {
            $idLieu = $tab[0];
            $nom = $tab[1];
            $ville = $tab[2];
            $pays = $tab[3];
            $photoLieu = $tab[4]; 
        }
        while ($tab = mysqli_fetch_row($res2)) {
            $nbEvent = $tab[0];
        }
        while ($tab = mysqli_fetch_row($res5)) {
            $nbArtiste = $tab[0];
        }
    ?>
    
    <section>
        <div class="bg">
            <?php
                echo("<img src=\"$photoLieu\" href=\"#\"><br>");
            ?>
        </div>
        <div class="content">
            <div class="cnt-txt">
                <?php
                    echo("
                    <h1>$nom</h1>
                    <h3>$ville, $pays</h3>
                    <p>Nombre d'event : $nbEvent</p>
                    <p>Nombre d'artiste : $nbArtiste</p>");
                ?>
            </div>
            <div>
                <div>
                    <h3></h3>
                </div>
            </div>
        </div>
    </section>
    
    <section id="sec2">
        <!--<h2>Les événements effectués</h2>-->
        <div class="lineup-artiste">
        <?php
        while ($tab = mysqli_fetch_row($res3)) {
            $nomEvent = $tab[0];
            $dateEvent = $tab[1];
            $afficheEvent = $tab[2];
            $idEvent = $tab[3]; 

            echo("<div class=\"lineup-artiste-cadre\">
                <a href=\"infoevent.php?id=$idEvent\"><div class=\"lineup-artiste-img\"><img src=\"$afficheEvent\" alt=\"\"></div></a>
                <a href=\"infoevent.php?id=$idEvent\"><div class=\"lineup-artiste-nom\"><h3>$nomEvent</h3></div></div></a>");
        }
        ?>
        </div>
    </section>

    <section id="sec2">
        <!--<h2>Les artistes présents</h2>-->
        <div class="lineup-artiste">
        <?php
        while ($tab = mysqli_fetch_row($res4)) {
            $nomArtiste = $tab[0];
            $photoArtiste = $tab[1];
            $idArtiste = $tab[2]; 

            echo("<div class=\"lineup-artiste-cadre\">
                <a href=\"infoartiste.php?id=$idArtiste\"><div class=\"lineup-artiste-img\"><img src=\"$photoArtiste\" alt=\"\"></div></a>
                <a href=\"infoartiste.php?id=$idArtiste\"><div class=\"lineup-artiste-nom\"><h3>$nomArtiste</h3></div></div></a>");
        }
        ?>
        </div>
    </section>
</body>
</html>