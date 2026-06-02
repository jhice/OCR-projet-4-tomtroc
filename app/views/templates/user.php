<main class="container mx-auto">

    <img
        src="https://api.dicebear.com/10.x/notionists/svg?backgroundColor=ffbe47&backgroundColorFill=solid&seed=<?= $user->getAvatar(); ?>"
        class="w-20 h-20 rounded-full object-cover"
        alt="">

    <p><?= $user->getNickname(); ?></p>
    <p>Membre depuis 1 an</p>
    <p>Bibiliothèque</p>
    <p>[ICON] <?= count($books) ?> livre(s)</p>
    <a href="">Écrire un message</button>

        <p>Livres</p>

        <?php if (count($books)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                    </tr>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><img
                                    src="/assets/images/covers/<?= $book->getPhoto(); ?>"
                                    alt="<?= $book->getTitle(); ?>"
                                    class="w-20 h-20 aspect-square object-cover"></td>
                            <td><?= $book->getTitle(); ?></td>
                            <td><?= $book->getAuthor(); ?></td>
                            <td><i><?= $book->getComment(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </thead>
            </table>
        <?php else: ?>
            <p>Cet utilisateur n'a pas de livre à échanger pour le moment.</p>
        <?php endif; ?>

</main>