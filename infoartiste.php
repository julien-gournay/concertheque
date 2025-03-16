<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/infoartiste.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Concert - Artistes</title>
</head>
<body>
    <?php
        include "config.php";

        // Fonction pour récupérer le rang d'un artiste sur Spotify
        function getArtistRankOnSpotify($artist_name, $access_token) {
            $url = "https://api.spotify.com/v1/me/top/artists?limit=50"; // Récupère les 50 premiers artistes les plus écoutés

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer " . $access_token,
                "Content-Type: application/json"
            ]);

            $response = curl_exec($ch);
            if ($response === false) {
                die("Erreur cURL : " . curl_error($ch));
            }

            curl_close($ch);
            $response_data = json_decode($response, true);

            // Vérifie si la clé 'items' est présente dans la réponse
            if (isset($response_data['items']) && is_array($response_data['items'])) {
                // Itérer sur les artistes
                foreach ($response_data['items'] as $index => $artist) {
                    // Si l'artiste correspond à celui cherché
                    if (strtolower($artist['name']) == strtolower($artist_name)) {
                        return $index + 1; // Retourne le rang (l'index + 1)
                    }
                }
            }

            return 'Inconnu'; // Si l'artiste n'est pas trouvé dans la liste
        }

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
        // Vérifier si la variable 'access_token' existe dans la session
        if (isset($_SESSION['access_token'])) {
            $access_token = $_SESSION['access_token'];
        } else {
            echo "Aucun token d'accès trouvé dans la session.";
        }
        $rank = getArtistRankOnSpotify($nom, $access_token); // Récupère le rang de cet artiste

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
                    
                    // Affichage du rang sur Spotify
                    echo "<p>Top <b><a href=\"top_artists.php\">" . ($rank != 'Inconnu' ? $rank : 'Inconnu') . "</a></b> sur mon spotify</p>";
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
                <a href=\"infoevent.php?id=$idEvent\"><div class=\"lineup-artiste-img\"><img src=\"$afficheEvent\" alt=\"\"></div></a>
                <a href=\"infoevent.php?id=$idEvent\"><div class=\"lineup-artiste-nom\"><h3>$nomEvent</h3></div></div></a>");
        }
        ?>
        </div>
    </section>
</body>
</html>
