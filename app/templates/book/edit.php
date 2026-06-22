<main class="bg-[#F5F3EF] min-h-screen">

    <div class="max-w-[1200px] mx-auto px-6 lg:px-8 py-8 lg:py-12">

        <!-- Retour -->
        <a
            href="/?action=user&id=<?= $_SESSION["idUser"] ?>"
            class="text-sm text-gray-400 hover:text-gray-600 transition"
        >
            &leftarrow; retour
        </a>

        <!-- Titre -->
        <h1 class="font-display text-4xl lg:text-5xl mt-4 mb-8">
            Modifier les informations
        </h1>

        <!-- Card -->
        <div class="bg-white rounded-3xl p-6 lg:p-10">
            <?php include "_form.php"; ?>
        </div>

    </div>

</main>