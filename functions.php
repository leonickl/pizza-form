<?php

use App\Nav;

function head(string $heading): string
{
    $nav = new Nav;

    return "<div class=\"row wrap between\">
        <h1>".e($heading)."</h1>
        <div>
            <div class=\"row wrap mb\">$nav</div>
        </div>
    </div>";
}
