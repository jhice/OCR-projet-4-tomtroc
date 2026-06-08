<main>
    <?php foreach ($conversation->getMessages() as $message): ?>
        <p><?= $message->getCreatedAt()->format("Y-m-d H:i:s"); ?></p>
        <p><?= $message->getContent(); ?></p>
    <?php endforeach; ?>
</main>