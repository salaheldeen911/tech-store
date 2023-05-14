<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>Salah Focus Dashboard</title>

    <!-- ================= Favicon ================== -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/dashboard-logo.png') }}?">
    {{-- <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff"> --}}

    <!-- Common -->
    <link href={{ asset('admin/css/lib/font-awesome.min.css') }} rel="stylesheet">
    <link href={{ asset('admin/css/lib/themify-icons.css') }} rel="stylesheet">
    <link href={{ asset('admin/css/lib/menubar/sidebar.css') }} rel="stylesheet">
    <link href={{ asset('admin/css/lib/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('admin/css/lib/helper.css') }} rel="stylesheet">
    <link href={{ asset('admin/css/style.css') }} rel="stylesheet">
    <link href={{ asset('admin/css/jquery.fancybox.min.css') }} rel="stylesheet">
    <link rel="stylesheet" href={{ asset('/css/spryValidator-V1.css') }}>
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">

    @stack('styles')
    <link href={{ asset('admin/css/custom.css') }} rel="stylesheet">
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    @livewireStyles

</head>

<body>
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures" style="height: 100vh !important;">
        <div class="nano">
            <div class="nano-content">
                <div class="logo">
                    <a href="{{ route('admin.home') }}" style="display:block;width:125px;height:49px;margin:0 auto;">
                        <img src="{{ asset('images/dashboard-logo.png') }}"
                            style="display:block;width:100%;height:100%;margin:0 auto;" alt="avatar" />
                        <span>Focus</span>
                    </a>
                </div>
                <ul>
                    <li class="label">Main</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-home"></i> All <span
                                class="badge badge-primary">5</span> <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
                            <li><a href="{{ route('admin.edit-slider') }}">Slider</a></li>
                            <li><a href="{{ route('admin.edit.advertisingSections') }}">Advertising Section</a></li>
                            <li><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                        </ul>
                    </li>

                    <li class="label">Details</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-wand"></i> Details <span
                                class="badge badge-primary">8</span> <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.networks.index') }}">Networks</a></li>
                            <li><a href="{{ route('admin.processors.index') }}">Processors</a></li>
                            <li><a href="{{ route('admin.screen-types.index') }}">Screen Types</a></li>
                            <li><a href="{{ route('admin.refresh-rate.index') }}">Refresh Rates</a></li>
                            <li><a href="{{ route('admin.operating-system.index') }}">Operating Systems</a></li>
                            <li><a href="{{ route('admin.colors.index') }}">Colors</a></li>
                            <li><a href="{{ route('admin.brands.index') }}">Brands</a></li>
                            <li><a href="{{ route('admin.resolutions.index') }}">Resolutions</a></li>
                        </ul>
                    </li>

                    <li class="label">Logout</li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                    this.nextElementSibling.submit()">

                            <i class="ti-close"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right" style="position:relative">
                        @livewire('admin.notification-count')

                        @livewire('admin.notifications')

                        {{-- <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <div class="drop-down dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">Recent Notifications</span>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="#"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">5 members joined today </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="#"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mariam</div>
                                                        <div class="notification-text">likes a photo of you</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="#"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Tasnim</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="#"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <i class="ti-email"></i>
                                <div class="drop-down dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">2 New Messages</span>
                                        <a href="email.html">
                                            <i class="ti-pencil-alt pull-right"></i>
                                        </a>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li class="notification-unread">
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src=" #"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Michael Qin</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="notification-unread">
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="#"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src=" #"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Michael Qin</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="pull-left m-r-10 avatar-img" src="#"
                                                        alt="avatar" />
                                                    <div class="notification-content">
                                                        <small class="notification-timestamp pull-right">02:34
                                                            PM</small>
                                                        <div class="notification-heading">Mr. John</div>
                                                        <div class="notification-text">Hi Teddy, Just wanted to let you
                                                            ...</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-center">
                                                <a href="#" class="more-link">See All</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar text-capitalize">{{ Auth::user()->name }}
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">Upgrade Now</span>
                                        <p class="trial-day">30 Days Trail</p>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ti-email"></i>
                                                    <span>Inbox</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-settings"></i>
                                                    <span>Setting</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ti-lock"></i>
                                                    <span>Lock Screen</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    this.nextElementSibling.submit();">

                                                    <i class="ti-power-off"></i>
                                                    <span>{{ __('Logout') }}</span>
                                                </a>
                                                <form action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                @yield('admin-content')
            </div>
        </div>
    </div>

    <!-- Common -->
    <!-- jquery vendor -->
    <script src={{ asset('admin/js/lib/jquery.min.js') }}></script>
    <script src={{ asset('admin/js/lib/jquery.nanoscroller.min.js') }}></script>
    <!-- nano scroller -->
    <script src={{ asset('admin/js/lib/menubar/sidebar.js') }}></script>
    <script src={{ asset('admin/js/lib/preloader/pace.min.js') }}></script>
    <!-- sidebar -->

    <script src={{ asset('admin/js/lib/bootstrap.min.js') }}></script>
    <script src={{ asset('admin/js/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('admin/js/jquery-ui.min.js') }}></script>

    <script src={{ asset('admin/js/scripts.js') }}></script>
    <!-- bootstrap -->

    @stack('scripts')

    @livewireScripts

    <script>
        function go(li) {
            // console.log(li);
            let location = $(li).find('a').attr('href');
            window.location = location;

            // window.location.href = ;
        }
    </script>

</body>

</html>
