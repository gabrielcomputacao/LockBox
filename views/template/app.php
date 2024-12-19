<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Wise</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-stone-950 text-stone-200">

    <header class=" bg-stone-900 shadow-lg">
        <nav class="flex justify-between py-4 mx-auto max-w-screen-lg">

            <div class="font-bold text-xl tracking-wide">
                Book Wise
            </div>



            <ul>
                <li>
                    <?php if (isset($_SESSION['auth'])): ?>

                        <a class="hover:underline" href="/lockbox/logout">

                            <?= $_SESSION['auth']->nome ?>
                        </a>

                    <?php else: ?>

                        <a class="hover:underline" href="/lockbox/login">Fazer Login</a>

                    <?php endif; ?>
                </li>
            </ul>



        </nav>
    </header>

    <main class="mx-auto max-w-screen-lg space-y-6">

        <?php if ($message = flash()->get('message')): ?>

            <div class="border-green-800 bg-green-900 text-green-400 px-4 py-2 rounded-md border-2">
                <?= $message ?>
            </div>

        <?php endif; ?>

        <h1 class="font-bold text-lg mt-6">Explorar</h1>


        <?php require "../views/{$view}.view.php";  ?>


    </main>

</body>

</html>