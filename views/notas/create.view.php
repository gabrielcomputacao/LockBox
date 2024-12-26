<div class="bg-base-300 rounded-l-box w-56">
    <div class="bg-base-200 p-4 rounded-tl-box">
        + New Note
    </div>
</div>
<div class="bg-base-200 opacity-80 rounded-r-box w-full p-10  ">

    <form action="/notas/create" method="post" class="flex flex-col space-y-6">
        <?php $validationsCreate = flash()->get('validation') ?>
        <label class="form-control w-full ">
            <div class="label">
                <span class="label-text">Title</span>

            </div>
            <input name="titulo" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
            <?php if (isset($validationsCreate['titulo'])): ?>
                <div class="label text-xs text-error">
                    <?= $validationsCreate['titulo'][0] ?>
                </div>
            <?php endif; ?>
        </label>

        <label class="form-control">
            <div class="label">
                <span class="label-text">Your Note</span>

            </div>
            <textarea name="nota" class="textarea textarea-bordered h-24" placeholder="Bio"></textarea>
            <?php if (isset($validationsCreate['nota'])): ?>
                <div class="label text-xs text-error">
                    <?= $validationsCreate['nota'][0] ?>
                </div>
            <?php endif; ?>

        </label>

        <div class="flex justify-end items-center">


            <button class="btn btn-primary">
                Salvar
            </button>

        </div>


    </form>

</div>