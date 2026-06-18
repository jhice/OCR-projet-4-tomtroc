<!-- mon compte (privé) -->
<main class="bg-[#F5F3EF] container mx-auto px-8 py-16">

    <?php if (Utils::isConnectedUser($user->getId())): ?>
        <h1 class="font-display text-5xl mb-8">
            Mon compte
        </h1>
    <?php endif; ?>

    <?php if (Utils::isConnectedUser($user->getId())): ?>
        <div class="grid lg:grid-cols-2 gap-6">
    <?php else: ?>
        <div class="grid gap-8 lg:grid-cols-[340px_1fr]">
    <?php endif; ?>

        <?php include "_profile.php"; ?>
        <?php include "_informations.php"; ?>
        <?php include "_books.php"; ?>
        
    </div>

</main>