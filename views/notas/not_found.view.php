<div class="menu bg-base-300 rounded-l-box w-56 flex flex-col divide-y divide-base-100">

    <?php foreach ($notas as $key => $nota): ?>
        <a
            href="/notas?id=<?= $nota->id ?>"
            class="w-full p-2 cursor=pointer hover:bg-base-200 
            <?php if ($key == 0): ?> rounded-tl-box <?php endif; ?>
            <?php if ($nota->id == $selectedNote->id): ?> bg-base-200  <?php endif; ?>
            ">
            <?= $nota->titulo ?>

        </a>

    <?php endforeach; ?>


</div>
<div class="bg-base-200 opacity-80 rounded-r-box w-full p-10 text-center text-3xl font-bold pt-20">
    <p>Nenhuma nota foi encontrada.</p> <br>
    <a href="/notas" class="link link-primary text-xl mt-2">Limpar filtro</a>
</div>