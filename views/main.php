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

    <?php if (session('order')): ?>
        <?php $order = session('order') ?>

        <p class="info">Bestellung aufgenommen für <b><?= $order->name ?></b>: <?= $order->type ?>,
            <?= $order->extra ?? '---' ?>
        </p>
    <?php endif ?>

    <label for="name" class="required">Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email" class="required">E-Mail-Adresse</label>
    <input type="text" id="email" name="email" required>

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

    <label for="wünsche">Sonderwünsche</label>
    <textarea id="wünsche" name="extra" rows="4" placeholder="Optional..."></textarea>

    <button type="submit" class="primary">Bestellen</button>
</form>