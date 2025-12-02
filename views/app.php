<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizze</title>
    <style>
        /* Reset & base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: <?= ($embedded ?? false) ? 'black' : '#f9fafb' ?>;
            color: #333;
            line-height: 1.6;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }

        main {
            background: #ffffff;
            max-width: 70vw;
            width: 100%;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        h1,
        h2,
        h3 {
            margin-bottom: 1rem;
            color: #111827;
        }

        p {
            margin-bottom: 1rem;
        }

        a {
            color: #3b82f6;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .info {
            background: #b1ecff;
            padding: 8px;
            border: 1px solid blue;
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-content: center;
        }

        .info p {
            padding: 0;
            margin: 0;
        }

        button {
            margin-top: 1.5rem;
            padding: 0.7rem 1.5rem;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button.primary {
            background-color: #3b82f6;
        }

        button.primary:hover {
            background-color: #2563eb;
        }

        button.warn {
            background-color: rgb(255, 94, 94);
        }

        button.warn:hover {
            background-color: rgb(255, 0, 0);
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            body {
                padding: 1rem;
            }

            main {
                padding: 1.5rem;
            }

            main {
                max-width: 100vw;
            }
        }

        /* Dark mode styles */
        @media (prefers-color-scheme: dark) {
            body {
                background: <?= ($embedded ?? false) ? 'black' : '#111827' ?>;
                color: #e5e7eb;
            }

            main {
                background: #1f2937;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }

            h1,
            h2,
            h3 {
                color: #f9fafb;
            }

            a {
                color: #60a5fa;
            }

            .info {
                background: #2563eb;
                border-color: #3b82f6;
                color: #e0f2fe;
            }

            button.primary {
                background-color: #60a5fa;
            }

            button.primary:hover {
                background-color: #3b82f6;
            }

            button.warn {
                background-color: rgb(255, 94, 94);
            }

            button.warn:hover {
                background-color: rgb(255, 0, 0);
            }
        }
    </style>


    <style>

        * {
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --text-light: #545a68ff;
        }

        @media (prefers-color-scheme: dark) {
            * {
                --primary: #2563eb;
                --primary-hover: #1d4ed8;
                --text-light: #d1d5db;
            }
        }

        .row {
            display: flex;
            gap: 1rem;
        }

        .end {
            justify-content: flex-end;
        }

        .mb {
            margin-bottom: 1rem;
        }

        .mb-3 {
            margin-bottom: 3rem;
        }

        .mt {
            margin-top: 1rem;
        }

        .ml-2 {
            margin-left: 2rem;
        }

        .pl {
            padding-left: 1rem;
        }

        .btn {
            background-color: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background-color: var(--primary-hover);
            text-decoration: none;
        }

        .text-light {
            color: var(--text-light);
        }

        .text-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <main>
        <?= $slot ?>
    </main>
</body>

</html>