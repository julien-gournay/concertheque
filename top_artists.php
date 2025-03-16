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
include('config.php');  // Connexion à la base de données
include('navbar.php');  // Connexion à la base de données


// Fonction pour récupérer les artistes depuis Spotify
function getTopArtists($access_token, $pdo) {
    $url = "https://api.spotify.com/v1/me/top/artists?limit=50"; // Augmenter la limite pour tester

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
        // Variables pour le calcul du pourcentage
        $total_artists = count($response_data['items']);
        $artists_with_badge = 0;

        // Si la clé 'items' est présente et contient des données, on peut itérer
        $rank = 1; // Initialiser le classement
        foreach ($response_data['items'] as $artist) {
            // Vérifie si l'artiste est dans la base de données
            $artistInDb = isArtistInDatabase($artist['name'], $pdo);

            // Affiche le classement de l'artiste et le nom en vert si l'artiste est dans la base de données
            echo $rank . '. ';
            echo $artistInDb ? '<span style="color: green;">' . $artist['name'] . '</span>' : $artist['name'];
            if ($artistInDb) {
                $artists_with_badge++;
            }
            echo '<br>';
            $rank++; // Incrémenter le classement
        }

        // Calcul du pourcentage
        $percentage = ($total_artists > 0) ? ($artists_with_badge / $total_artists) * 100 : 0;

        // Affichage du nombre d'artistes avec badge et du pourcentage
        echo '<br>';
        echo 'Nombre d\'artistes vu : ' . $artists_with_badge . '/' . $total_artists . '<br>';
        echo 'Pourcentage d\'artistes vu : ' . round($percentage, 2) . '%<br>';

    } else {
        // Gérer le cas où 'items' est manquant ou vide
        echo 'Aucun artiste trouvé ou erreur dans la réponse de l\'API.<br>';
        echo "Réponse complète : <pre>" . var_export($response_data, true) . "</pre>";
    }
}

// Fonction pour vérifier si un artiste existe dans la base de données
function isArtistInDatabase($nom, $pdo) {
    $stmt = $pdo->prepare("SELECT idArtiste FROM artiste WHERE nom = :nom");
    $stmt->execute(['nom' => $nom]);
    return $stmt->fetch(PDO::FETCH_ASSOC);  // Retourne l'artiste s'il existe, sinon false
}

session_start();

// Vérifier si la variable 'access_token' existe dans la session
if (isset($_SESSION['access_token'])) {
    $access_token = $_SESSION['access_token'];

} else {
    echo "Aucun token d'accès trouvé dans la session.";
}

// Récupérer les artistes
getTopArtists($access_token, $pdo);
?>
</body>