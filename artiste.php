<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Les artistes</title>
</head>
<body class="bg-gray-100">
    <?php
        include "navbar.php";
        include "config.php";
        session_start();
        $res = mysqli_query($cnt, "SELECT * FROM artiste ORDER BY nom");
        $resCount = mysqli_query($cnt, "SELECT COUNT(*) FROM artiste");
        $nbArtistes = mysqli_fetch_row($resCount)[0];
    ?>

    <!-- HEADER -->
    <section class="max-w-screen-xl mx-auto px-6 pt-24 pb-12">
        <div class="flex flex-col md:flex-row md:justify-between items-center mb-8 gap-4">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 text-center">🎤 Les Artistes</h1>
            <!-- Barre de recherche -->
            <div class="mb-8 flex justify-center">
                <div class="relative">
                    <input type="text" id="searchInput" oninput="filterArtistes()"
                           class="px-4 py-2 w-80 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Rechercher un artiste..."
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- GRILLE ARTISTES -->
    <div id="artisteGrid" class="max-w-screen-xl mx-auto px-6 pb-16 grid sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-4">
        <?php while ($tab = mysqli_fetch_row($res)):
            $idArtiste = $tab[0];
            $nom       = $tab[1];
            $genre     = $tab[2];
            $photo     = $tab[3];
        ?>
        <a href="./infoartiste.php?id=<?= $idArtiste ?>"
           class="artist-card group"
           data-nom="<?= strtolower(htmlspecialchars($nom)) ?>">
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition hover:-translate-y-2 w-full">
                <!-- Image verticale -->
                <div class="relative w-full h-48">
                    <img src="<?= htmlspecialchars($photo) ?>" alt="<?= htmlspecialchars($nom) ?>"
                         class="w-full h-full object-cover">
                    <!-- Badge genre -->
                    <?php if ($genre): ?>
                    <div class="absolute top-3 left-3">
                        <span class="bg-yellow-400 text-gray-900 text-sm font-semibold px-3 py-1 rounded-full">
                            <?= htmlspecialchars($genre) ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- Infos -->
                <div class="p-3">
                    <h2 class="text-sm font-bold text-gray-900 truncate"><?= htmlspecialchars($nom) ?></h2>
                </div>
            </div>
        </a>
        <?php endwhile; ?>
    </div>

    <!-- Aucun résultat -->
    <p id="noResult" class="hidden text-center text-gray-500 text-lg pb-16">Aucun artiste trouvé.</p>

    <script>
        function filterArtistes() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('#artisteGrid .artist-card');
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
