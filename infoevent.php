<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">

    <?php
    include "config.php";
    if(isset($_GET["id"])) $id = $_GET["id"];

    // Récupération infos événement
    $queryEvent = "
SELECT e.nomEvent, e.date, l.nomLieu, e.affiche, e.cover
FROM evenement e
INNER JOIN lieu l ON e.lieu = l.idLieu
WHERE e.idEvent=$id
";
    $resEvent = mysqli_query($cnt,$queryEvent);
    $event = mysqli_fetch_assoc($resEvent);
    $evenement = $event['nomEvent'];
    $dateEvenement = $event['date'];
    $lieu = $event['nomLieu'];
    $affiche = $event['affiche'];
    $cover = $event['cover'];

    echo "<title>$evenement</title>";
    ?>
</head>
<body class="bg-gray-100">

<?php include "navbar.php"; ?>

<!-- HERO Section -->
<section class="relative w-full h-screen">
    <img src="<?php echo $cover; ?>" alt="<?php echo $evenement; ?>" style="width:100%; height:100%; object-fit:cover; position:absolute; z-index:0;">
    <div style="position: absolute; z-index: 2; display: flex; flex-direction: column; bottom: 0; left: 0; right: 0;justify-content: flex-end; align-items: center; text-align: center; padding: 1.5rem; background: rgba(0,0,0,0.6); backdrop-filter: blur(6px);">
        <?php if(strtotime($dateEvenement) > time()): ?>
            <span style="background-color:red; color:white; font-weight:600; padding:0.5rem 1rem; border-radius:9999px; margin-bottom:1rem;">
                Prochainement
            </span>
        <?php endif; ?>
        <h1 style="font-size:3rem; font-weight:bold; color:white; margin-bottom:1rem;"><?php echo $evenement; ?></h1>
        <p style="color:#ddd; font-size:1.2rem; margin-bottom:0.5rem;">
            <?php echo date("d M Y", strtotime($dateEvenement)) . " | " . $lieu; ?>
        </p>
        <?php
        $dateActuelle = new DateTime();
        $dateEvt = new DateTime($dateEvenement);
        $interval = $dateEvt->diff($dateActuelle);
        if(strtotime($dateEvenement) > time()){
            echo "<p style='color:white; font-weight:600; font-size:1.2rem;'>J-".$interval->days." H-".$interval->h." M-".$interval->i." S-".$interval->s."</p>";
        } else {
            echo "<p style='color:white; font-weight:600; font-size:1.2rem;'>Il y a ".$interval->days." jours</p>";
        }
        ?>
    </div>
</section>

<!-- Line-Up Section -->
<section style="max-width:1200px; margin:0 auto; padding:3rem 1.5rem;">
    <h2 style="font-size:2rem; font-weight:bold; text-align:center; margin-bottom:2rem;">Line-Up</h2>
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:1.5rem; justify-items:center;">
        <?php
        $resArtistesO = mysqli_query($cnt, "
            SELECT a.nom, a.photo, a.idArtiste
            FROM association as asso
            INNER JOIN artiste a ON asso.artiste = a.idArtiste
            WHERE asso.evenement = $id AND asso.pPartie='O'
        ");
        $resArtistesN = mysqli_query($cnt, "
            SELECT a.nom, a.photo, a.idArtiste
            FROM association as asso
            INNER JOIN artiste a ON asso.artiste = a.idArtiste
            WHERE asso.evenement = $id AND asso.pPartie='N'
        ");

        function displayArtiste($row, $premierePartie=false){
            $nom = $row['nom'];
            $photo = $row['photo'];
            $idArtiste = $row['idArtiste'];
            echo "
            <a href='infoartiste.php?id=$idArtiste' class='artiste-card' style='position:relative; display:block; width:200px; height:300px; border-radius:15px; overflow:hidden; text-decoration:none;'>
                <img src='$photo' alt='$nom' style='width:100%; height:100%; object-fit:cover;'>
                <div class='artiste-overlay' style='position:absolute; inset:0; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px); opacity:0; display:flex; flex-direction:column; justify-content:center; align-items:center; transition:0.3s;'>
                    <h3 style='color:white; font-weight:600; text-align:center;'>$nom</h3>";
                    if($premierePartie){
                        echo "<span style='color:white; font-size:0.9rem; margin-top:0.3rem;'>Première partie</span>";
                    }
                    echo "</div>
            </a>
            ";
        }

        // Afficher artistes première partie
        while($row = mysqli_fetch_assoc($resArtistesO)) displayArtiste($row, true);
        // Afficher les autres artistes
        while($row = mysqli_fetch_assoc($resArtistesN)) displayArtiste($row, false);
        ?>
    </div>
</section>

<!-- Script overlay global -->
<script>
    document.querySelectorAll('.artiste-card').forEach(card => {
        const overlay = card.querySelector('.artiste-overlay');
        card.addEventListener('mouseenter', ()=> overlay.style.opacity = '1');
        card.addEventListener('mouseleave', ()=> overlay.style.opacity = '0');
    });
</script>
        ?>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
