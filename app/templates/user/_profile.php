<!-- Profil -->
<div class="bg-white rounded-3xl p-16 text-center">

    <img
        src="https://api.dicebear.com/10.x/notionists/svg?backgroundColor=ffbe47&backgroundColorFill=solid&seed=<?= e($user->getAvatar()); ?>"
        alt="Image de profil de <?= e($user->getNickname()); ?>"
        class="w-28 h-28 rounded-full object-cover mx-auto">

    <!-- button
        class="text-sm text-gray-400 underline mt-2">
        modifier
    </button -->

    <hr class="my-8 border-black/5">

    <h2 class="font-display text-3xl">
        <?= e($user->getNickname()); ?>
    </h2>

    <p class="text-gray-400 mt-2">
        Membre depuis <?= Utils::getUserRegistrationTime($user->getCreatedAt()->format('Y-m-d')) ?>
    </p>

    <div class="mt-6">

        <p class="uppercase text-xs tracking-wider">
            Bibliothèque
        </p>

        <p class="font-semibold">
            <?= count($books) ?> livre(s)
        </p>

    </div>

    <!-- message -->

    <?php // on ne peut pas écrire de message à soi-même 
    ?>
    <?php if (!Utils::isConnectedUser($user->getId())): ?>
        <a href="/?action=messages&id1=<?= $_SESSION["idUser"] ?? 0; ?>&id2=<?= $user->getId(); ?>"
            class="inline-block mt-8 p-5 border border-[#00AC66] rounded-xl text-[#00AC66] font-semibold">
            Écrire un message
        </a>
    <?php endif; ?>




</div>