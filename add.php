<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="https://www.svgrepo.com/show/324422/mic-karaoke.svg">
    <title>Ajouter / Modifier</title>
</head>
<body class="bg-gray-100">

<?php include "navbar.php"; include "config.php"; ?>

<?php
$successMsg = "";
$errorMsg   = "";

/* ===================== AJOUTS ===================== */

// Ajout lieu
if (isset($_POST['addLieu'])) {
    $nomLieu   = mysqli_real_escape_string($cnt, $_POST['nomLieu']);
    $ville     = mysqli_real_escape_string($cnt, $_POST['ville']);
    $pays      = mysqli_real_escape_string($cnt, $_POST['pays']);
    $photoLieu = mysqli_real_escape_string($cnt, $_POST['photoLieu']);
    $sql = "INSERT INTO lieu (nomLieu, ville, pays, photoLieu) VALUES ('$nomLieu','$ville','$pays','$photoLieu')";
    if (mysqli_query($cnt, $sql)) $successMsg = "✅ Lieu ajouté avec succès !";
    else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
}

// Ajout événement
if (isset($_POST['addEvent'])) {
    $nomEvent  = mysqli_real_escape_string($cnt, $_POST['nameEvent']);
    $date      = mysqli_real_escape_string($cnt, $_POST['date']);
    $lieu      = intval($_POST['loc']);
    $type      = mysqli_real_escape_string($cnt, $_POST['typeEvent']);
    $placement = mysqli_real_escape_string($cnt, $_POST['placement']);
    $pPartie   = intval($_POST['pPartie']);
    $affiche   = mysqli_real_escape_string($cnt, $_POST['afficheEvent']);
    $cover     = mysqli_real_escape_string($cnt, $_POST['coverEvent']);
    $prix      = floatval($_POST['prixEvent']);
    $sql = "INSERT INTO evenement (nomEvent, date, lieu, type, placement, pPartie, affiche, cover, prixBillet)
            VALUES ('$nomEvent','$date',$lieu,'$type','$placement',$pPartie,'$affiche','$cover',$prix)";
    if (mysqli_query($cnt, $sql)) $successMsg = "✅ Événement ajouté avec succès !";
    else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
}

// Ajout artiste
if (isset($_POST['addArtiste'])) {
    $nom   = mysqli_real_escape_string($cnt, $_POST['nomArtiste']);
    $genre = mysqli_real_escape_string($cnt, $_POST['genre']);
    $photo = mysqli_real_escape_string($cnt, $_POST['photoArtiste']);
    $sql = "INSERT INTO artiste (nom, genre, photo) VALUES ('$nom','$genre','$photo')";
    if (mysqli_query($cnt, $sql)) $successMsg = "✅ Artiste ajouté avec succès !";
    else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
}

/* ===================== ASSOCIATIONS ===================== */

// Rattacher un artiste à un événement
if (isset($_POST['addAsso'])) {
    $idEvt    = intval($_POST['assoEventId']);
    $idArt    = intval($_POST['assoArtisteId']);
    $isPP     = isset($_POST['assoPP']) ? 'O' : 'N';
    // Vérifier doublon
    $check = mysqli_query($cnt, "SELECT idAsso FROM association WHERE evenement=$idEvt AND artiste=$idArt");
    if (mysqli_num_rows($check) > 0) {
        $errorMsg = "⚠️ Cet artiste est déjà rattaché à cet événement.";
    } else {
        $sql = "INSERT INTO association (evenement, artiste, pPartie) VALUES ($idEvt, $idArt, '$isPP')";
        if (mysqli_query($cnt, $sql)) $successMsg = "✅ Artiste rattaché avec succès !";
        else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
    }
}

// Supprimer une association
if (isset($_POST['delAsso'])) {
    $idAsso = intval($_POST['idAsso']);
    $sql = "DELETE FROM association WHERE idAsso=$idAsso";
    if (mysqli_query($cnt, $sql)) $successMsg = "✅ Artiste retiré de l'événement.";
    else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
}

