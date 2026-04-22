<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Les salles</title>
</head>
<body class="bg-gray-100">
<?php
    include "navbar.php";
    include "config.php";
?>

<section class="max-w-screen-xl mx-auto px-6 pt-24 pb-12">
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-8 gap-4">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 text-center">🏟️ Les Salles</h1>
        <!-- Barre de recherche -->
        <div class="mb-8 flex justify-center">
            <input
                type="text"
                id="searchInput"
                oninput="filterLieux()"
                placeholder="Rechercher une salle..."
                class="px-4 py-2 w-80 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>
    </div>

    <!-- Grid des cartes lieux -->
    <div id="lieuxGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
        include "config.php";
        $res = mysqli_query($cnt, "SELECT * FROM lieu ORDER BY nomLieu");
        while ($tab = mysqli_fetch_row($res)):
            $idLieu    = $tab[0];
            $nomLieu   = $tab[1];
            $ville     = $tab[2];
            $pays      = $tab[3];
            $photoLieu = $tab[4];
        ?>
        <a href="./infolieu.php?id=<?= $idLieu ?>"
           class="lieu-card group flex justify-center"
           data-nom="<?= strtolower(htmlspecialchars($nomLieu)) ?>">
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition hover:-translate-y-2 w-72">
                <!-- Image -->
                <div class="relative w-72 h-44">
                    <img src="<?= htmlspecialchars($photoLieu) ?>" alt="<?= htmlspecialchars($nomLieu) ?>"
                         class="w-full h-full object-cover">
                    <!-- Badge pays -->
                    <div class="absolute top-5 left-5">
                        <span class="bg-blue-600 text-white text-sm font-semibold px-3 py-1 rounded-full">
                            <?= htmlspecialchars($pays) ?>
                        </span>
                    </div>
                </div>
                <!-- Infos -->
                <div class="p-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-1"><?= htmlspecialchars($nomLieu) ?></h2>
                    <p class="text-gray-500 text-sm">📍 <?= htmlspecialchars($ville) ?>, <?= htmlspecialchars($pays) ?></p>
                </div>
            </div>
        </a>
        <?php endwhile; ?>
    </div>

    <!-- Aucun résultat -->
    <p id="noResult" class="hidden text-center text-gray-500 text-lg py-16">Aucune salle trouvée.</p>
</section>

<script>
    function filterLieux() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('#lieuxGrid .lieu-card');
        let visible = 0;
        cards.forEach(card => {
            const match = card.dataset.nom.includes(query);
            card.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('noResult').classList.toggle('hidden', visible > 0);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>