<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/small.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <!-- <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas text-danger fa-tachometer-alt"></i>
                        <span class="nav-link-text">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                @if (auth()->user()->role=='admin')
                <li class="nav-item {{ (request()->is('pages')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pages') }}">
                        <i class="fas text-danger fa-tasks"></i>
                        <span class="nav-link-text">{{ __('Website Pages') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('contact/settings')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('contact.settings') }}">
                        <i class="fas text-danger fa-cogs"></i>
                        <span class="nav-link-text">{{ __('Website Settings') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('previous-shows*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('previous_shows.index') }}">
                        <i class="fas text-danger fa-camera-retro"></i>
                        <span class="nav-link-text">{{ __('Previous Show & Spotlight') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('about*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#about" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('about*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-address-card"></i>
                        <span class="nav-link-text">{{ __('About') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('about*')) ? 'show' : '' }}" id="about">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('about/who-we-are')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about.who-we-are') }}">
                                    {{ __('Who We Are') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('about/what-we-do*')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about.what-we-do') }}">
                                    {{ __('What We Do') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('about/gang')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('about.gang') }}">
                                    {{ __('Gang') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <!-- <li class="nav-item {{ (request()->is('cities*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#citiess" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('cities*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas fa-globe-asia"></i>
                        <span class="nav-link-text">{{ __('Cities') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('cities*')) ? 'show' : '' }}" id="citiess">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('cities/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('cities.create') }}">
                                    {{ __('Add New City') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('cities')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('cities.index') }}">
                                    {{ __('Cities List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item {{ (request()->is('banner*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#banners" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('banner*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-image"></i>
                        <span class="nav-link-text">{{ __('Banners') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('banner*')) ? 'show' : '' }}" id="banners">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('banner/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('banner.create') }}">
                                    {{ __('Add New Banner') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('banner')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('banner.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('artist*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#artists" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('artist*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-headphones-alt"></i>
                        <span class="nav-link-text">{{ __('Artists') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('artist*')) ? 'show' : '' }}" id="artists">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('artist/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('artist.create') }}">
                                    {{ __('Add New Artist') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('artist')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('artist.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('event*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#events" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('event*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-theater-masks"></i>
                        <span class="nav-link-text">{{ __('Events') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('event*')) ? 'show' : '' }}" id="events">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('event/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('event.create') }}">
                                    {{ __('Add New Event') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('event')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('event.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('album*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#albums" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('album*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-compact-disc"></i>
                        <span class="nav-link-text">{{ __('Albums') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('album*')) ? 'show' : '' }}" id="albums">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('album/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('album.create') }}">
                                    {{ __('Add New Album') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('album')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('album.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('client*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#clients" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('client*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-sitemap"></i>
                        <span class="nav-link-text">{{ __('Clients') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('client*')) ? 'show' : '' }}" id="clients">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('clientfeedback')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('clientfeedback.index') }}">
                                    {{ __('Clients Feedback') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('client')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('client.index') }}">
                                    {{ __('Clients List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#radio" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('radio*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas fa-compact-disc"></i>
                        <span class="nav-link-text">{{ __('Radio') }}</span>
                    </a>
                    <div class="collapse" id="radio">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="">
                                    {{ __('Coming Soon') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item {{ (request()->is('vlogs*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#vlogs" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('vlogs*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fab text-danger fa-blogger-b"></i>
                        <span class="nav-link-text">{{ __('Vlogs') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('vlogs*')) ? 'show' : '' }}" id="vlogs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('vlogs/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('vlogs.create') }}">
                                    {{ __('Add New Vlog') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('vlogs')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('vlogs.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('gallery*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#gallery" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('gallery*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-images"></i>
                        <span class="nav-link-text">{{ __('Gallery') }}</span>
                    </a>
                    <div class="collapse {{ (request()->is('gallery*')) ? 'show' : '' }}" id="gallery">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('gallerycategories')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('gallerycategories.index') }}">
                                    {{ __('Categories') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('gallery')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('gallery.create') }}">
                                    {{ __('Add New Gallery') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('client')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('gallery.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ (request()->is('products*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#products" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('products*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-store"></i>
                        <span class="nav-link-text">{{ __('Products') }}</span>
                    </a>
                    <div class="collapse {{ (request()->is('products*')) ? 'show' : '' }}" id="products">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('productscategory')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('productscategory.index') }}">
                                    {{ __('Categories') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('products')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('products.create') }}">
                                    {{ __('Add New Product') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('client')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('products.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <ul class="navbar-nav">
            <li class="nav-item {{ (request()->is('tickets*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#tickets" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('tickets*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-ticket-alt"></i>
                        <span class="nav-link-text">{{ __('Event Tickets') }}
                        <?php $read = getTickets();
                            if(count($read)>0){ ?>
                                <span class="badge badge-success">{{count($read)}} new</span>
                            <?php } ?>
                        </span>
                    </a>

                    <div class="collapse {{ (request()->is('tickets*')) ? 'show' : '' }}" id="tickets">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('tickets')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('tickets.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <li class="nav-item {{ (request()->is('shipping*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#shipping" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('shipping*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-shipping-fast"></i>
                        <span class="nav-link-text">{{ __('Shipping Charges') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('shipping*')) ? 'show' : '' }}" id="shipping">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('shipping')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('shipping.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <li class="nav-item {{ (request()->is('orders*')) ? 'active' : '' }}">
                    <span class="nav-link" href="#orders" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('orders*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-cart-arrow-down"></i>
                        <span class="nav-link-text">{{ __('Orders') }}
                            <?php $read = getOrders();
                            if(count($read)>0){ ?>
                                <span class="badge badge-success">{{count($read)}} new</span>
                            <?php } ?>
                        </span>
                    </span>

                    <div class="collapse {{ (request()->is('orders*')) ? 'show' : '' }}" id="orders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('orders')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('orders.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @if (auth()->user()->role=='admin')
            <li class="nav-item {{ (request()->is('user*')) ? 'active' : '' }}">
                    <a class="nav-link" href="#users" data-toggle="collapse" role="button" aria-expanded="{{ (request()->is('user*')) ? 'true' : 'false' }}" aria-controls="navbar-examples">
                        <i class="fas text-danger fa-user-cog"></i>
                        <span class="nav-link-text">{{ __('Users') }}</span>
                    </a>

                    <div class="collapse {{ (request()->is('user*')) ? 'show' : '' }}" id="users">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item {{ (request()->is('user/create')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.create') }}">
                                    {{ __('Add New User') }}
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->is('user')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('List') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            </ul>
        </div>
    </div>
</nav>