/* ===================== MODIFICATIONS ===================== */

// Modifier lieu
if (isset($_POST['editLieu'])) {
    $id        = intval($_POST['editLieuId']);
    $nomLieu   = mysqli_real_escape_string($cnt, $_POST['editNomLieu']);
    $ville     = mysqli_real_escape_string($cnt, $_POST['editVille']);
    $pays      = mysqli_real_escape_string($cnt, $_POST['editPays']);
    $photoLieu = mysqli_real_escape_string($cnt, $_POST['editPhotoLieu']);
    $sql = "UPDATE lieu SET nomLieu='$nomLieu', ville='$ville', pays='$pays', photoLieu='$photoLieu' WHERE idLieu=$id";
    if (mysqli_query($cnt, $sql)) $successMsg = "✅ Lieu modifié avec succès !";
    else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
}

// Modifier événement
if (isset($_POST['editEvent'])) {
    $id        = intval($_POST['editEventId']);
    $nomEvent  = mysqli_real_escape_string($cnt, $_POST['editNameEvent']);
    $date      = mysqli_real_escape_string($cnt, $_POST['editDate']);
    $lieu      = intval($_POST['editLoc']);
    $type      = mysqli_real_escape_string($cnt, $_POST['editTypeEvent']);
    $placement = mysqli_real_escape_string($cnt, $_POST['editPlacement']);
    $pPartie   = intval($_POST['editPPartie']);
    $affiche   = mysqli_real_escape_string($cnt, $_POST['editAfficheEvent']);
    $cover     = mysqli_real_escape_string($cnt, $_POST['editCoverEvent']);
    $prix      = floatval($_POST['editPrixEvent']);
    $sql = "UPDATE evenement SET nomEvent='$nomEvent', date='$date', lieu=$lieu, type='$type', placement='$placement',
            pPartie=$pPartie, affiche='$affiche', cover='$cover', prixBillet=$prix WHERE idEvent=$id";
    if (mysqli_query($cnt, $sql)) $successMsg = "✅ Événement modifié avec succès !";
    else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
}

// Modifier artiste
if (isset($_POST['editArtiste'])) {
    $id    = intval($_POST['editArtisteId']);
    $nom   = mysqli_real_escape_string($cnt, $_POST['editNomArtiste']);
    $genre = mysqli_real_escape_string($cnt, $_POST['editGenre']);
    $photo = mysqli_real_escape_string($cnt, $_POST['editPhotoArtiste']);
    $sql = "UPDATE artiste SET nom='$nom', genre='$genre', photo='$photo' WHERE idArtiste=$id";
    if (mysqli_query($cnt, $sql)) $successMsg = "✅ Artiste modifié avec succès !";
    else $errorMsg = "❌ Erreur : " . mysqli_error($cnt);
}

/* ===================== DONNÉES POUR LES SELECTS ===================== */
$resLieu  = mysqli_query($cnt, "SELECT idLieu, nomLieu, ville FROM lieu ORDER BY nomLieu");
$lieuRows = [];
while ($r = mysqli_fetch_assoc($resLieu)) $lieuRows[] = $r;

$resType  = mysqli_query($cnt, "SELECT idType, nomType FROM type ORDER BY nomType");
$typeRows = [];
while ($r = mysqli_fetch_assoc($resType)) $typeRows[] = $r;

$resCat  = mysqli_query($cnt, "SELECT idCat, nomCat FROM categorie ORDER BY nomCat");
$catRows = [];
while ($r = mysqli_fetch_assoc($resCat)) $catRows[] = $r;

$resArt  = mysqli_query($cnt, "SELECT idArtiste, nom, genre, photo FROM artiste ORDER BY nom");
$artRows = [];
while ($r = mysqli_fetch_assoc($resArt)) $artRows[] = $r;

$resEvt  = mysqli_query($cnt, "SELECT idEvent, nomEvent, date, lieu, type, placement, pPartie, affiche, cover, prixBillet FROM evenement ORDER BY nomEvent");
$evtRows = [];
while ($r = mysqli_fetch_assoc($resEvt)) $evtRows[] = $r;

