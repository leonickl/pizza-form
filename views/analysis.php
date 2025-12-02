<h1>Typen und Extras</h1>

<div class="row end mb">
    <a href="<?= '/admin/' . config('secret') ?>" class="btn">Zurück</a>
</div>

<?php foreach ($days as $day): ?>
    <div class="mb-3">
        <div class="text-bold mt">Insgesamt am <?= $day->day->label() ?>: <?= e($day->total) ?></div>
        
        <div class="mt pl">
            <?php foreach ($day->types as $type => $extras): ?>
                <div class="text-bold mt"><?= e($type) ?> (<?= count($extras) ?>)</div>
                <ul class="text-light ml-2 extra-list">
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
