<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Concerts souvenir</title>
</head>
<body class="bg-gray-50 text-gray-900">
<?php
include "navbar.php";
include "config.php";

if($mabase){
    $res = mysqli_query($cnt,"SELECT SUM(evenement.prixBillet),COUNT(evenement.idEvent), ROUND(AVG(evenement.prixBillet), 2) FROM evenement");
    $res1 = mysqli_query($cnt,"SELECT COUNT(artiste.idArtiste) FROM artiste");
    $res2 = mysqli_query($cnt,"SELECT * FROM evenement WHERE evenement.date>=NOW() ORDER BY evenement.date ASC LIMIT 1;");
    $res4 = mysqli_query($cnt,"SELECT COUNT(lieu.idLieu) FROM lieu");
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
$nextEvent = mysqli_fetch_assoc($res2);
?>

<!-- HERO SECTION avec prochain concert -->
<section class="relative h-screen flex items-center justify-center bg-gray-900">
    <?php if ($nextEvent): ?>
        <!-- Image de fond -->
        <div class="absolute inset-0">
            <img src="<?= $nextEvent['cover'] ?>"
                 class="w-full h-full object-cover"
                 alt="Bannière">
        </div>

        <!-- Bloc texte avec fond sombre -->
        <div class="relative z-10 max-w-3xl px-8 py-10 text-center text-white shadow-lg" style="background-color: rgba(0, 0, 0, 0.7); padding: 2rem; border-radius: 15px; ">
            <h1 class="text-5xl md:text-7xl font-extrabold">
                <?= $nextEvent['nomEvent'] ?>
            </h1>
            <p class="mt-6 text-xl md:text-2xl font-medium">
                📅 <?= date("d/m/Y", strtotime($nextEvent['date'])) ?>
            </p>
            <a href="infoevent.php?id=<?= $nextEvent['idEvent'] ?>"
               class="mt-10 inline-block px-8 py-4 text-lg font-semibold text-gray-900 bg-white rounded-xl shadow-lg hover:bg-gray-200 transition">
                Voir l'événement
            </a>
        </div>
    <?php else: ?>
        <div class="relative z-10 max-w-3xl px-8 py-10 text-center text-white bg-black/70 rounded-2xl shadow-lg">
            <h1 class="text-5xl md:text-7xl font-extrabold">Pas de concert prévu</h1>
            <p class="mt-6 text-xl md:text-2xl">Reviens bientôt !</p>
        </div>
    <?php endif; ?>
</section>




<!-- STATS -->
<section class="max-w-screen-xl px-4 py-12 mx-auto">
    <div class="grid grid-cols-1 gap-6 text-center sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="text-2xl font-bold"><?= $nbEvent ?></h3>
            <p class="mt-2 text-gray-600">Événements</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="text-2xl font-bold"><?= $nbArtiste ?></h3>
            <p class="mt-2 text-gray-600">Artistes</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="text-2xl font-bold"><?= $nbLieux ?></h3>
            <p class="mt-2 text-gray-600">Lieux</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="text-2xl font-bold"><?= $moyennePrix ?> €</h3>
            <p class="mt-2 text-gray-600">Prix moyen billet</p>
        </div>
    </div>
</section>
</body>
</html>
