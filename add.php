<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout evenement</title>
</head>
<body>
    <?php 
        include "navbar.php";
        include "config.php";
    ?>
    <section>
        <form action="" method="" style="display: flex; flex-direction: column;">
            <label for="nameEvent">Nom evenement</label>
            <input type="text" name="nameEvent" id="">

            <label for="date">Date</label>
            <input type="date" name="date" id="">

            <label for="loc">Lieu</label>
            <select name="loc" id="loc-select">
                <?php
                    if($mabase){
                        $res = mysqli_query($cnt,"SELECT lieu.idLieu, lieu.nomLieu, lieu.ville FROM lieu");
                    }
                    While ($tab = mysqli_fetch_row($res)) {
                        $idLoc = $tab[0];
                        $nomLoc = $tab[1];
                        $villeLoc = $tab[2];
                        echo("<option value=\"$idLoc\">$nomLoc ($villeLoc)</option>");
                    }
                ?>
            </select>

            <label for="typeEvent">Type evenement</label>
            <select name="typeEvent" id="loc-select">
                <?php
                    if($mabase){
                        $res = mysqli_query($cnt,"SELECT * FROM categorie");
                    }
                    While ($tab = mysqli_fetch_row($res)) {
                        $idCat = $tab[0];
                        $labelCat = $tab[1];
                        echo("<option value=\"$idCat\">$labelCat</option>");
                    }
                ?>
            </select>

            <label for="catPla">Categorie placement</label>
            <select name="loc" id="loc-select">
                <?php
                    if($mabase){
                        $res = mysqli_query($cnt,"SELECT * FROM type");
                    }
                    While ($tab = mysqli_fetch_row($res)) {
                        $idType = $tab[0];
                        $labelType = $tab[1];
                        echo("<option value=\"$idLoc\">$nomLoc ($villeLoc)</option>");
                    }
                ?>
            </select>

            <label for="afficheEvent">Affiche</label>
            <input type="text" name="afficheEvent" id="">

            <label for="coverEvent">Cover</label>
            <input type="text" name="coverEvent" id="">

            <label for="prixEvent">Prix</label>
            <input type="number" name="prixEvent" id="">

            <button type="submit">Ajouter</button>
        </form>
    </section>
    <section>

    </section>
</body>
</html>