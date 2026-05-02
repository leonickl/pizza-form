<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{ each: config('css') as $file }}
        <link rel="stylesheet" href="{{ route('css', file: $file) }}">
    {{ each; }}

    <title>{{ config('title') }}</title>
</head>

<body>
    <main>
        {{ ==$slot }}
    </main>
</body>

</html>
