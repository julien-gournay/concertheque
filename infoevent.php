<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/infoevent.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">

    <?php 
        include "config.php";

        if(isset($_GET["id"])){
            $id = $_GET["id"];
        }

        if($mabase){
            $res2 = mysqli_query($cnt, "SELECT evenement.nomEvent, evenement.date, lieu.nomLieu, evenement.affiche, evenement.cover FROM evenement,association,artiste, lieu  WHERE evenement.idEvent=$id AND evenement.idEvent=association.evenement AND association.artiste=artiste.idArtiste AND evenement.lieu=lieu.idLieu;");
            $res = mysqli_query($cnt, "SELECT evenement.nomEvent, evenement.date, lieu.nomLieu, evenement.affiche, evenement.cover, artiste.nom, artiste.photo FROM evenement,association,artiste, lieu  WHERE evenement.idEvent=$id AND evenement.idEvent=association.evenement AND association.artiste=artiste.idArtiste AND evenement.lieu=lieu.idLieu;");
        }

        while ($tab = mysqli_fetch_row($res2)) {
            $evenement = $tab[0];
            $dateEvenement = $tab[1];
            $lieu = $tab[2];
            $affiche = $tab[3];
            $cover = $tab[4];
        }
        echo("<title>$evenement</title>")
    ?>
    
</head>
<body>
    <?php   
        $cnt = mysqli_connect ('localhost', 'root','');
        $mabase= mysqli_select_db($cnt, "concerts");

        if(isset($_GET["id"])){
            $id = $_GET["id"];
        }

        if($mabase){
            $res2 = mysqli_query($cnt, "SELECT evenement.nomEvent, evenement.date, lieu.nomLieu, evenement.affiche FROM evenement,association,artiste, lieu  WHERE evenement.idEvent=$id AND evenement.idEvent=association.evenement AND association.artiste=artiste.idArtiste AND evenement.lieu=lieu.idLieu;");
            $res = mysqli_query($cnt, "SELECT evenement.nomEvent, evenement.date, lieu.nomLieu, evenement.affiche, artiste.nom, artiste.photo, association.pPartie, artiste.idArtiste FROM evenement,association,artiste, lieu  WHERE evenement.idEvent=$id AND evenement.idEvent=association.evenement AND association.artiste=artiste.idArtiste AND evenement.lieu=lieu.idLieu AND association.pPartie=\"N\";");
            $res3 = mysqli_query($cnt, "SELECT evenement.nomEvent, evenement.date, lieu.nomLieu, evenement.affiche, artiste.nom, artiste.photo, association.pPartie, artiste.idArtiste FROM evenement,association,artiste, lieu  WHERE evenement.idEvent=$id AND evenement.idEvent=association.evenement AND association.artiste=artiste.idArtiste AND evenement.lieu=lieu.idLieu AND association.pPartie=\"O\";");
        }
    ?>
    <section id="sec1">
        <?php
            echo("<img class=\"cover\" src=\"$cover\" href=\"#\"><br>");
        ?>

        <div class="countdown">
            <?php
                function tempsRestant($dateEvenement) {
                    $dateActuelle = new DateTime();
                    $dateEvenement = new DateTime($dateEvenement);
                    $intervalle = $dateEvenement->diff($dateActuelle);
                
                    return $intervalle;
                }
                // Récupérer le temps restant
                $tempsRestant = tempsRestant($dateEvenement);

                echo("<div class=\"listtag\">");
                if($dateEvenement>date("Y-m-d")){
                    echo("<p class=\"tag tagdate\">Prochainement</p>");
                    echo("<h2>".$tempsRestant->days . "J - " . $tempsRestant->h . "H - " . $tempsRestant->i . "M - " . $tempsRestant->s . "S<h2>");
                }
                else{
                    echo("Il y a ".$tempsRestant->days . " jours");
                }
                echo("</div>");
            ?>
        </div>
        <div class="content">
            
            <div class="info">
                <div class="info-cadre">
                <?php
                    echo("<h1 class=\"nomEvent\">$evenement</h1>");
                    echo("<p>$dateEvenement</p>");
                ?>
                </div>
            </div>
        </div>
    </section>
        
    <section id="sec2">
        <div class="lineup">
            <div class="lineup-titre">
                <h2>Line Up</h2>
            </div>
            <div class="lineup-artiste">
                <?php
                    while ($tab = mysqli_fetch_row($res3)) {
                        $artiste = $tab[4];
                        $photo = $tab[5];
                        $pPartie = $tab[6]; 
                        $idArtiste = $tab[7]; 
                        
                        echo("<div class=\"lineup-artiste-cadre\">");
                        echo("<div class=\"lineup-artiste-img\"><img src=\"$photo\" alt=\"\"></div>");
                        echo("<div class=\"lineup-artiste-nom\"><h3>$artiste</h3></div></div>");
                        echo("<hr>"); 
                    }
                    while ($tab = mysqli_fetch_row($res)) {
                        $artiste = $tab[4];
                        $photo = $tab[5];
                        $pPartie = $tab[6]; 
                        $idArtiste = $tab[7];
                        
                        echo("<div class=\"lineup-artiste-cadre\">");
                        echo("<a href=\"infoartiste.php?id=$idArtiste\"><div class=\"lineup-artiste-img\"><img src=\"$photo\" alt=\"\"></div></a>");
                        echo("<a href=\"infoartiste.php?id=$idArtiste\"><div class=\"lineup-artiste-nom\"><h3>$artiste</h3></div></div></a>");
                    }

                    
                ?>
            </div>
        </div>
    </section>
</body>
</html>