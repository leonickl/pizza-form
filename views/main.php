<style>
    label {
        display: block;
        margin: 1rem 0 0.3rem;
        font-weight: bold;
    }

    .required::after {
        content: " *";
        color: red;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #fff;
        color: #111;
    }

    .radio-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .radio-group label {
        display: flex;
        align-items: center;
        font-weight: normal;
        gap: 0.5rem;
        cursor: pointer;
    }

    .radio-group input[type="radio"] {
        accent-color: #3b82f6;
    }

    .checkbox-group {
        display: flex;
        flex-direction: row;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .checkbox-group label {
        display: flex;
        align-items: center;
        font-weight: normal;
        gap: 0.5rem;
        cursor: pointer;
    }

    .checkbox-group input[type="checkbox"] {
        accent-color: #3b82f6;
    }

    button {
        margin-top: 1.5rem;
        padding: 0.7rem 1.5rem;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        background-color: #3b82f6;
    }

    button:hover {
        background-color: #2563eb;
    }

    /* Responsive tweaks */
    @media (max-width: 600px) {

        input[type="text"],
        textarea {
            font-size: 1rem;
        }

        button {
            width: 100%;
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        label {
            color: #f3f4f6;
        }

        input[type="text"],
        textarea {
            background-color: #1f2937;
            border-color: #4b5563;
            color: #f9fafb;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9ca3af;
        }

        .radio-group label {
            color: #d1d5db;
        }

        button {
            background-color: #60a5fa;
        }

        button:hover {
            background-color: #3b82f6;
        }
    }
</style>

<form action="<?= ($embedded ?? false) ? '/?embedded' : '/' ?>" method="post">
    <h1>Pizza bestellen</h1>

    <?php if ($order): ?>
        <div class="info">
            <p>Bestellung aufgenommen für
                <b><?= $order->name ?></b>: <?= $order->type ?>,
                <?= $order->extra ?? '---' ?>,
                <?= $order->daysLabel() ?></p>
        </div>
    <?php endif ?>

    <label for="name" class="required">Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email" class="required">E-Mail-Adresse</label>
    <input type="text" id="email" name="email" required>

    <label>Tag</label>
    <div class="checkbox-group">
        <?php foreach(App\DayOfWeek::all() as $day): ?>
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
    <textarea id="extra" name="extra" rows="4" placeholder="Optional..."></textarea>

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

    <p></p>

    <button type="submit" class="primary">Bestellen</button>
</form>