<?php

use App\Nav;

function head(string $heading): string
{
    $nav = new Nav;

    return "<div class=\"row between\">
        <h1>$heading</h1>
        <div>
            <div class=\"nav row mb\">$nav</div>
        </div>
    </div>";
}
