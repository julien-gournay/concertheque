<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Top Artistes Spotify</title>
</head>
<body class="bg-gray-100 font-sans">

<?php
include('config.php');
include('navbar.php');

session_start();
if (!isset($_SESSION['access_token'])) {
    echo "<div class='text-center text-red-600 mt-8'>Aucun token d'accès trouvé dans la session.</div>";
    exit;
}
$access_token = $_SESSION['access_token'];

function isArtistInDatabase($nom, $pdo) {
    $stmt = $pdo->prepare("SELECT idArtiste FROM artiste WHERE nom = :nom");
    $stmt->execute(['nom' => $nom]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTopArtists($access_token, $pdo) {
    $url = "https://api.spotify.com/v1/me/top/artists?limit=50";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $access_token,
        "Content-Type: application/json"
    ]);
    $response = curl_exec($ch);
    if ($response === false) die("Erreur cURL : " . curl_error($ch));
    curl_close($ch);

    $data = json_decode($response, true);
    return $data['items'] ?? [];
}

$artists = getTopArtists($access_token, $pdo);
$total_artists = count($artists);
$artists_seen = 0;
?>

<section class="max-w-screen-xl mx-auto pt-24">
    <h1 class="text-4xl font-bold text-center mb-8">Top Artistes Spotify</h1>

    <?php if ($total_artists === 0): ?>
        <p class="text-center text-gray-500">Aucun artiste trouvé.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-8">
            <?php
            $rank = 1;
            foreach ($artists as $artist):
                $seen = isArtistInDatabase($artist['name'], $pdo);
                if ($seen) $artists_seen++;
                ?>
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
                    <!-- Image fixe pour toutes les cartes -->
                    <div class="relative w-full h-64">
                        <img src="<?= $artist['images'][0]['url'] ?? 'https://via.placeholder.com/300' ?>"
                             alt="<?= htmlspecialchars($artist['name']) ?>"
                             class="w-full h-full object-cover">
                        <?php if($seen): ?>
                            <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full ml-3">
                        Vu
                    </span>
                        <?php endif; ?>
                    </div>
                    <div class="p-4 text-center">
                        <h2 class="font-semibold text-lg truncate"><?= htmlspecialchars($artist['name']) ?></h2>
                        <p class="text-gray-500 text-sm mt-1">#<?= $rank ?></p>
                    </div>
                </div>
                <?php
                $rank++;
            endforeach; ?>
        </div>

        <div class="my-6 text-center text-gray-700">
            Artistes vus : <span class="font-semibold"><?= $artists_seen ?></span> / <?= $total_artists ?><br>
            Pourcentage : <span class="font-semibold"><?= round(($artists_seen / $total_artists) * 100, 2) ?>%</span>
        </div>
    <?php endif; ?>
</section>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
