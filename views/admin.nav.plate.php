<div class="nav row mb">
    {{ if: url() === '/admin' }}
        <a href="/admin/trash" class="btn">Papierkorb</a>
        <a href="/admin/analysis" class="btn">Analyse</a>
        <a href="/admin/toggle-accessibility?__method=post" class="btn"
            style="background-color: {{ perma('accessible', false) ? 'lightgreen' : 'red' }}">
                Zugang umschalten
        </a>
    {{ else: }}
        <a href="/admin" class="btn">Bestellungen</a>
    {{ if; }}

    <a class="btn secondary" href="/">Formular</a>
    <a class="btn warn" href="/logout">Logout</a>
</div>