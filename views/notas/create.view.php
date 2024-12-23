<div class="bg-base-300 rounded-l-box w-56">
    <div class="bg-base-200 p-4">
        + New Note
    </div>
</div>
<div class="bg-base-200 opacity-80 rounded-r-box w-full p-10  ">

    <form action="/notas/create" method="post" class="flex flex-col space-y-6">

        <label class="form-control w-full ">
            <div class="label">
                <span class="label-text">Title</span>

            </div>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />

        </label>

        <label class="form-control">
            <div class="label">
                <span class="label-text">Your Note</span>

            </div>
            <textarea class="textarea textarea-bordered h-24" placeholder="Bio"></textarea>

        </label>

        <div class="flex justify-end items-center">


            <button class="btn btn-primary">
                Salvar
            </button>

        </div>


    </form>

</div>