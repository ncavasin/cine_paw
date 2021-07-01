<?php if ($notification) : ?>
    <div class=<?= '"notification ' . ($notification_type == SUCCESS ? 'success"' : ($notification_type == ERROR ? 'error"' : 'warn"')) ?>>
        <p ><?= $notification_text ?></p>
    </div>
<?php endif; ?>