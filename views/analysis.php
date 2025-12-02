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

    .button-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 1rem;
    }

    .button-blue {
        background-color: #3b82f6;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.375rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
        text-decoration: none;
        display: inline-block;
    }

    .button-blue:hover {
        background-color: #2563eb;
    }
    
    .day-container {
        margin-bottom: 50px;
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .type-label {
            color: #f9fafb;
        }

        .extra-list {
            color: #d1d5db;
        }

        .button-blue {
            background-color: #2563eb;
        }

        .button-blue:hover {
            background-color: #1d4ed8;
        }
    }
</style>

<h1>Typen und Extras</h1>

<div class="button-container">
    <a href="<?= '/admin/' . config('secret') ?>" class="button-blue">Zurück</a>
</div>

<?php foreach ($days as $day): ?>
    <div class="day-container">
        <div class="type-label">Insgesamt am <?= $day->day->label() ?>: <?= e($day->total) ?></div>
        
        <div class="list-container">
            <?php foreach ($day->types as $type => $extras): ?>
                <div class="type-label"><?= e($type) ?> (<?= count($extras) ?>)</div>
                <ul class="extra-list">
                    <?php foreach ($extras as $order): ?>
                        <?php if(strlen(trim($order->extra)) > 0): ?>
                            <li><?= e($order->extra) ?></li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            <?php endforeach ?>
        </div>
    </div>
<?php endforeach ?>
