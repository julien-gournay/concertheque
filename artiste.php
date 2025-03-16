<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/artiste.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Les artistes</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <h1>Mes artistes</h1>
    <div class="liste">
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

            // Récupérer la liste des artistes de la BDD
            $res = mysqli_query($cnt, "SELECT * FROM artiste ORDER BY nom");

            if ($mabase) {
                $res2 = mysqli_query($cnt, "SELECT COUNT(*) FROM artiste");
                $res3 = mysqli_query($cnt, "SELECT * FROM artiste");
            }

            session_start();
            // Vérifier si la variable 'access_token' existe dans la session
            if (isset($_SESSION['access_token'])) {
                $access_token = $_SESSION['access_token'];
            } else {
                echo "Aucun token d'accès trouvé dans la session.";
                header('Location: php/spotify.php');
            }

            While ($tab = mysqli_fetch_row($res)) {
                $idArtiste = $tab[0];
                $nom = $tab[1];
                $genre = $tab[2];
                $photo = $tab[3];

                // Récupère le rang de l'artiste sur Spotify
                $rank = getArtistRankOnSpotify($nom, $access_token);

                // Affichage du nom de l'artiste et de son rang, si ce n'est pas "Inconnu"
                echo("<a href=\"./infoartiste.php?id=$idArtiste\"><div class=\"card\"><img src=\"$photo\" href=\"#\"><h4>$nom");

                // Si le rang n'est pas "Inconnu", affiche le rang à côté du nom de l'artiste
                if ($rank != 'Inconnu') {
                    echo ' <span style="color: green;">#' . $rank . '</span>';
                }

                echo("</h4></div></a>");
            }
        ?>
    </div>
</body>
</html>
