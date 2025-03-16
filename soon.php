<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/event.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Evenements à venir</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <h1>Evenements à venir</h1>
    <div class="liste">
        <?php
            include "config.php";
            
            function tempsRestant($date) {
                $dateActuelle = new DateTime();
                $date = new DateTime($date);
                $intervalle = $date->diff($dateActuelle);
            
                return $intervalle;
            }
            
            $res = mysqli_query($cnt, "SELECT * FROM evenement WHERE evenement.date>=NOW() ORDER BY evenement.date;");
            While ($tab=mysqli_fetch_row($res)){
                $idEvent = $tab[0];
                $nomEvent = $tab[1];
                $date = $tab[2];
                $lieu = $tab[3];
                $type = $tab[4];
                $placement = $tab[5];
                $affiche = $tab[7];
                $cover = $tab[8];
                $prixBillet = $tab[9];

                $dateM = new DateTime($date);
                $dateM->format("d M Y"); // Affiche : 25 Feb 2025

                $date .= " 00:00:00"; // Début de la journée, ou " 23:59:59" pour la fin
                ?>

                <div class="countdown" id="compteARebours<?php echo $idEvent; ?>"></div>
                <script>
                    var dateEvenement<?php echo $idEvent; ?> = new Date("<?php echo $dateEvenement; ?>").getTime();

                    function mettreAJourCompteARebours<?php echo $idEvent; ?>() {
                        var maintenant = new Date().getTime();
                        var difference = dateEvenement<?php echo $idEvent; ?> - maintenant;

                        if (difference > 0) {
                            var jours = Math.floor(difference / (1000 * 60 * 60 * 24));
                            var heures = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                            var secondes = Math.floor((difference % (1000 * 60)) / 1000);

                            document.getElementById("compteARebours<?php echo $idEvent; ?>").innerHTML =
                                jours + "J - " + heures + "H - " + minutes + "M - " + secondes + "S";
                        } else {
                            document.getElementById("compteARebours<?php echo $idEvent; ?>").innerHTML = "L'événement a commencé !";
                        }
                    }

                    setInterval(mettreAJourCompteARebours<?php echo $idEvent; ?>, 1000);
                    mettreAJourCompteARebours<?php echo $idEvent; ?>();
                </script>
                <?php 
                echo("
                <a href=\"./infoevent.php?id=$idEvent\">
                    <div class=\"card\">
                        <div class=\"affiche\">
                            <img src=\"$affiche\" href=\"#\">
                        </div>
                        <div class=\"info\">
                            <div class=\"listtag\">");
                            if($date>date("Y-m-d")){
                                echo("<p class=\"tag tagdate\">Prochainement</p>");
                            };
                            switch($type){
                                case "COM":
                                    echo("<p class=\"tag tagcomedie\">Comédie musical</p>");
                                    break;
                                case "CON":
                                    echo("<p class=\"tag tagconcert\">Concert</p>");
                                    break;
                                case "FES":
                                    echo("<p class=\"tag tagfestival\">Festival</p>");
                                    break;
                                case "SHO":
                                    echo("<p class=\"tag tagshowcase\">Showcase</p>");
                                    break;
                                case "SOI":
                                    echo("<p class=\"tag tagsoiree\">Soirée</p>");
                                    break;
                            };
                            echo("</div>

                            <div class=\"cardtext\">
                                <h4>$nomEvent</h4>
                                <h4>".$dateM->format("d M Y")."</h4>
                            </div>

                            <div class=\"countdown\">");
                                //$tempsRestant = tempsRestant($date);
                                //echo("<h4>".$tempsRestant->days . "J - " . $tempsRestant->h . "H - " . $tempsRestant->i . "M - " . $tempsRestant->s . "S</h4>
                                //echo("<h4 id=\"compteARebours\"></h4>
                            echo("</div>
                        </div>
                    </div>
                </a>");
            }
        ?>
    </div>
</body>
</html>