<!-- mon compte (privé) -->
<main class="bg-[#F5F3EF] container mx-auto px-8 py-16">

    <div class="">

        <h1 class="font-display text-5xl mb-8">
            Mon compte (privé)
        </h1>

        <div class="grid lg:grid-cols-2 gap-6">

            <!-- Profil -->
            <div class="bg-white rounded-3xl p-8">

                <?php include "_profile.php"; ?>

            </div>

            <!-- Infos -->
            <div class="bg-white rounded-3xl p-8">

                <h2 class="font-semibold mb-8">
                    Vos informations personnelles
                </h2>

                <div class="space-y-6">

                    <div>
                        <label class="text-sm text-gray-400">
                            Adresse email
                        </label>

                        <input
                            class="w-full h-14 mt-2 bg-[#EEF2F5] rounded-md px-4">
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">
                            Mot de passe
                        </label>

                        <input
                            class="w-full h-14 mt-2 bg-[#EEF2F5] rounded-md px-4"
                            value="********">
                    </div>

                    <div>
                        <label class="text-sm text-gray-400">
                            Pseudo
                        </label>

                        <input
                            class="w-full h-14 mt-2 bg-[#EEF2F5] rounded-md px-4">
                    </div>

                </div>

                <button
                    class="mt-8 h-14 px-10 border border-[#00AC66] rounded-xl text-[#00AC66] font-semibold">
                    Enregistrer
                </button>

            </div>

        </div>

    </div>



    <?php if (Utils::isConnectedUser($user->getId())): ?>
        <p><a href="/?action=book_add">Ajouter un livre</a></p>
    <?php endif; ?>


    <?php if (count($books)): ?>
        <!-- livres desktop -->
        <div class="bg-white rounded-3xl overflow-hidden mt-8 hidden lg:block">

            <table class="w-full">

                <thead>

                    <tr class="border-b border-black/5">

                        <th class="p-5 text-left">Photo</th>
                        <th class="p-5 text-left">Titre</th>
                        <th class="p-5 text-left">Auteur</th>
                        <th class="p-5 text-left">Description</th>
                        <th class="p-5 text-left">Disponibilité</th>
                        <?php if (Utils::isConnectedUser($user->getId())): ?>
                            <th class="p-5 text-left">Action</th>
                        <?php endif; ?>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($books as $book): ?>

                        <tr class="bg-[#F7FAFC]">

                            <td class="p-5">
                                <img
                                    src="/assets/images/covers/<?= $book->getPhoto(); ?>" alt="<?= $book->getTitle(); ?>"
                                    class="w-16 h-16 object-cover">
                            </td>

                            <td class="p-5"><a class="underline" href="/?action=livre&id=<?= $book->getId(); ?>"><?= $book->getTitle(); ?></a></td>

                            <td class="p-5"><?= $book->getAuthor(); ?></td>

                            <td class="max-w-[220px] truncate p-5">
                                <?= mb_substr($book->getComment(), 0, 50); ?>...
                            </td>

                            <td class="p-5">

                                <?php if (!$book->getAvailable()): ?>
                                    <span class="bg-[#F26B4A] text-white text-xs px-2 py-1 rounded-full">
                                        non disponible
                                    </span>
                                <?php else: ?>
                                    <span class="bg-[#6DC5A1] text-white text-xs px-2 py-1 rounded-full">
                                        disponible
                                    </span>
                                <?php endif; ?>

                            </td>

                            <?php if (Utils::isConnectedUser($user->getId())): ?>
                                <td class="p-5">

                                    <a href="/?action=book_edit&id=<?= $book->getId(); ?>" class="underline">
                                        Éditer</a>

                                    <a href="/?action=book_delete&id=<?= $book->getId(); ?>" class="underline text-red-500 ml-4">
                                        Supprimer</a>

                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!-- livres cartes mobile -->
        <div class="space-y-4 lg:hidden">

            <?php foreach ($books as $book): ?>
                <article
                    class="bg-white rounded-3xl p-5">

                    <div class="flex gap-4">

                        <img
                            src="/assets/images/covers/<?= $book->getPhoto(); ?>" alt="<?= $book->getTitle(); ?>"
                            class="w-20 h-20 object-cover">

                        <div>

                            <h3>
                                <a class="underline" href="/?action=livre&id=<?= $book->getId(); ?>"><?= $book->getTitle(); ?></a>
                            </h3>

                            <p class="text-sm text-gray-500">
                                <?= $book->getAuthor(); ?>
                            </p>

                            <?php if (!$book->getAvailable()): ?>
                                <span class="bg-[#F26B4A] text-white text-xs px-2 py-1 rounded-full">
                                    non disponible
                                </span>
                            <?php else: ?>
                                <span class="bg-[#6DC5A1] text-white text-xs px-2 py-1 rounded-full">
                                    disponible
                                </span>
                            <?php endif; ?>

                        </div>

                    </div>

                    <p class="mt-4 text-sm text-gray-600 line-clamp-3">
                        <?= mb_substr($book->getComment(), 0, 150); ?>...
                    </p>

                    <?php if (Utils::isConnectedUser($user->getId())): ?>
                        <div class="flex gap-6 mt-4">

                            <a href="/?action=book_edit&id=<?= $book->getId(); ?>" class="underline">
                                Éditer
                            </a>

                            <a href="/?action=book_delete&id=<?= $book->getId(); ?>" class="underline text-red-500">
                                Supprimer
                            </a>

                        </div>
                    <?php endif; ?>

                </article>
            <?php endforeach; ?>

        </div>

    <?php else: ?>
        <p>Cet utilisateur n'a pas de livre à échanger pour le moment.</p>
    <?php endif; ?>

</main>