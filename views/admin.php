<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    thead {
        background-color: #f3f4f6;
    }

    th,
    td {
        text-align: left;
        padding: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        border-bottom: 2px solid #e5e7eb;
        color: #111827;
    }

    tr:hover {
        background-color: #f9fafb;
    }
</style>

<h1>Bestellungen</h1>

<?php if (session('deleted')): ?>
    <?php $order = session('deleted') ?>

    <p class="info">Bestellung von <b><?= $order->name ?></b> gelöscht</p>
<?php endif ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Typ</th>
            <th>Extra</th>
            <th>Erstellt/Geändert</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders->reverse()->toArray() as $order): ?>
            <tr>
                <td><?= e($order->id) ?></td>
                <td><?= e($order->name) ?></td>
                <td><?= e($order->type) ?></td>
                <td><?= e($order->extra) ?></td>
                <td>
                    <?= e($order->created_at) ?>

                    <?php if ($order->created_at !== $order->modified_at): ?>
                        / <?= e($order->modified_at) ?>
                    <?php endif ?>
                </td>
                <td>
                    <form action="/90d13090-fa3b-480f-a6d2-3e06fec20954/delete?id=<?= e($order->id) ?>" method="post">
                        <button class="warn">Löschen</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>