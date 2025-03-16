<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/salle.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Les salles</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <h1>Les salles</h1>
    <div class="liste">
        <?php
            include "config.php";
            
            $res = mysqli_query($cnt,"SELECT * FROM lieu");
            While ($tab=mysqli_fetch_row($res)){
                $idLieu = $tab[0];
                $nomLieu = $tab[1];
                $ville = $tab[2];
                $pays = $tab[3];
                $photoLieu = $tab[4];

                echo("
                <a href=\"./infolieu.php?id=$idLieu\">
                    <div class=\"card\">
                        <div class=\"image\">
                            <img src=\"$photoLieu\" href=\"#\">
                        </div>
                        <div class=\"info\">
                            <div class=\"cardtext\">
                            <h4>$nomLieu</h4>
                            <p>$ville, $pays</p>
                            </div>
                        </div>
                    </div>
                </a>");
            }
			//echo("Nombre d'artistes vu : $nbArtiste");
        ?>
    </div>
</body>
</html>