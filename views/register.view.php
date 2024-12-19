<div class="grid grid-cols-2">

    <div class="hero  min-h-screen flex ml-40">
        <div class="hero-content -mt-20">
            <div>
                <p class="py-2 text-xl">Bem Vindo ao</p>
                <h1 class="text-6xl font-bold">LockBox</h1>
                <p class="pt-2 pb-4 text-xl">
                    Onde voce guarda tudo em segurança.
                </p>

            </div>
        </div>
    </div>
    <div class="bg-white min-h-screen hero mr-40 text-black">
        <div class="hero-content -mt-20">
            <form action="/register" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            Cria sua conta
                        </div>
                        <label class="form-control ">
                            <div class="label">
                                <span class="label-text text-black">Nome</span>

                            </div>
                            <input name="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs bg-white" />

                        </label>
                        <label class="form-control ">
                            <div class="label">
                                <span class="label-text text-black">Email</span>

                            </div>
                            <input name="email" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs bg-white" />

                        </label>
                        <label class="form-control ">
                            <div class="label">
                                <span class="label-text text-black">Confirm Email</span>

                            </div>
                            <input type="text" name="confirmemail" placeholder="Type here" class="input input-bordered w-full max-w-xs bg-white" />

                        </label>
                        <label class="form-control ">
                            <div class="label">
                                <span class="label-text text-black">Password</span>

                            </div>
                            <input name="password" type="password" placeholder="Type here" class="input input-bordered w-full max-w-xs bg-white" />

                        </label>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary btn-block">Register</button>
                            <a href="/login" class="btn btn-link">already have account</a>
                        </div>
                    </div>
                </div>



            </form>
        </div>
    </div>

</div>