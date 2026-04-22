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
    $res = mysqli_query($cnt,"SELECT SUM(evenement.prixBillet), SUM(IFNULL(evenement.depenseSup, 0)), SUM(evenement.prixBillet) + SUM(IFNULL(evenement.depenseSup, 0)), COUNT(evenement.idEvent), ROUND(AVG(evenement.prixBillet), 2) FROM evenement");
    $res1 = mysqli_query($cnt,"SELECT COUNT(artiste.idArtiste) FROM artiste");
    $res2 = mysqli_query($cnt,"SELECT * FROM evenement WHERE evenement.date>=NOW() ORDER BY evenement.date ASC LIMIT 1;");
    $res4 = mysqli_query($cnt,"SELECT COUNT(lieu.idLieu) FROM lieu");
    $res5 = mysqli_query($cnt,"SELECT YEAR(evenement.date) AS annee, COUNT(evenement.idEvent) AS nbConcerts, SUM(evenement.prixBillet) AS totalBillet, SUM(IFNULL(evenement.depenseSup, 0)) AS totalSup, SUM(evenement.prixBillet) + SUM(IFNULL(evenement.depenseSup, 0)) AS totalGeneral, LAG(SUM(evenement.prixBillet) + SUM(IFNULL(evenement.depenseSup, 0))) OVER (ORDER BY YEAR(evenement.date)) AS totalGeneralPrecedent FROM evenement GROUP BY YEAR(evenement.date) ORDER BY annee DESC");
}
while ($tab = mysqli_fetch_row($res)) {
    $prixBillet = $tab[0];
    $prixSup = $tab[1];
    $prix = $tab[2];
    $nbEvent = $tab[3];
    $moyennePrix = $tab[4];
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

<!-- MONTANT TOTAL ET TABLEAU PAR ANNÉE -->
<section class="max-w-screen-xl px-4 py-12 mx-auto">
    <!-- Montant total dépensé -->
    <div class="mb-12 p-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg text-white text-center">
        <h2 class="text-3xl font-bold mb-2">Montant total dépensé</h2>
        <p class="text-5xl font-extrabold"><?= number_format($prix, 2, ',', ' ') ?> €</p>
        <p class="mt-3 text-lg text-white/90">
            (dont <?= number_format($prixBillet, 2, ',', ' ') ?> € de billets)
        </p>
    </div>

    <!-- Tableau des stats par année -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900">Dépenses par année</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Année</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Nombre de concerts</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Montant total billets</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Montant total dépenses sup.</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Montant total général</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">% vs année précédente</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($res5)):
                        $pourcentage = null;
                        if ($row['totalGeneralPrecedent'] !== null && $row['totalGeneralPrecedent'] > 0) {
                            $pourcentage = (($row['totalGeneral'] - $row['totalGeneralPrecedent']) / $row['totalGeneralPrecedent']) * 100;
                        }
                    ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900"><?= $row['annee'] ?></td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600"><?= $row['nbConcerts'] ?></td>
                        <td class="px-6 py-4 text-right text-sm font-semibold text-blue-600"><?= number_format($row['totalBillet'], 2, ',', ' ') ?> €</td>
                        <td class="px-6 py-4 text-right text-sm font-semibold text-blue-600"><?= number_format($row['totalSup'], 2, ',', ' ') ?> €</td>
                        <td class="px-6 py-4 text-right text-sm font-semibold text-blue-600"><?= number_format($row['totalGeneral'], 2, ',', ' ') ?> €</td>
                        <td class="px-6 py-4 text-right text-sm font-semibold <?= $pourcentage !== null ? ($pourcentage >= 0 ? 'text-green-600' : 'text-red-600') : 'text-gray-600' ?>">
                            <?php if ($pourcentage !== null): ?>
                                <?= ($pourcentage >= 0 ? '+' : '') . number_format($pourcentage, 2, ',', ' ') ?>%
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</body>
</html>
