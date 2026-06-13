<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';

$user = require_login();
render_header('Moj profil', 'profil');
?>

<section class="panel profile-panel">
    <div class="avatar-large"><?= strtoupper(substr($user['username'], 0, 1)); ?></div>
    <div>
        <p class="eyebrow">Korisnički profil</p>
        <h2><?= htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
        <p><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="plain-text">Korisničko ime: <strong><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></strong></p>
    </div>
</section>
