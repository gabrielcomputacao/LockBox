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
<div class="bg-base-200 opacity-80 rounded-r-box w-full p-10 flex flex-col space-y-6">

    <form action="nota" method="POST" id="form-update">

        <input type="hidden" name="__method" value="PUT">
        <input type="hidden" name="id_selected" value="<?= $selectedNote->id ?>">

        <label class="form-control w-full ">
            <div class="label">
                <span class="label-text">Title</span>

            </div>
            <input type="text"
                name="titulo" value="<?= $selectedNote->titulo ?? '' ?>" placeholder="Type here" class="input input-bordered w-full max-w-xs" />

        </label>

        <label class="form-control">
            <div class="label">
                <span class="label-text">Your Note</span>
            </div>
            <textarea
                <?php if (!isset($_SESSION['mostrar'])): ?>
                disabled
                <?php endif; ?>
                name="nota" class="textarea textarea-bordered h-24"><?= hideData($selectedNote->nota) ?? '' ?></textarea>
        </label>
    </form>

    <div class="flex justify-between items-center">

        <form action="nota" method="POST">
            <input type="hidden" name="__method" value="DELETE">
            <input type="hidden" name="id_selected" value="<?= $selectedNote->id ?>">

            <button class="btn btn-error" type="submit">
                Deletar
            </button>

        </form>

        <button class="btn btn-primary" type="submit" form="form-update">
            Atualizar
        </button>

    </div>

</div>