<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">

        <span class="brand-text">

            Invoice System

        </span>

    </a>

    <div class="sidebar">

        <nav>

            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">

                    <a href="{{ route('dashboard') }}" class="nav-link">

                        <p>{{ __('Dashboard') }}</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('customers.index') }}" class="nav-link">

                        <p>{{ __('Customers') }}</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('products.index') }}" class="nav-link">

                        <p>{{ __('Products') }}</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('quotations.index') }}" class="nav-link">

                        <p>{{ __('Quotations') }}</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{ route('settings.company.edit') }}" class="nav-link">

                        <p>{{ __('Company Settings') }}</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>