<main class="lg:container lg:mx-auto bg-[#F5F3EF]">

    <!-- Breadcrumb desktop -->
    <div class="hidden lg:block max-w-[1280px] mx-auto px-8 py-6">
        <p class="text-xs text-gray-400">
            <a href="./?action=livres">Nos livres</a> > <?= $book->getTitle(); ?>
        </p>
    </div>

    <!-- Content -->
    <section class="lg:grid lg:grid-cols-2">

        <!-- IMAGE -->
        <div>
            <img
                src="/assets/images/covers/<?= $book->getPhoto(); ?>"
                fetchpriority="high"
                alt="<?= $book->getTitle(); ?>"
                class="w-full aaaspect-5/6 object-cover"
                width="375" height="538">
        </div>

        <!-- CONTENT -->
        <div class="px-6 py-12 lg:px-20 lg:py-16">

            <!-- Title -->
            <h1 class="font-display text-4xl leading-none mb-4">
                <?= $book->getTitle(); ?>
            </h1>

            <p class="text-gray-400 text-md mb-7">
                par <?= $book->getAuthor(); ?>
            </p>

            <div class="w-12 h-px bg-gray-300 mb-7"></div>

            <!-- Description -->
            <div class="mb-12">

                <h2 class="text-[11px] tracking-[0.15em] font-semibold uppercase mb-4">
                    Description
                </h2>

                <div class="space-y-8 text-md leading-relaxed text-[#333]">

                    <?= $book->getComment(); ?>

                </div>

            </div>

            <!-- Owner -->
            <div class="mb-12">

                <h2 class="text-[11px] tracking-[0.15em] font-semibold uppercase mb-4">
                    Propriétaire
                </h2>

                <div class="inline-flex items-center gap-3 bg-white rounded-full p-3 pe-5">

                    <img
                        src="https://api.dicebear.com/10.x/notionists/svg?backgroundColor=ffbe47&backgroundColorFill=solid&seed=<?= $book->getUser()->getAvatar(); ?>"
                        class="w-12 h-12 rounded-full object-cover"
                        alt="">

                    <span class="text-md text-[#333]">
                        <a class="underline" href="?action=user&id=<?= $book->getUser()->getId(); ?>"><?= $book->getUser()->getNickname(); ?></a>
                    </span>

                </div>

            </div>

            <!-- CTA -->
            <?php // on ne peut pas écrire de message à soi-même ?>
            <?php if (isset($_SESSION["idUser"]) && $_SESSION["idUser"] !== $book->getUser()->getId()): ?>
            <a href="/?action=messages&id1=<?= $_SESSION["idUser"] ?? 0; ?>&id2=<?= $book->getUser()->getId(); ?>" class="w-full block text-center bg-[#00AC66] hover:bg-[#00995b] transition text-white px-10 py-4 rounded-lg font-medium">Envoyer un message</a>
            <?php endif; ?>

        </div>

    </section>

</main>