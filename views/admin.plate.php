<h1>Bestellungen ({{ $orders->count() }})</h1>

{{ if: $deleted }}
    <div class="notification"><p class="m-0 p-0">Bestellung von <b>{{ $deleted->name }}</b> gelöscht.</p>
        <form action="/admin/restore?id={{ $deleted->id }}" method="post">
            <button class="btn">Wiederherstellen</button>
        </form>
    </div>
{{ if; }}

{{ if: $restored }}
    <div class="notification"><p class="m-0 p-0">Bestellung von <b>{{ $restored->name }}</b> wiederhergestellt</p></div>
{{ if; }}

{{ if: $paid }}
    <div class="notification"><p class="m-0 p-0"><b>{{ $paid->name }}</b> hat {{ $paid->paid ? 'bezahlt' : 'nicht bezahlt' }}.</p></div>
{{ if; }}

<div class="row end mb">
    <a href="/admin/analysis" class="btn">Analyse</a>
    <a href="/admin/toggle-accessibility?__method=post" class="btn"
        style="background-color: {{ perma('accessible', false) ? 'lightgreen' : 'red' }}">
            Zugang umschalten
    </a>
    <a class="btn secondary" href="/">Formular</a>
    <a class="btn warn" href="/logout">Logout</a>
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
            {{ each: $orders->reverse() as $order }}
                <tr>
                    <td>
                        <form action="/admin/toggle-paid" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="{{ $order->id }}">
                            <button type="submit" class="checkbox-button" title="Status wechseln" style="background-color: {{ $order->paid ? 'lightgreen' : 'red' }}"></button>
                        </form>
                    </td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->daysLabel() }}</td>
                    <td>{{ $order->type }}</td>
                    <td>{{ $order->extra }}</td>
                    <td>
                        {{ $order->created_at }}

                        {{ if: $order->created_at !== $order->modified_at }}
                            / {{ $order->modified_at }}
                        {{ if; }}
                    </td>
                    <td>
                        <form action="/admin/delete?id={{ $order->id }}" method="post">
                            <button class="btn warn">Löschen</button>
                        </form>
                    </td>
                </tr>
            {{ each; }}
        </tbody>
    </table>
</div>

<div class="mobile-only column mt">
    {{ each: $orders->reverse() as $order }}
        <div class="card">
            <div class="mb-05"><strong>ID:</strong> {{ $order->id }}</div>
            <div class="mb-05"><strong>Name:</strong> {{ $order->name }}</div>
            <div class="mb-05"><strong>E-Mail:</strong> {{ $order->email }}</div>
            <div class="mb-05"><strong>Tage:</strong> {{ $order->daysLabel() }}</div>
            <div class="mb-05"><strong>Typ:</strong> {{ $order->type }}</div>
            <div class="mb-05"><strong>Extra:</strong> {{ $order->extra }}</div>
            <div class="mb-05"><strong>Erstellt/Geändert:</strong>
                {{ $order->created_at }}

                {{ if: $order->created_at !== $order->modified_at }}
                    / {{ $order->modified_at }}
                {{ if; }}
            </div>
            <div class="row between items-center mt">
                <form action="/admin/toggle-paid" method="post">
                    <input type="hidden" name="id" value="{{ $order->id }}">
                    <button type="submit" class="checkbox-button" title="Status wechseln"
                        style="background-color: {{ $order->paid ? 'lightgreen' : 'red' }}"></button>
                </form>
                <form action="/admin/delete?id={{ $order->id }}" method="post">
                    <button class="btn warn">Löschen</button>
                </form>
            </div>
        </div>
    {{ each; }}
</div>
