<main class="container mx-auto bg-[#F5F3EF]">

    <div class="lg:flex">

        <!-- SIDEBAR -->
        <aside class="w-full lg:w-[320px] bg-[#F8F7F5] border-r border-black/5">

            <div class="p-8">
                <h1 class="font-display text-5xl mb-10">
                    Messagerie
                </h1>
            </div>

            <!-- Conversations -->
            <?php foreach ($userConversations as $userConversation): ?>
                <a href="/?action=messages&id1=<?= $userConversation->user1_id ?>&id2=<?= $userConversation->user2_id ?>"
                    class="flex items-start gap-4 px-8 py-5 hover:bg-gray-50 transition">

                    <img
                        src="https://api.dicebear.com/10.x/notionists/svg?backgroundColor=ffbe47&backgroundColorFill=solid&seed=<?= $userConversation->avatar; ?>"
                        class="w-12 h-12 rounded-full object-cover"
                        alt="Avatar du profil de <?= $userConversation->nickname; ?>">

                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-medium">
                                <?= $userConversation->nickname; ?>
                            </span>
                            <span class="text-sm text-gray-500">
                                <?= date("H:i", strtotime($userConversation->created_at)); ?>
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm truncate">
                            <?= mb_substr($userConversation->content, 0, 25); ?>...
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>

        </aside>

        <!-- CHAT -->
        <section class="flex-1 flex flex-col min-h-[700px]">

            <!-- Header -->
            <div class="px-6 lg:px-10 py-8">

                <div class="flex items-center gap-4">

                    <img
                        src="https://api.dicebear.com/10.x/notionists/svg?backgroundColor=ffbe47&backgroundColorFill=solid&seed=<?= $recipient->getAvatar(); ?>"
                        class="w-14 h-14 rounded-full object-cover"
                        alt="">

                    <span class="font-semibold text-xl">
                        <?= $recipient->getNickname(); ?>
                    </span>

                </div>

            </div>

            <!-- Messages -->
            <div class="flex-1 px-6 lg:px-10 pb-10">

                <?php if (count($conversation->getMessages()) > 0): ?>

                    <?php foreach ($conversation->getMessages() as $message): ?>

                        <?php if ($message->getSenderId() !== $_SESSION["idUser"]): ?>
                        <!-- Message reçu -->
                        <div class="max-w-xl mb-12">
                            <div class="flex items-center gap-2 mb-3">
                                <img
                                    src="https://api.dicebear.com/10.x/notionists/svg?backgroundColor=ffbe47&backgroundColorFill=solid&seed=<?= $recipient->getAvatar(); ?>"
                                    class="w-6 h-6 rounded-full object-cover"
                                    alt="">
                                <span class="text-gray-400 text-sm">
                                    <?= $message->getCreatedAt()->format("d.m | H:i"); ?>
                                </span>
                            </div>
                            <div class="bg-white rounded px-5 py-4">
                                <?= $message->getContent(); ?>
                            </div>
                        </div>

                        <?php else: ?>
                        <!-- Message envoyé -->
                        <div class="flex justify-end mb-12">
                            <div class="max-w-xl">
                                <div class="text-right text-gray-400 text-sm mb-3">
                                    <?= $message->getCreatedAt()->format("d.m | H:i"); ?>
                                </div>
                                <div class="bg-[#EEF2F5] rounded px-5 py-4">
                                    <?= $message->getContent(); ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>La discussion est vide.</p>
                <?php endif; ?>

            </div>

            <!-- Composer -->
            <div class="px-6 lg:px-10 pb-10">
                <form action="/?action=write" method="post" class="flex flex-col sm:flex-row gap-4">

                    <input type="hidden" name="conversation-id" value="<?= $conversation->getId(); ?>">
                    <input type="hidden" name="recipient-id" value="<?= $recipient->getId(); ?>">

                    <input
                        type="text" name="content"
                        placeholder="Tapez votre message ici..."
                        class="flex-1 h-14 rounded-lg bg-white px-6 outline-none border border-transparent focus:border-[#00AC66]">

                    <button
                        type="submit"
                        class="h-14 px-10 rounded-xl bg-[#00AC66] text-white font-semibold hover:bg-[#00995B] transition">

                        Envoyer

                    </button>

                </form>
            </div>
        </section>
    </div>
</main>