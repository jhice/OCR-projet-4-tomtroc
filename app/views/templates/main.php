<?php

/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?><!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tom Troc</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400&family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet">
    <!-- site CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- JavaScript -->
    <script src="./assets/js/site.js" defer></script>
</head>

<body class="bg-[#F5F3EF] text-[#222]">

    <!-- HEADER -->
    <header class="w-full border-b border-black/5 bg-[#F5F3EF] relative">
        <div class="max-w-7xl px-5 lg:w-5/6 mx-auto">

            <div class="flex items-center justify-between h-20">

                <!-- LOGO -->
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-md bg-[#00AC66] flex items-center justify-center text-white font-semibold text-xl">
                        TT
                    </div>

                    <span class="text-[#00AC66] text-2xl font-display">
                        Tom Troc
                    </span>

                    <!-- DESKTOP NAV -->
                    <nav class="hidden lg:flex items-center gap-10 ml-16 mt-2 text-sm">
                        <a href="./" class="hover:text-[#00AC66] transition">Accueil</a>
                        <a href="./?action=livres" class="hover:text-[#00AC66] transition">Nos livres à l’échange</a>
                    </nav>
                </div>

                <!-- DESKTOP RIGHT -->
                <div class="hidden lg:flex items-center gap-10 mt-2 text-sm">
                    <?php if (isset($_SESSION['user'])): ?>
                    <a href="#">Messagerie</a>
                    <a href="/?action=user&id=<?= $_SESSION["idUser"]; ?>">Mon compte</a>
                    <a href="/?action=logout">Déconnexion</a>
                    <?php else : ?>
                    <a href="/?action=login">Connexion</a>
                    <a href="/?action=register">Inscription</a>
                    <?php endif; ?>
                </div>

                <!-- MOBILE BURGER -->
                <button id="burger-btn" class="lg:hidden flex flex-col gap-1.5 z-50" aria-label="Ouvrir le menu">
                    <span class="w-6 h-[2px] bg-black transition-all duration-300"></span>
                    <span class="w-6 h-[2px] bg-black transition-all duration-300"></span>
                    <span class="w-6 h-[2px] bg-black transition-all duration-300"></span>
                </button>

            </div>

            <!-- MOBILE MENU -->
            <div id="mobile-menu"
                class="lg:hidden absolute top-full left-0 w-full bg-[#F5F3EF] border-t border-black/5 hidden shadow-sm">

                <nav class="flex flex-col px-5 py-6 text-base">

                    <a href="./" class="pb-4 border-b border-black/5">
                        Accueil
                    </a>

                    <a href="./?action=livres" class="py-4 border-b border-black/5">
                        Nos livres à l’échange
                    </a>

                    <a href="#" class="py-4 border-b border-black/5">
                        Messagerie
                    </a>

                    <a href="#" class="py-4 border-b border-black/5">
                        Mon compte
                    </a>

                    <a href="./?action=login" class="pt-4">
                        Connexion
                    </a>

                </nav>

            </div>

        </div>
    </header>

    <?= $content /* Ici est affiché le contenu réel de la page, la balise *main* doit s'y trouver. */ ?>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-black/5 py-5">
        <div class="container-custom mx-auto px-5 lg:px-8">

            <div class="">

                <div class="flex items-center flex-col gap-5 md:flex-row md:gap-10 md:justify-end text-sm text-gray-500">
                    <a href="#">Politique de confidentialité</a>
                    <a href="#">Mentions légales</a>
                    <a href="#">Tom Troc©</a>
                    <div class="text-[#00AC66] font-semibold text-xl">
                        TT
                    </div>
                </div>


            </div>

        </div>
    </footer>

</body>

</html>