<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav ms-auto">

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">

                {{ strtoupper(app()->getLocale()) }}

            </a>

            <ul class="dropdown-menu">

                <li>

                    <a class="dropdown-item" href="{{ route('locale.switch','en') }}">

                        English

                    </a>

                </li>

                <li>

                    <a class="dropdown-item" href="{{ route('locale.switch','ar') }}">

                        العربية

                    </a>

                </li>

            </ul>

        </li>

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">

                {{ auth()->user()?->name }}

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <a class="dropdown-item" href="{{ route('profile.edit') }}">

                        {{ __('Profile') }}

                    </a>

                </li>

                <li><hr class="dropdown-divider"></li>

                <li>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item">
                            {{ __('Log Out') }}
                        </button>
                    </form>

                </li>

            </ul>

        </li>

    </ul>

</nav>