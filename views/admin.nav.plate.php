<div class="nav row mb">
    {{ if: url() === route('orders') }}
        <a href="{{ route('trash') }}" class="btn">Papierkorb</a>
        <a href="{{ route('analysis') }}" class="btn">Analyse</a>
        <a href="{{ route('toggle-access') }}?__method=post" class="btn"
            style="background-color: {{ perma('accessible', false) ? 'lightgreen' : 'red' }}">
                Zugang umschalten
        </a>
    {{ else: }}
        <a href="{{ route('orders') }}" class="btn">Bestellungen</a>
    {{ if; }}

    <a class="btn secondary" href="{{ route('main') }}">Formular</a>
    <a class="btn warn" href="{{ route('logout') }}">Logout</a>
</div>