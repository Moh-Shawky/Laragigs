<ul class="flex space-x-6 mr-6 text-lg">
@auth
<li>
        <p > WELCOME {{auth()->user()->name}}</p>
    </li>
    <li>
        <a href="/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Gigs</a>
    </li>
    <li>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="hover:text-laravel">
                <i class="fa-solid fa-door-closed"></i> Logout
            </button>
        </form>
    </li>

    @else
    <li>
        <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-user"></i> Login</a>
    </li>
    <li>
        <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
    </li>

    @endauth

</ul>
