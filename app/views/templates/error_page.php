<?php

/**
 * Template pour afficher une page d'erreur.
 */
?>

<main>
    <!-- HERO -->
    <section class="pb-14 lg:py-28">
        <div class="container-custom mx-auto lg:px-8">

            <div class="flex flex-col lg:flex-row gap-10 items-center justify-center">

                <!-- TEXT -->
                <div class="max-w-md mx-auto px-5 lg:mx-0 order-2 lg:order-1">

                    <h1 class="font-display text-4xl leading-tight mb-6">
                        ¯\_(ツ)_/¯<br><?= $errorMessage ?>
                    </h1>

                    <!-- <p class="text-[#555] leading-relaxed mb-8">
                        Nous sommes informés du problème et mettons tout en oeuvre pour y remédier.
                    </p>

                    <a href="index.php?action=home">Retour à la page d'accueil</a> -->

                </div>
            </div>
        </div>
    </section>
</main>