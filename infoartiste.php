<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/infoartiste.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Concert - Artistes</title>
</head>
<body>
    <?php
        include "navbar.php";
        include "config.php";

        // Récupération de l'ID de l'artiste depuis l'URL
        if(isset($_GET["id"])){
            $id = $_GET["id"];
        }

        if($mabase){
            $res = mysqli_query($cnt,"SELECT * FROM `artiste` WHERE idArtiste=$id");
            $res2 = mysqli_query($cnt,"SELECT COUNT(association.idAsso) FROM association WHERE association.artiste=$id");
            $res3 = mysqli_query($cnt,"SELECT evenement.nomEvent,evenement.date,evenement.affiche,evenement.idEvent FROM association,evenement WHERE association.artiste=$id AND association.evenement=evenement.idEvent;");
        }

        // Itérer sur les résultats
        while ($tab = mysqli_fetch_row($res)) {
            $idArtiste = $tab[0];
            $nom = $tab[1];
            $genre = $tab[2];
            $photo = $tab[3];
        }
        while ($tab = mysqli_fetch_row($res2)) {
            $nbvu = $tab[0];
        }

        session_start();

    ?>
    
    <section>
        <div class="bg">
            <?php
                echo("<img src=\"$photo\" href=\"#\"><br>");
            ?>
        </div>
        <div class="content">
            <div class="cnt-txt">
                <?php
                    echo("
                    <h1>$nom</h1>
                    <p>Nombre d'event : $nbvu</p>");
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
        <div class="lineup-artiste">
        <?php
        while ($tab = mysqli_fetch_row($res3)) {
            $nomEvent = $tab[0];
            $dateEvent = $tab[1];
            $afficheEvent = $tab[2];
            $idEvent = $tab[3]; 

            echo("<div class=\"lineup-artiste-cadre\">
                <a href=\"infoevent.php?id=$idEvent\">
                    <div class=\"lineup-artiste-img\">
                        <img src=\"$afficheEvent\" alt=\"\">
                    </div>
                </a>
                <a href=\"infoevent.php?id=$idEvent\">
                    <div class=\"lineup-artiste-nom\">
                        <h3>$nomEvent</h3>
                        <h3>$dateEvent</h3>
                    </div>
                </a></div>");
        }
        ?>
        </div>
    </section>
</body>
</html>
