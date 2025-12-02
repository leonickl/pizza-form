<h1>Bestellungen (<?= $orders->count() ?>)</h1>

<?php if ($deleted): ?>
    <div class="notification"><p class="m-0 p-0">Bestellung von <b><?= $deleted->name ?></b> gelöscht.</p>
        <form action="<?= '/admin/' . config('secret') ?>/restore?id=<?= e($deleted->id) ?>" method="post">
            <button class="btn">Wiederherstellen</button>
        </form>
    </div>
<?php endif ?>

<?php if ($restored): ?>
    <div class="notification"><p class="m-0 p-0">Bestellung von <b><?= $restored->name ?></b> wiederhergestellt</p></div>
<?php endif ?>

<?php if ($paid): ?>
    <?php $order = $paid ?>
    <div class="notification"><p class="m-0 p-0"><b><?= e($order->name) ?></b> hat <?= $order->paid ? 'bezahlt' : 'nicht bezahlt' ?>.</p></div>
<?php endif ?>

<div class="row end mb">
    <form action="<?= '/admin/' . config('secret') ?>/analysis" method="get">
        <button class="btn">Analyse</button>
    </form>

    <form action="<?= '/admin/' . config('secret') ?>/toggle-accessibility" method="post">
        <button class="btn" type="submit" style="background-color: <?= perma('accessible', false) ? 'lightgreen' : 'red' ?>">Zugang umschalten</button>
    </form>
</div>

<div class="desktop-only overflow-x-auto">
    <table class="styled w-full w-min-40">
        <thead>
            <tr>
                <th>Bezahlt</th>
                <th>ID</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Tage</th>
                <th>Typ</th>
                <th>Extra</th>
                <th>Erstellt/Geändert</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($orders->reverse() as $order): ?>
                <tr>
                    <td>
                        <form action="<?= '/admin/' . config('secret') ?>/toggle-paid" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= e($order->id) ?>">
                            <button type="submit" class="checkbox-button" title="Status wechseln" style="background-color: <?= $order->paid ? 'lightgreen' : 'red' ?>"></button>
                        </form>
                    </td>
                    <td><?= e($order->id) ?></td>
                    <td><?= e($order->name) ?></td>
                    <td><?= e($order->email) ?></td>
                    <td><?= e($order->daysLabel()) ?></td>
                    <td><?= e($order->type) ?></td>
                    <td><?= e($order->extra) ?></td>
                    <td>
                        <?= e($order->created_at) ?>
                        <?php if ($order->created_at !== $order->modified_at): ?>
                            / <?= e($order->modified_at) ?>
                        <?php endif ?>
                    </td>
                    <td>
                        <form action="<?= '/admin/' . config('secret') ?>/delete?id=<?= e($order->id) ?>" method="post">
                            <button class="btn warn">Löschen</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="mobile-only column mt">
    <?php foreach ($orders->reverse() as $order): ?>
        <div class="card">
            <div class="mb-05"><strong>ID:</strong> <?= e($order->id) ?></div>
            <div class="mb-05"><strong>Name:</strong> <?= e($order->name) ?></div>
            <div class="mb-05"><strong>E-Mail:</strong> <?= e($order->email) ?></div>
            <div class="mb-05"><strong>Tage:</strong> <?= e($order->daysLabel()) ?></div>
            <div class="mb-05"><strong>Typ:</strong> <?= e($order->type) ?></div>
            <div class="mb-05"><strong>Extra:</strong> <?= e($order->extra) ?></div>
            <div class="mb-05"><strong>Erstellt/Geändert:</strong>
                <?= e($order->created_at) ?>
                <?php if ($order->created_at !== $order->modified_at): ?>
                    / <?= e($order->modified_at) ?>
                <?php endif ?>
            </div>
            <div class="row between items-center mt">
                <form action="<?= '/admin/' . config('secret') ?>/toggle-paid" method="post">
                    <input type="hidden" name="id" value="<?= e($order->id) ?>">
                    <button type="submit" class="checkbox-button" title="Status wechseln"
                        style="background-color: <?= $order->paid ? 'lightgreen' : 'red' ?>"></button>
                </form>
                <form action="<?= '/admin/' . config('secret') ?>/delete?id=<?= e($order->id) ?>" method="post">
                    <button class="btn warn">Löschen</button>
                </form>
            </div>
        </div>
    <?php endforeach ?>
</div>
