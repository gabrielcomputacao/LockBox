<?php $validationsPassword = flash()->get('validation') ?>
<?php $validationsMessage = flash()->get('message') ?>

<div class="bg-base-200 opacity-80 rounded-r-box w-full p-10 text-center text-3xl font-bold pt-20 ">

    <form action="/mostrar" method="POST" class="flex flex-col items-center gap-4">
        <div>Digite a sua senha novamente para começar a ver todas as suas notas encriptografadas</div>

        <label class="form-control w-full flex flex-col items-center">
            <div class="label">
                <span class="label-text text-left">Password</span>
            </div>
            <input name="password" type="text" class="input input-bordered w-full max-w-xs" />
            <?php if (isset($validationsPassword['password'])) { ?>
                <div class="label text-xs text-error">
                    <?= $validationsPassword['password'][0] ?>
                </div>
            <?php } ?>
        </label>


        <button class="btn btn-primary">Abrir minhas notas</button>
    </form>

</div>