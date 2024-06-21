<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-white">Главная страница</a></li>
                <li><a href="/upload" class="nav-link px-2 text-white">Загрузить трек</a></li>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ route('search') }}" method="POST">
                    @csrf
                    <input type="search" name="word" class="form-control form-control-dark" placeholder="Поиск">
                </form>
            </ul>


            <div class="text-end">
                @guest
                    @if (Route::has('login'))
                        <a class="btn btn-outline-light me-2" href="{{ route('login') }}">{{ __('Войти') }}</a>
                    @endif

                    @if (Route::has('register'))
                        <a class="btn btn-light" href="{{ route('register') }}">{{ __('Зарегестрироваться') }}</a>
                    @endif
                @else
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('home', ['user_id' => Auth::user()->id]) }}">Профиль</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>
<script>
    document.getElementById('avatar_change').addEventListener('change', function() {
        document.getElementById('avatar-file-form').submit();
    });
</script>
