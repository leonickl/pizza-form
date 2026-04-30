<h1>Papierkorb der Bestellungen ({{ $orders->count() }})</h1>

{{ if: $restored }}
    <div class="notification"><p class="m-0 p-0">Bestellung von <b>{{ $restored->name }}</b> wiederhergestellt</p></div>
{{ if; }}

{{ ==view('admin.nav') }}

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
                <th>Gelöscht</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            {{ each: $orders->reverse() as $order }}
                <tr>
                    <td>
                        <button class="checkbox-readonly" title="Status wechseln" style="background-color: {{ $order->paid ? 'lightgreen' : 'red' }}" readonly></button>
                    </td>
                    <td>{{ $order->id }}</td>
                    <td class="text-wrap">{{ $order->name }}</td>
                    <td class="text-wrap">{{ $order->email }}</td>
                    <td>{{ $order->daysLabel() }}</td>
                    <td>{{ $order->type }}</td>
                    <td class="text-wrap">{{ $order->extra }}</td>
                    <td class="text-wrap">
                        {{ $order->created_at }}

                        {{ if: $order->created_at !== $order->modified_at }}
                            / {{ $order->modified_at }}
                        {{ if; }}
                    </td>
                    <td>{{ $order->deleted_at }}</td>
                    <td>
                        <form action="/admin/restore/{{ $order->id }}" method="post">
                            <button class="btn">Restore</button>
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
            <div class="mb-05 text-wrap"><strong>Name:</strong> {{ $order->name }}</div>
            <div class="mb-05 text-wrap"><strong>E-Mail:</strong> {{ $order->email }}</div>

            {{ if: trim($order->daysLabel()) !== '' }}
                <div class="mb-05 text-wrap"><strong>Tage:</strong> {{ $order->daysLabel() }}</div>
            {{ if; }}

            <div class="mb-05 text-wrap"><strong>Typ:</strong> {{ $order->type }}</div>

            {{ if: trim($order->extra) !== '' }}
                <div class="mb-05 text-wrap"><strong>Extra:</strong> {{ $order->extra }}</div>
            {{ if; }}

            <div class="mb-05 text-wrap"><strong>Erstellt/Geändert:</strong>
                {{ $order->created_at }}

                {{ if: $order->created_at !== $order->modified_at }}
                    / {{ $order->modified_at }}
                {{ if; }}
            </div>

            <div class="mb-05 text-wrap"><strong>Gelöscht:</strong>
                {{ $order->deleted_at }}
            </div>

            <div class="row between items-center mt">
                <form action="/admin/toggle-paid" method="post">
                    <input type="hidden" name="id" value="{{ $order->id }}">
                    <button type="submit" class="checkbox-button" title="Status wechseln"
                        style="background-color: {{ $order->paid ? 'lightgreen' : 'red' }}"></button>
                </form>
                <form action="/admin/restore/{{ $order->id }}" method="post">
                    <button class="btn">Restore</button>
                </form>
            </div>
        </div>
    {{ each; }}
</div>
