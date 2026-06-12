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
            Ajouter un livre
        </h1>

        <!-- Card -->
        <div class="bg-white rounded-3xl p-6 lg:p-10">

            <form action="/?action=book_add_post&id=<?= $book->getId(); ?>" method="post" enctype="multipart/form-data"
                class="grid lg:grid-cols-[380px_1fr] gap-10 lg:gap-16"
            >

                <!-- PHOTO -->
                <div>

                    <label class="block text-sm text-gray-400 mb-3">
                        Photo
                    </label>

                    <img
                        src="/assets/images/covers/<?= $book->getPhoto(); ?>"
                        alt=""
                        class="w-full object-cover"
                    >

                    <div class="flex flex-col justify-end mt-3">

                        <input id="upload-1" type="file" name="photo" class="w-full text-slate-600 font-medium text-sm border border-slate-200 rounded-md cursor-pointer
                            focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500
                            file:cursor-pointer file:border-0 file:py-2 file:px-3 file:mr-4
                            file:bg-gray-100 hover:file:bg-gray-200 file:text-slate-500
                            dark:text-slate-400 dark:border-neutral-700 dark:file:bg-neutral-800 dark:hover:file:bg-neutral-700" />

                    </div>

                </div>

                <!-- FORM -->
                <div>

                    <!-- TITRE -->
                    <div class="mb-6">

                        <label class="block text-sm text-gray-400 mb-2">
                            Titre
                        </label>

                        <input
                            type="text" name="title" id="title"
                            value="<?= $book->getTitle(); ?>"
                            class="w-full h-14 bg-[#EEF2F5] rounded-md px-4 outline-none"
                        >

                    </div>

                    <!-- AUTEUR -->
                    <div class="mb-6">

                        <label class="block text-sm text-gray-400 mb-2">
                            Auteur
                        </label>

                        <input
                            type="text" name="author" id="author"
                            value="<?= $book->getAuthor(); ?>"
                            class="w-full h-14 bg-[#EEF2F5] rounded-md px-4 outline-none"
                        >

                    </div>

                    <!-- COMMENTAIRE -->
                    <div class="mb-6">

                        <label class="block text-sm text-gray-400 mb-2">
                            Commentaire
                        </label>

                        <textarea name="comment" id="comment"
                            rows="12"
                            class="w-full bg-[#EEF2F5] rounded-md p-4 outline-none resize-none"
                        ><?= $book->getComment(); ?></textarea>

                    </div>

                    <!-- DISPONIBILITE -->
                    <div class="mb-8">

                        <label class="block text-sm text-gray-400 mb-2">
                            Disponibilité
                        </label>

                        <select name="available" id="available"
                            class="w-full h-14 bg-[#EEF2F5] rounded-md px-4 outline-none"
                        >
                            <option value="1" <?= $book->getAvailable() ? "selected" : "" ?>>disponible</option>
                            <option value="0" <?= !$book->getAvailable() ? "selected" : "" ?>>non disponible</option>
                        </select>

                    </div>

                    <!-- BOUTON -->
                    <button
                        type="submit"
                        class="w-full lg:w-[300px] h-14 bg-[#00AC66] hover:bg-[#00995b] transition text-white font-semibold rounded-xl"
                    >
                        Valider
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>