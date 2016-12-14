<h2><?= $discussion['user2Login'] ?></h2>

<?php foreach($messages as $message): ?>
    <p class="<?= $message['type'] ?>">
        <?= $message['contenu'] ?>
        <span class="msgInfo">
            <?= dateIntelligente($message['dateEnvoi']) ?>
        </span>
    </p>
<?php endforeach; ?>

<?php if($discussion['user2Id']): ?>
    <form method="post" action="">
        <p>
            <textarea rows="7" name="message"></textarea>
        </p>

        <p><input type="submit" value="Envoyer" /></p>
    </form>
<?php endif; ?>
