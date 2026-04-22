<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Les événements</title>
</head>
<body class="bg-gray-100">
<?php
    if (file_exists(__DIR__ . "/navbar.php")) {
        include __DIR__ . "/navbar.php";
    }
    include __DIR__ . "/config.php";
    if (!isset($cnt) || !$cnt) {
        $cnt = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($cnt, 'concerts');
    }
?>

<section class="max-w-screen-xl mx-auto px-6 pt-24 pb-12">
    <div class="flex flex-col md:flex-row md:justify-between items-center mb-8 gap-4">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 text-center">Mes événements</h1>
        <!-- Barre de recherche -->
        <div class="mb-8 flex justify-center">
            <label for="searchInput" class="sr-only">Rechercher un événement</label>
            <input
                type="text"
                id="searchInput"
                oninput="filterEvents()"
                placeholder="Rechercher un événement..."
                class="px-4 py-2 w-80 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>
    </div>

    <!-- Grid des cartes événements -->
    <div id="eventsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php
        $res = mysqli_query($cnt,"SELECT evenement.*, type.nomType, lieu.nomLieu FROM evenement INNER JOIN type ON evenement.type = type.idType INNER JOIN lieu ON evenement.lieu = lieu.idLieu ORDER BY evenement.date DESC;");

        while ($tab=mysqli_fetch_row($res)){
            $idEvent = $tab[0];
            $nomEvent = $tab[1];
            $date = $tab[2];
            $lieu = $tab[12];
            $type = $tab[4];
            $affiche = $tab[7];
            $prixBillet = $tab[9];

            $dateM = new DateTime($date);

            // Mois en français
            $mois = [
                1=>"Janvier", 2=>"Février", 3=>"Mars", 4=>"Avril", 5=>"Mai", 6=>"Juin",
                7=>"Juillet", 8=>"Août", 9=>"Septembre", 10=>"Octobre", 11=>"Novembre", 12=>"Décembre"
            ];

            $jour = $dateM->format("d");
            $moisTexte = $mois[intval($dateM->format("m"))];
            $annee = $dateM->format("Y");

            $formattedDate = "$jour $moisTexte $annee"; // ex : 20 Juin 2025

            // Couleur tag
            $tagClass = "bg-gray-400";
            switch ($type) {
                case "COM":
                    $tagClass = "bg-pink-500";
                    break;
                case "CON":
                    $tagClass = "bg-red-500";
                    break;
                case "FES":
                    $tagClass = "bg-yellow-500";
                    break;
                case "SHO":
                    $tagClass = "bg-green-500";
                    break;
                case "SOI":
                    $tagClass = "bg-purple-500";
                    break;
            }

            echo("<a href='./infoevent.php?id=$idEvent' class='event-card group flex justify-center' data-nom='".strtolower($nomEvent)."'>
                    <div class='bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition hover:-translate-y-2 w-72'>
                        
                        <!-- Image verticale type affiche -->
                        <div class='relative w-72 h-96'>
                            <img src='$affiche' alt='$nomEvent' class='w-full h-full object-cover'>
                            <!-- Badge type d'événement -->
                            <div class='absolute top-3 left-3 flex gap-2 ml-3'>");

                            // Badge 'Prochainement' conditionnel (affiché en premier)
                            if(strtotime($date) > time()){
                                echo("
                                    <span class='text-white text-sm font-semibold px-3 py-1 rounded-full' style='background-color: black'>
                                        Prochainement
                                    </span>");
                            }

                            // Badge type d'événement
                            echo("
                                <span class='text-white text-sm font-semibold px-3 py-1 rounded-full $tagClass'>
                                    $tab[11]
                                </span>
                            </div>
                        </div>
                
                        <!-- Infos -->
                        <div class='p-4'>
                            <h2 class='text-xl font-bold text-gray-900 mb-2'>$nomEvent</h2>
                            <p class='text-gray-600 text-sm'>".$formattedDate." | ".$lieu."</p>
                            <p class='text-gray-500 text-sm mt-2 font-semibold'>Prix : $prixBillet €</p>
                        </div>
                    </div>
                </a>
                ");
            ;}
        ?>
    </div>

    <!-- Aucun résultat -->
    <p id="noResult" class="hidden text-center text-gray-500 text-lg py-16">Aucun événement trouvé.</p>
</section>

<script>
    function filterEvents() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('#eventsGrid .event-card');
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
