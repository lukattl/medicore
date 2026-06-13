<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';

ensure_data_store();

if (current_user() !== null) {
    header('Location: dashboard.php');
    exit;
}

$mode = $_GET['mode'] ?? 'login';
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'login';

    if ($action === 'google_demo') {
        login_google_demo();
        header('Location: dashboard.php');
        exit;
    } elseif ($action === 'register') {
        $result = register_user(
            $_POST['username'] ?? '',
            $_POST['email'] ?? '',
            $_POST['password'] ?? '',
            $_POST['full_name'] ?? ''
        );
        $message = $result['message'];
        $messageType = $result['ok'] ? 'success' : 'error';
        $mode = $result['ok'] ? 'login' : 'register';
    } else {
        if (login_user($_POST['username'] ?? '', $_POST['password'] ?? '')) {
            header('Location: dashboard.php');
            exit;
        }

        $message = 'Neispravno korisničko ime ili lozinka.';
        $messageType = 'error';
        $mode = 'login';
    }
}
?>
<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prijava | Medicore</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-page">
    <main class="auth-layout">
        <section class="auth-panel">
            <div class="auth-brand">
                <span class="brand-mark">M</span>
                <span>Medicore</span>
            </div>
            <h1>Razumij svoje nalaze za 60 sekundi</h1>
            <p>AI-pokretana analiza laboratorijskih nalaza s jasnim objašnjenjima na hrvatskom jeziku.</p>
            <a class="button primary auth-cta" href="index.php?mode=register">Kreiraj besplatni račun</a>
            <div class="auth-highlights" aria-label="Funkcionalnosti">
                <span>2 min</span>
                <span>AI 24/7</span>
                <span>Sigurno</span>
            </div>
            <div class="mini-results">
                <article>
                    <div>
                        <strong>Vitamin D</strong>
                        <p>18.5 ng/mL</p>
                    </div>
                    <span class="badge warning">Nizak</span>
                </article>
                <article>
                    <div>
                        <strong>Hemoglobin</strong>
                        <p>14.2 g/dL</p>
                    </div>
                    <span class="badge success">Normalno</span>
                </article>
            </div>
        </section>

        <section class="auth-card" aria-label="Prijava i registracija">
             <div class="tabs" role="tablist">
                <a class="tab <?= $mode !== 'register' ? 'active' : ''; ?>" href="index.php?mode=login">Prijava</a>
                <a class="tab <?= $mode === 'register' ? 'active' : ''; ?>" href="index.php?mode=register">Registracija</a>
            </div>

            <?php if ($message !== ''): ?>
                <div class="alert <?= htmlspecialchars($messageType, ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <?php if ($mode === 'register'): ?>
                <form class="social-form" method="post" action="index.php?mode=register">
                    <input type="hidden" name="action" value="google_demo">
                    <button class="google-button" type="submit">
                        <span class="google-mark">G</span>
                        Nastavi s Google racunom
                    </button>
                </form>

                <div class="auth-divider"><span>ili</span></div>

                <form class="form" method="post" action="index.php?mode=register">
                    <input type="hidden" name="action" value="register">
                    <label>
                        Ime i prezime
                        <input type="text" name="full_name" placeholder="Ana Horvat" autocomplete="name">
                    </label>
                    <label>
                        Korisničko ime
                        <input type="text" name="username" placeholder="ana_horvat" autocomplete="username" required>
                    </label>
                    <label>
                        Email
                        <input type="email" name="email" placeholder="ana@email.com" autocomplete="email" required>
                    </label>
                    <label>
                        Lozinka
                        <input type="password" name="password" placeholder="Najmanje 6 znakova" autocomplete="new-password" required>
                    </label>
                    <button class="button primary" type="submit">Kreiraj račun</button>
                </form>
            <?php else: ?>
                <form class="social-form" method="post" action="index.php">
                    <input type="hidden" name="action" value="google_demo">
                    <button class="google-button" type="submit">
                        <span class="google-mark">G</span>
                        Nastavi s Google računom
                    </button>
                </form>

                <div class="auth-divider"><span>ili</span></div>

                <form class="form" method="post" action="index.php">
                    <input type="hidden" name="action" value="login">
                    <label>
                        Korisničko ime
                        <input type="text" name="username" value="medicore_test" autocomplete="username" required>
                    </label>
                    <label>
                        Lozinka
                        <input type="password" name="password" value="medicore_test" autocomplete="current-password" required>
                    </label>
                    <button class="button primary" type="submit">Prijavi se</button>
                    <p class="hint">Demo profil: <strong>medicore_test</strong> / <strong>medicore_test</strong></p>
                </form>
            <?php endif; ?>
        </section>
    </main>
    <script src="assets/js/app.js"></script>
</body>
</html>
