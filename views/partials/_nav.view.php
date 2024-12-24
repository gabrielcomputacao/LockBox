<div class="navbar bg-base-100">
    <div class="flex-1">
        <a href="/notas" class="btn btn-ghost text-xl">LockBox</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/see">

                    Olho

                </a></li>
            <li>
                <details>
                    <summary><?= $_SESSION['auth']->nome ?></summary>
                    <ul class="bg-base-100 rounded-t-none p-2">
                        <li><a href="/logout">Logout</a></li>

                    </ul>
                </details>
            </li>
        </ul>
    </div>
</div>