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

        .checkbox-button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .checkbox-button input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            accent-color: #3b82f6;
            cursor: pointer;
        }
    }

    @media (max-width: 600px) {
        table {
            font-size: 0.9rem;
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
                            <button type="submit" class="checkbox-button" title="Status wechseln">
                                <input type="checkbox" <?= $order->paid ? 'checked' : '' ?> onclick="return false;">
                            </button>
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
</div>
