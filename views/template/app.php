<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lock Box</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.22/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <div class="mx-auto max-w-screen-lg h-screen flex flex-col">

        <?php require base_path('views/partials/_nav.view.php'); ?>

        <?php require base_path('views/partials/_search.view.php'); ?>



        <div class="h-svh flex py-6 flex-grow">
            <?php require base_path("views/{$view}.view.php"); ?>
        </div>


    </div>





</body>

</html>