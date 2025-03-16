<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/event.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Les evenements</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <h1>Mes evenements</h1>
    <div class="liste">
        <?php
            include "config.php";
            
            if (isset($_POST['nom'])) {
                $searchnom = $_POST['nom'];
                $res = mysqli_query($cnt, "SELECT evenement.*, type.nomType FROM evenement,type WHERE evenement.type=type.idType AND nomEvent LIKE '%$searchnom%' ORDER BY evenement.date DESC;");
            } else {
                $res = mysqli_query($cnt,"SELECT evenement.*, type.nomType FROM evenement,type WHERE evenement.type=type.idType ORDER BY evenement.date DESC;");
            }
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
                $typeComp = $tab[10];

                $dateM = new DateTime($date);
                $dateM->format("d M Y"); // Affiche : 25 Feb 2025

                echo("
                <a href=\"./infoevent.php?id=$idEvent\">
                    <div class=\"card\">
                        <div class=\"affiche\">
                            <img src=\"$affiche\" href=\"#\">
                        </div>
                        <div class=\"info\"><div class=\"listtag\">");
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
                            <div class=\"cardtext\"><h4>$nomEvent</h4>
                            <h4>".$dateM->format("d M Y")."</h4></div>
                        </div>
                    </div>
                </a>");
            }
			//echo("Nombre d'artistes vu : $nbArtiste");
        ?>
    </div>
</body>
</html>