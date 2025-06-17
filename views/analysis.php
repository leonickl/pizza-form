<style>
    .list-container {
        margin-top: 1rem;
        padding-left: 1rem;
    }

    .type-label {
        font-weight: bold;
        margin-top: 1rem;
        color: #111827;
    }

    .extra-list {
        list-style-type: disc;
        margin-left: 1.5rem;
        color: #374151;
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .type-label {
            color: #f9fafb;
        }

        .extra-list {
            color: #d1d5db;
        }
    }
</style>

<h1>Typen und Extras</h1>

<div class="list-container">
    <?php foreach ($types as $type => $extras): ?>
        <div class="type-label"><?= e($type) ?></div>
        <ul class="extra-list">
            <?php foreach ($extras as $extra): ?>
                <li><?= e($extra) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endforeach ?>
</div>
