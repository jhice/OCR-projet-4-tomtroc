<main class="container mx-auto">

    <img
        src="https://api.dicebear.com/10.x/notionists/svg?backgroundColor=ffbe47&backgroundColorFill=solid&seed=<?= $user->getAvatar(); ?>"
        class="w-20 h-20 rounded-full object-cover"
        alt="">

    <p><?= $user->getNickname(); ?> (id:<?= $user->getId(); ?>)</p>
    <p>Membre depuis 1 an</p>
    <p>Bibiliothèque</p>
    <p>[ICON] <?= count($books) ?> livre(s)</p>
    <a href="/?action=messages&id1=<?= $_SESSION["idUser"]; ?>&id2=<?= $user->getId(); ?>">Écrire un message</a>

        <p>Livres</p>

        <?php if (count($books)): ?>
            <table class="bg-white border-separate border-spacing-8 border-gray-400 dark:border-gray-500 mb-20">
                <thead>
                    <tr>
                        <th class="text-left">Photo</th>
                        <th class="text-left">Titre</th>
                        <th class="text-left">Auteur</th>
                        <!-- <th class="text-left">Description</th> -->
                        <th class="text-left">Disponibilité</th>
                        <th class="text-left">Action</th>
                    </tr>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><img
                                    src="/assets/images/covers/<?= $book->getPhoto(); ?>"
                                    alt="<?= $book->getTitle(); ?>"
                                    class="w-20 h-20 aspect-square object-cover"></td>
                            <td><a class="underline" href="/?action=livre&id=<?= $book->getId(); ?>"><?= $book->getTitle(); ?></a></td>
                            <td><?= $book->getAuthor(); ?></td>
                            <!-- <td><i><?= substr($book->getComment(), 0, 50); ?>...</i></td> -->
                            <td>
                                <?php if (!$book->getAvailable()): ?>
                                    <span class="bg-[#F26B4A] text-white text-[10px] px-2 py-1 rounded-full">
                                        non disponible
                                    </span>
                                <?php else: ?>
                                    <span class="bg-[#6DC5A1] text-white text-[10px] px-2 py-1 rounded-full">
                                        disponible
                                    </span>
                                <?php endif; ?>

                            </td>
                            <td>
                                <a class="underline" href="/action=book_edit&id=<?= $book->getId(); ?>">Éditer</a>
                                <a class="underline text-[#CB2D2D]" href="/action=book_delete&id=<?= $book->getId(); ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </thead>
            </table>
        <?php else: ?>
            <p>Cet utilisateur n'a pas de livre à échanger pour le moment.</p>
        <?php endif; ?>

</main>