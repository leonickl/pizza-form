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
            margin-bottom: 1rem;
        }

        .info p {
            padding: 0;
            margin: 0;
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
        :root {
            --text-light: #545a68ff;
            --thead-background: #f3f4f6;
            --th-color: #111827;
            --td-color: black;
            --tr-background-hover: #f9fafb;
            --tborder: #e5e7eb;

            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --warn: #ff5e5eff;
            --warn-hover: #ff0000ff;

            --card-text: black;
            --card-border: #e5e7eb;
            --card-background: #fff;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --text-light: #d1d5db;
                --thead-background: #374151;
                --th-color: #f9fafb;
                --td-color: #e5e7eb;
                --tr-background-hover: #1f2937;
                --tborder: #4b5563;

                --primary: #2563eb;
                --primary-hover: #1d4ed8;
                --warn: #b91c1c;
                --warn-hover: #ff0000ff;

                --card-text: #f9fafb;
                --card-border: #374151;
                --card-background: #1f2937;
            }
        }

        .row {
            display: flex;
            flex-direction: row;
            gap: 1rem;
        }

        .column {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .end {
            justify-content: flex-end;
        }

        .between {
            justify-content: space-between;
        }

        .items-center {
            align-items: center;
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

        .mb-05 {
            margin-bottom: 0.5rem;
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
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background-color: var(--primary-hover);
            text-decoration: none;
        }

        .btn.warn {
            background-color: var(--warn);
        }

        .btn.warn:hover {
            background-color: var(--warn-hover);
        }

        .text-light {
            color: var(--text-light);
        }

        .text-bold {
            font-weight: bold;
        }

        @media (min-width: 769px) {
            .mobile-only {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .desktop-only {
                display: none !important;
            }
        }

        .card {
            color: var(--card-text);
            border: 1px solid var(--card-border);
            border-radius: 0.5rem;
            padding: 1rem;
            background: var(--card-background);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .w-full {
            width: 100%;  
        }

        .w-min-40 {
            min-width: 40rem;
        }

        table.styled {
            border-collapse: collapse;
        }

        table.styled thead {
            background-color: var(--thead-background);
        }

        table.styled th {
            border-bottom: 1px var(--tborder) solid;
            color: var(--th-color);
            text-align: left;
            padding: 0.75rem;
        }

        table.styled td {
            border-bottom: 1px var(--tborder) solid;
            color: var(--td-color);
            text-align: left;
            padding: 0.75rem;
        }

        table.styled tr:hover {
            background-color: var(--tr-background-hover);
        }
    </style>
</head>

<body>
    <main>
        <?= $slot ?>
    </main>
</body>

</html>