$lieuRowsFull = [];
$resLieuFull = mysqli_query($cnt, "SELECT idLieu, nomLieu, ville, pays, photoLieu FROM lieu ORDER BY nomLieu");
while ($r = mysqli_fetch_assoc($resLieuFull)) $lieuRowsFull[] = $r;
?>

<section class="max-w-screen-lg mx-auto px-6 pt-28 pb-16">

    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-10 text-center">🎛️ Gestion</h1>

    <!-- Alertes -->
    <?php if ($successMsg): ?>
    <div class="flex items-center p-4 mb-6 text-green-800 border border-green-300 rounded-lg bg-green-50">
        <span class="font-medium"><?= $successMsg ?></span>
    </div>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
    <div class="flex items-center p-4 mb-6 text-red-800 border border-red-300 rounded-lg bg-red-50">
        <span class="font-medium"><?= $errorMsg ?></span>
    </div>
    <?php endif; ?>

    <!-- ===== ONGLETS PRINCIPAUX ===== -->
    <div class="mb-6 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
            <li class="me-2"><button id="tab-event-btn"   type="button" class="tab-main-btn inline-block p-4 border-b-2 rounded-t-lg">🎵 Événement</button></li>
            <li class="me-2"><button id="tab-artiste-btn" type="button" class="tab-main-btn inline-block p-4 border-b-2 rounded-t-lg">🎤 Artiste</button></li>
            <li class="me-2"><button id="tab-lieu-btn"    type="button" class="tab-main-btn inline-block p-4 border-b-2 rounded-t-lg">📍 Lieu</button></li>
        </ul>
    </div>

    <!-- ========================================================== -->
    <!--                     PANNEAU ÉVÉNEMENT                       -->
    <!-- ========================================================== -->
    <div id="tab-event" class="tab-panel hidden">

        <!-- Sous-onglets Ajouter / Modifier / Artistes -->
        <div class="mb-4 flex gap-2">
            <button type="button" class="sub-tab-btn px-5 py-2 rounded-lg text-sm font-semibold" data-panel="add-event">➕ Ajouter</button>
            <button type="button" class="sub-tab-btn px-5 py-2 rounded-lg text-sm font-semibold" data-panel="edit-event">✏️ Modifier</button>
            <button type="button" class="sub-tab-btn px-5 py-2 rounded-lg text-sm font-semibold" data-panel="asso-event">🎸 Artistes</button>
        </div>

        <!-- Ajouter événement -->
        <div id="add-event" class="sub-panel bg-white rounded-2xl shadow-lg p-8 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Ajouter un événement</h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom de l'événement</label>
                    <input type="text" name="nameEvent" required class="input-std" placeholder="Ex : Nuit Électro 2025">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" required class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Prix (€)</label>
                    <input type="number" name="prixEvent" min="0" step="0.01" required class="input-std" placeholder="Ex : 25.00">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Lieu</label>
                    <select name="loc" required class="input-std">
                        <option value="">-- Choisir --</option>
                        <?php foreach ($lieuRows as $l): ?>
                        <option value="<?= $l['idLieu'] ?>"><?= htmlspecialchars($l['nomLieu']) ?> (<?= htmlspecialchars($l['ville']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Type</label>
                    <select name="typeEvent" required class="input-std">
                        <option value="">-- Choisir --</option>
                        <?php foreach ($typeRows as $t): ?>
                        <option value="<?= $t['idType'] ?>"><?= htmlspecialchars($t['nomType']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Placement</label>
                    <select name="placement" required class="input-std">
                        <option value="">-- Choisir --</option>
                        <?php foreach ($catRows as $c): ?>
                        <option value="<?= $c['idCat'] ?>"><?= htmlspecialchars($c['nomCat']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nb. premières parties</label>
                    <input type="number" name="pPartie" min="0" value="0" class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Affiche</label>
                    <input type="url" name="afficheEvent" class="input-std" placeholder="https://...">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Cover</label>
                    <input type="url" name="coverEvent" class="input-std" placeholder="https://...">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" name="addEvent" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">➕ Ajouter l'événement</button>
                </div>
            </form>
        </div>

        <!-- Modifier événement -->
        <div id="edit-event" class="sub-panel bg-white rounded-2xl shadow-lg p-8 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier un événement</h2>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Choisir l'événement à modifier</label>
                <select id="selectEditEvent" class="input-std">
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($evtRows as $e): ?>
                    <option value="<?= $e['idEvent'] ?>"
                        data-nom="<?= htmlspecialchars($e['nomEvent']) ?>"
                        data-date="<?= $e['date'] ?>"
                        data-lieu="<?= $e['lieu'] ?>"
                        data-type="<?= $e['type'] ?>"
                        data-placement="<?= $e['placement'] ?>"
                        data-ppartie="<?= $e['pPartie'] ?>"
                        data-affiche="<?= htmlspecialchars($e['affiche'] ?? '') ?>"
                        data-cover="<?= htmlspecialchars($e['cover'] ?? '') ?>"
                        data-prix="<?= $e['prixBillet'] ?>">
                        <?= htmlspecialchars($e['nomEvent']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <form method="POST" id="formEditEvent" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="hidden" name="editEventId" id="editEventId">
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom de l'événement</label>
                    <input type="text" name="editNameEvent" id="editNameEvent" required class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="editDate" id="editDate" required class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Prix (€)</label>
                    <input type="number" name="editPrixEvent" id="editPrixEvent" min="0" step="0.01" class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Lieu</label>
                    <select name="editLoc" id="editLoc" class="input-std">
                        <?php foreach ($lieuRows as $l): ?>
                        <option value="<?= $l['idLieu'] ?>"><?= htmlspecialchars($l['nomLieu']) ?> (<?= htmlspecialchars($l['ville']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Type</label>
                    <select name="editTypeEvent" id="editTypeEvent" class="input-std">
                        <?php foreach ($typeRows as $t): ?>
                        <option value="<?= $t['idType'] ?>"><?= htmlspecialchars($t['nomType']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Placement</label>
                    <select name="editPlacement" id="editPlacement" class="input-std">
                        <?php foreach ($catRows as $c): ?>
                        <option value="<?= $c['idCat'] ?>"><?= htmlspecialchars($c['nomCat']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nb. premières parties</label>
                    <input type="number" name="editPPartie" id="editPPartie" min="0" class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Affiche</label>
                    <input type="url" name="editAfficheEvent" id="editAfficheEvent" class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Cover</label>
                    <input type="url" name="editCoverEvent" id="editCoverEvent" class="input-std">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" name="editEvent" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">💾 Enregistrer les modifications</button>
                </div>
            </form>
        </div>
        <!-- Rattacher des artistes à un événement -->
        <div id="asso-event" class="sub-panel bg-white rounded-2xl shadow-lg p-8 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Artistes d'un événement</h2>

            <!-- Sélecteur d'événement -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Choisir l'événement</label>
                <select id="assoEventSelect" class="input-std" onchange="loadAsso(this.value)">
                    <option value="">-- Sélectionner un événement --</option>
                    <?php foreach ($evtRows as $e): ?>
                    <option value="<?= $e['idEvent'] ?>"><?= htmlspecialchars($e['nomEvent']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Artistes déjà liés -->
            <div id="assoList" class="mb-8 hidden">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Artistes au programme</h3>
                <div id="assoListItems" class="flex flex-wrap gap-3 mb-2"></div>
                <p id="assoEmpty" class="text-gray-400 text-sm hidden">Aucun artiste rattaché pour l'instant.</p>
            </div>

            <!-- Formulaire ajout association -->
            <div id="assoFormWrap" class="hidden">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Rattacher un artiste</h3>
                <form method="POST" class="flex flex-wrap items-end gap-4">
                    <input type="hidden" name="assoEventId" id="assoEventIdHidden">

                    <div class="flex-1 min-w-48">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Artiste</label>
                        <select name="assoArtisteId" required class="input-std">
                            <option value="">-- Choisir --</option>
                            <?php foreach ($artRows as $a): ?>
                            <option value="<?= $a['idArtiste'] ?>"><?= htmlspecialchars($a['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex items-center gap-2 pb-1">
                        <input type="checkbox" name="assoPP" id="assoPP" class="w-4 h-4 text-blue-600 rounded border-gray-300">
                        <label for="assoPP" class="text-sm font-medium text-gray-700">Première partie</label>
                    </div>

                    <button type="submit" name="addAsso" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition">
                        ➕ Rattacher
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ========================================================== -->
    <!-- ========================================================== -->
    <div id="tab-artiste" class="tab-panel hidden">

        <div class="mb-4 flex gap-2">
            <button type="button" class="sub-tab-btn px-5 py-2 rounded-lg text-sm font-semibold" data-panel="add-artiste">➕ Ajouter</button>
            <button type="button" class="sub-tab-btn px-5 py-2 rounded-lg text-sm font-semibold" data-panel="edit-artiste">✏️ Modifier</button>
        </div>

        <!-- Ajouter artiste -->
        <div id="add-artiste" class="sub-panel bg-white rounded-2xl shadow-lg p-8 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Ajouter un artiste</h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom de l'artiste</label>
                    <input type="text" name="nomArtiste" required class="input-std" placeholder="Ex : Daft Punk">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Genre musical</label>
                    <input type="text" name="genre" class="input-std" placeholder="Ex : Électro">
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Photo</label>
                    <input type="url" name="photoArtiste" class="input-std" placeholder="https://...">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" name="addArtiste" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow transition">➕ Ajouter l'artiste</button>
                </div>
            </form>
        </div>

        <!-- Modifier artiste -->
        <div id="edit-artiste" class="sub-panel bg-white rounded-2xl shadow-lg p-8 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier un artiste</h2>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Choisir l'artiste à modifier</label>
                <select id="selectEditArtiste" class="input-std">
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($artRows as $a): ?>
                    <option value="<?= $a['idArtiste'] ?>"
                        data-nom="<?= htmlspecialchars($a['nom']) ?>"
                        data-genre="<?= htmlspecialchars($a['genre']) ?>"
                        data-photo="<?= htmlspecialchars($a['photo'] ?? '') ?>">
                        <?= htmlspecialchars($a['nom']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="hidden" name="editArtisteId" id="editArtisteId">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom de l'artiste</label>
                    <input type="text" name="editNomArtiste" id="editNomArtiste" required class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Genre musical</label>
                    <input type="text" name="editGenre" id="editGenre" class="input-std">
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Photo</label>
                    <input type="url" name="editPhotoArtiste" id="editPhotoArtiste" class="input-std">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" name="editArtiste" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">💾 Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================================== -->
    <!--                        PANNEAU LIEU                         -->
    <!-- ========================================================== -->
    <div id="tab-lieu" class="tab-panel hidden">

        <div class="mb-4 flex gap-2">
            <button type="button" class="sub-tab-btn px-5 py-2 rounded-lg text-sm font-semibold" data-panel="add-lieu">➕ Ajouter</button>
            <button type="button" class="sub-tab-btn px-5 py-2 rounded-lg text-sm font-semibold" data-panel="edit-lieu">✏️ Modifier</button>
        </div>

        <!-- Ajouter lieu -->
        <div id="add-lieu" class="sub-panel bg-white rounded-2xl shadow-lg p-8 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Ajouter un lieu</h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom du lieu</label>
                    <input type="text" name="nomLieu" required class="input-std" placeholder="Ex : Zénith de Paris">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" name="ville" required class="input-std" placeholder="Ex : Paris">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Pays</label>
                    <input type="text" name="pays" required class="input-std" placeholder="Ex : France">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Photo</label>
                    <input type="url" name="photoLieu" class="input-std" placeholder="https://...">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" name="addLieu" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">➕ Ajouter le lieu</button>
                </div>
            </form>
        </div>

        <!-- Modifier lieu -->
        <div id="edit-lieu" class="sub-panel bg-white rounded-2xl shadow-lg p-8 hidden">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Modifier un lieu</h2>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Choisir le lieu à modifier</label>
                <select id="selectEditLieu" class="input-std">
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($lieuRowsFull as $l): ?>
                    <option value="<?= $l['idLieu'] ?>"
                        data-nom="<?= htmlspecialchars($l['nomLieu']) ?>"
                        data-ville="<?= htmlspecialchars($l['ville']) ?>"
                        data-pays="<?= htmlspecialchars($l['pays']) ?>"
                        data-photo="<?= htmlspecialchars($l['photoLieu'] ?? '') ?>">
                        <?= htmlspecialchars($l['nomLieu']) ?> (<?= htmlspecialchars($l['ville']) ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="hidden" name="editLieuId" id="editLieuId">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom du lieu</label>
                    <input type="text" name="editNomLieu" id="editNomLieu" required class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" name="editVille" id="editVille" required class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Pays</label>
                    <input type="text" name="editPays" id="editPays" required class="input-std">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">URL Photo</label>
                    <input type="url" name="editPhotoLieu" id="editPhotoLieu" class="input-std">
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" name="editLieu" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">💾 Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>

</section>

<style>
    .input-std {
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        color: #111827;
        border-radius: 0.5rem;
        display: block;
        width: 100%;
        padding: 0.625rem;
        font-size: 0.875rem;
    }
    .input-std:focus { outline: none; ring: 2px solid #3b82f6; border-color: #3b82f6; }
</style>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script>
/* ===== Onglets principaux ===== */
const mainTabs = {
    'tab-event-btn':   'tab-event',
    'tab-artiste-btn': 'tab-artiste',
    'tab-lieu-btn':    'tab-lieu',
};

function switchMainTab(activeBtnId) {
    Object.entries(mainTabs).forEach(([btnId, panelId]) => {
        const btn   = document.getElementById(btnId);
        const panel = document.getElementById(panelId);
        const active = btnId === activeBtnId;
        btn.classList.toggle('border-blue-600', active);
        btn.classList.toggle('text-blue-600', active);
        btn.classList.toggle('border-transparent', !active);
        btn.classList.toggle('text-gray-500', !active);
        panel.classList.toggle('hidden', !active);

        // Activer le premier sous-onglet automatiquement
        if (active) {
            const firstSubBtn = panel.querySelector('.sub-tab-btn');
            if (firstSubBtn) firstSubBtn.click();
        }
    });
}

Object.keys(mainTabs).forEach(btnId => {
    document.getElementById(btnId).addEventListener('click', () => switchMainTab(btnId));
});

/* ===== Sous-onglets Ajouter / Modifier ===== */
document.querySelectorAll('.sub-tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const targetPanel = btn.dataset.panel;
        const parentTab   = btn.closest('.tab-panel');

        parentTab.querySelectorAll('.sub-tab-btn').forEach(b => {
            b.classList.remove('bg-blue-600', 'text-white');
            b.classList.add('bg-gray-200', 'text-gray-700');
        });
        btn.classList.add('bg-blue-600', 'text-white');
        btn.classList.remove('bg-gray-200', 'text-gray-700');

        parentTab.querySelectorAll('.sub-panel').forEach(p => p.classList.add('hidden'));
        document.getElementById(targetPanel).classList.remove('hidden');
    });
});

/* ===== Pré-remplissage : Événement ===== */
document.getElementById('selectEditEvent').addEventListener('change', function () {
    const opt = this.options[this.selectedIndex];
    if (!opt.value) return;
    document.getElementById('editEventId').value      = opt.value;
    document.getElementById('editNameEvent').value    = opt.dataset.nom;
    document.getElementById('editDate').value         = opt.dataset.date;
    document.getElementById('editPrixEvent').value    = opt.dataset.prix;
    document.getElementById('editPPartie').value      = opt.dataset.ppartie;
    document.getElementById('editAfficheEvent').value = opt.dataset.affiche;
    document.getElementById('editCoverEvent').value   = opt.dataset.cover;
    setSelectValue('editLoc',       opt.dataset.lieu);
    setSelectValue('editTypeEvent', opt.dataset.type);
    setSelectValue('editPlacement', opt.dataset.placement);
});

/* ===== Pré-remplissage : Artiste ===== */
document.getElementById('selectEditArtiste').addEventListener('change', function () {
    const opt = this.options[this.selectedIndex];
    if (!opt.value) return;
    document.getElementById('editArtisteId').value      = opt.value;
    document.getElementById('editNomArtiste').value     = opt.dataset.nom;
    document.getElementById('editGenre').value          = opt.dataset.genre;
    document.getElementById('editPhotoArtiste').value   = opt.dataset.photo;
});

/* ===== Pré-remplissage : Lieu ===== */
document.getElementById('selectEditLieu').addEventListener('change', function () {
    const opt = this.options[this.selectedIndex];
    if (!opt.value) return;
    document.getElementById('editLieuId').value    = opt.value;
    document.getElementById('editNomLieu').value   = opt.dataset.nom;
    document.getElementById('editVille').value     = opt.dataset.ville;
    document.getElementById('editPays').value      = opt.dataset.pays;
    document.getElementById('editPhotoLieu').value = opt.dataset.photo;
});

function setSelectValue(selectId, value) {
    const sel = document.getElementById(selectId);
    for (let i = 0; i < sel.options.length; i++) {
        if (sel.options[i].value == value) { sel.selectedIndex = i; break; }
    }
}

/* ===== Onglet actif par défaut ===== */
switchMainTab('tab-event-btn');

/* ===== Données associations (PHP -> JS) ===== */
const assoData = <?php
    $assoMap = [];
    $resAsso = mysqli_query($cnt, "
        SELECT a.idAsso, a.evenement, a.artiste, a.pPartie, ar.nom
        FROM association a
        JOIN artiste ar ON ar.idArtiste = a.artiste
        ORDER BY ar.nom
    ");
    while ($r = mysqli_fetch_assoc($resAsso)) {
        $assoMap[$r['evenement']][] = [
            'idAsso'   => $r['idAsso'],
            'idArt'    => $r['artiste'],
            'nom'      => $r['nom'],
            'pPartie'  => $r['pPartie'],
        ];
    }
    echo json_encode($assoMap);
?>;

function loadAsso(eventId) {
    const listWrap    = document.getElementById('assoList');
    const listItems   = document.getElementById('assoListItems');
    const emptyMsg    = document.getElementById('assoEmpty');
    const formWrap    = document.getElementById('assoFormWrap');
    const hiddenInput = document.getElementById('assoEventIdHidden');

    if (!eventId) {
        listWrap.classList.add('hidden');
        formWrap.classList.add('hidden');
        return;
    }

    hiddenInput.value = eventId;
    listWrap.classList.remove('hidden');
    formWrap.classList.remove('hidden');
    listItems.innerHTML = '';

    const artistes = assoData[eventId] || [];
    if (artistes.length === 0) {
        emptyMsg.classList.remove('hidden');
    } else {
        emptyMsg.classList.add('hidden');
        artistes.forEach(a => {
            const ppBadge = a.pPartie === 'O'
                ? '<span class="ml-1 text-xs bg-orange-100 text-orange-700 px-2 py-0.5 rounded-full">1ère partie</span>'
                : '';
            listItems.innerHTML += `
                <div class="flex items-center gap-2 bg-gray-100 rounded-xl px-4 py-2">
                    <span class="font-medium text-gray-800">${a.nom}</span>
                    ${ppBadge}
                    <form method="POST" class="ml-2" onsubmit="return confirm('Retirer cet artiste ?')">
                        <input type="hidden" name="idAsso" value="${a.idAsso}">
                        <button type="submit" name="delAsso"
                                class="text-red-500 hover:text-red-700 text-lg leading-none font-bold" title="Retirer">✕</button>
                    </form>
                </div>`;
        });
    }
}
</script>
</body>
</html>

