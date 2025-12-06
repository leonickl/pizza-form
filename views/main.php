<form action="/" method="post">
    <h1>Pizza bestellen</h1>

    <?php if ($order): ?>
        <div class="notification">
            <p>Bestellung aufgenommen für
                <b><?= $order->name ?></b>: <?= $order->type ?>,
                <?= $order->extra ?? '---' ?>,
                <?= $order->daysLabel() ?></p>
        </div>
    <?php endif ?>

    <label for="name" class="required">Name</label>
    <input type="text" id="name" name="name" required minlength="3" maxlength="40">

    <label for="email" class="required">E-Mail-Adresse</label>
    <input type="text" id="email" name="email" required minlength="6" maxlength="50">

    <label>Tag</label>
    <div class="checkbox-group">
        <?php foreach(App\Day::all() as $day): ?>
            <label>
                <input type="checkbox" name="days[<?= $day->name ?>]" value="<?= $day->value ?>">
                <?= $day->label() ?>
            </label>
        <?php endforeach ?>
    </div>

    <label class="required">Pizza</label>
    <div class="radio-group">
        <label>
            <input type="radio" name="type" value="Vegan" required>
            Vegan
        </label>
        <label>
            <input type="radio" name="type" value="Vegetarisch">
            Vegetarisch
        </label>
        <label>
            <input type="radio" name="type" value="Alles">
            Alles
        </label>
    </div>

    <label for="extra">Sonderwünsche</label>
    <textarea id="extra" name="extra" rows="4" placeholder="Optional..." maxlength="300"></textarea>

    <label for="agb" class="required">Hinweise</label>
    <p>Wer seine Bestellung für einen Tag stornieren möchte, macht das bitte
        <em>spätestens am Vorabend</em> um 18 Uhr per E-Mail
        (<a href="mailto:pizza@hardchor-passau.de">pizza@hardchor-passau.de</a>)
        oder auf WhatsApp (01522 8751413). Wer für zwei Tage bestellt hat, bitte den
        Gesamtbetrag <em>auf einmal</em> bezahlen und nicht zweimal extra.</p>
    <label style="font-weight: normal">
        <input type="checkbox" id="agb" name="agb" required>
        Habe ich zur Kenntnis genommen.
    </label>

    <button type="submit" class="btn mt-2">Bestellen</button>
</form>