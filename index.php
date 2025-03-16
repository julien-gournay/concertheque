<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Concerts souvenir</title>
</head>
<body>
    <?php 
        include "navbar.php";
        include "config.php";

        if($mabase){
            $res = mysqli_query($cnt,"SELECT SUM(evenement.prixBillet),COUNT(evenement.idEvent), ROUND(AVG(evenement.prixBillet), 2) FROM evenement"); // Nb events + prix moyen
            $res1 = mysqli_query($cnt,"SELECT COUNT(artiste.idArtiste) FROM artiste"); // Nb d'artistes
            $res2 = mysqli_query($cnt,"SELECT * FROM evenement WHERE evenement.date>=NOW() ORDER BY evenement.date ASC LIMIT 1;"); // Prochain event
            $res3 = mysqli_query($cnt,"SELECT YEAR(evenement.date), COUNT(evenement.date) FROM evenement GROUP BY YEAR(evenement.date);"); // Nb events par année
            $res4 = mysqli_query($cnt,"SELECT COUNT(lieu.idLieu) FROM lieu"); // Nb de lieux

        }
        while ($tab = mysqli_fetch_row($res)) {
            $prix = $tab[0];
            $nbEvent = $tab[1];
            $moyennePrix = $tab[2];
        }
        while ($tab = mysqli_fetch_row($res1)) {
            $nbArtiste = $tab[0];
        }
        while ($tab = mysqli_fetch_row($res4)) {
            $nbLieux = $tab[0];
        }
    ?>
    <section>
        <h1>Concerts souvenir</h1>
        <?php echo("<h3>Prix total : $prix € ($moyennePrix €/Event)</h3>"); ?>
        <?php echo("<h3>Nombre d'evenement : $nbEvent</h3>"); ?>
        <?php echo("<h3>Nombre d'artiste : $nbArtiste</h3>"); ?>
        <?php echo("<h3>Nombre de lieu : $nbLieux</h3>"); ?>

        <h1>Prochain evenement</h1>
        <?php
            while ($tab = mysqli_fetch_row($res)) {
                $nomEvent = $tab[0];
                $dateEvent = $tab[1];
                $lieu = $tab[1];
                $type = $tab[1];
                $dateEvent = $tab[1];
                $dateEvent = $tab[1];
            }
        ?>
        <div>

        </div>
    </section>
</body>
</html>