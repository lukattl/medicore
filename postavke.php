<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';

require_login();
render_header('Postavke', 'postavke');
?>

<section class="panel">
    <h2>Postavke aplikacije</h2>
    <form class="settings_form">
        <label class="toggle-row">
            <span>
                Email obavijesti
                <small>Podsjetnici za nove nalaze i preporuke.</small>
            </span>
            <input type="checkbox" checked>
        </label>
        <label class="toggle-row">
            <span>
                Jednostavna objašnjenja
                <small>Medicinske pojmove prikazuj kraće i razumljivije</small>
            </span>
            <input type="checkbox" checked>
        </label>
        <label>
            Jezik sučelja
            <select>
                <option>Hrvatski</option>
                <option>English</option>
            </select>
        </label>
        <button class="button secondary" type="button>Spremi postavke</button>
    </form>
</section>
<?php render_footer(); ?>
