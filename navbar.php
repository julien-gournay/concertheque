<nav class="fixed top-0 left-0 w-full z-50 border-b border-white/20"
     style="background-color: rgba(0,0,0,0.5); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.2);">
<div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="index.php" class="flex items-center space-x-2">
            <img src="https://www.svgrepo.com/show/324422/mic-karaoke.svg" class="h-8 w-8" alt="Logo">
            <span class="text-xl font-bold text-white drop-shadow">Concerts Souvenir</span>
        </a>

        <!-- Menu principal (desktop) -->
        <div class="hidden md:flex space-x-8 text-lg font-medium">
            <a href="index.php" class="text-white hover:text-yellow-300 transition">Home</a>
            <a href="artiste.php" class="text-white hover:text-yellow-300 transition">Artistes</a>
            <a href="event.php" class="text-white hover:text-yellow-300 transition">Événements</a>
            <a href="lieu.php" class="text-white hover:text-yellow-300 transition">Salles</a>
            <!--<a href="top_artists.php" class="text-white hover:text-yellow-300 transition">Top Spotify</a>-->
        </div>

        <!--
        <div class="hidden md:block">
            <a href="php/spotify.php"
               class="hidden md:block px-5 py-2.5 rounded-lg bg-yellow-400 text-gray-900 font-semibold shadow hover:bg-yellow-300 transition-colors duration-300">
                Se connecter
            </a>
        </div> -->

        <!-- Burger (mobile) -->
        <button data-collapse-toggle="navbar-menu" type="button"
                class="md:hidden inline-flex items-center p-2 text-white hover:bg-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/30"
                aria-controls="navbar-menu" aria-expanded="false">
            <span class="sr-only">Ouvrir le menu</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Menu mobile -->
    <div class="hidden md:hidden px-6 pb-4 space-y-3 bg-black/70 backdrop-blur-md" id="navbar-menu">
        <a href="index.php" class="block text-white hover:text-yellow-300">Home</a>
        <a href="artiste.php" class="block text-white hover:text-yellow-300">Artistes</a>
        <a href="event.php" class="block text-white hover:text-yellow-300">Événements</a>
        <a href="lieu.php" class="block text-white hover:text-yellow-300">Salles</a>
        <!--<a href="top_artists.php" class="block text-white hover:text-yellow-300">Top Spotify</a>
        <a href="php/spotify.php" class="block px-4 py-2 rounded-lg bg-yellow-400 text-gray-900 font-semibold text-center shadow hover:bg-yellow-300 transition">
            Se connecter
        </a>-->
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
