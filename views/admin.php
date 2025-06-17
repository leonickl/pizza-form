<style>
    .table-container {
        overflow-x: auto;
        margin-top: 1rem;
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
    }

    .button-blue:hover {
        background-color: #2563eb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    thead {
        background-color: #f3f4f6;
    }

    th, td {
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

    .checkbox-button {
        height: 40px;
        width: 40px;
        border: none;
        cursor: pointer;
    }

    .card-list {
        display: none;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1rem;
    }

    .card {
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 1rem;
        background: #fff;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .card-item {
        margin-bottom: 0.5rem;
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .warn {
        background-color: #dc2626;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        cursor: pointer;
    }

    .warn:hover {
        background-color: #b91c1c;
    }

    /* Dark mode */
    @media (prefers-color-scheme: dark) {
        thead {
            background-color: #374151;
        }

        th {
            color: #f9fafb;
            border-color: #4b5563;
        }

        td {
            color: #e5e7eb;
            border-color: #374151;
        }

        tr:hover {
            background-color: #1f2937;
        }

        .button-blue {
            background-color: #2563eb;
        }

        .button-blue:hover {
            background-color: #1d4ed8;
        }

        .card {
            background-color: #1f2937;
            border-color: #374151;
            color: #f9fafb;
        }

        .warn {
            background-color: #b91c1c;
        }
    }

    @media (max-width: 768px) {
        table {
            display: none;
        }

        .card-list {
            display: flex;
        }
    }
</style>

<h1>Bestellungen (<?= $orders->count() ?>)</h1>

<?php if (session('deleted')): ?>
    <?php $order = session('deleted') ?>
    <p class="info">Bestellung von <b><?= $order->name ?></b> gelöscht</p>
<?php endif ?>

<?php if (session('paid')): ?>
    <?php $order = session('paid') ?>
    <p class="info"><b><?= e($order->name) ?></b> hat <?= $order->paid ? 'bezahlt' : 'nicht bezahlt' ?>.</p>
<?php endif ?>

<div class="table-container">
    <div class="button-container">
        <form action="/90d13090-fa3b-480f-a6d2-3e06fec20954/analysis" method="get">
            <button class="button-blue">Analyse</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Typ</th>
                <th>Extra</th>
                <th>Erstellt/Geändert</th>
                <th>Bezahlt</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders->reverse() as $order): ?>
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
                        <form action="/90d13090-fa3b-480f-a6d2-3e06fec20954/toggle-paid" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= e($order->id) ?>">
                            <button type="submit" class="checkbox-button" title="Status wechseln" style="background-color: <?= $order->paid ? 'lightgreen' : 'red' ?>"></button>
                        </form>
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

    <div class="card-list">
        <?php foreach ($orders->reverse() as $order): ?>
            <div class="card">
                <div class="card-item"><strong>ID:</strong> <?= e($order->id) ?></div>
                <div class="card-item"><strong>Name:</strong> <?= e($order->name) ?></div>
                <div class="card-item"><strong>Typ:</strong> <?= e($order->type) ?></div>
                <div class="card-item"><strong>Extra:</strong> <?= e($order->extra) ?></div>
                <div class="card-item"><strong>Erstellt/Geändert:</strong>
                    <?= e($order->created_at) ?>
                    <?php if ($order->created_at !== $order->modified_at): ?>
                        / <?= e($order->modified_at) ?>
                    <?php endif ?>
                </div>
                <div class="card-actions">
                    <form action="/90d13090-fa3b-480f-a6d2-3e06fec20954/toggle-paid" method="post">
                        <input type="hidden" name="id" value="<?= e($order->id) ?>">
                        <button type="submit" class="checkbox-button" title="Status wechseln"
                            style="background-color: <?= $order->paid ? 'lightgreen' : 'red' ?>"></button>
                    </form>
                    <form action="/90d13090-fa3b-480f-a6d2-3e06fec20954/delete?id=<?= e($order->id) ?>" method="post">
                        <button class="warn">Löschen</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </div>

</div>
