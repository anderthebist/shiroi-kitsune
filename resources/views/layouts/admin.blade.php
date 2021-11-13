<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Админ панель - @yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href={{ asset("/admin_resourses/plugins/fontawesome-free/css/all.min.css") }}>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href={{ asset("/admin_resourses/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}>
    <link rel="stylesheet" href={{ asset("/admin_resourses/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}>
    <link rel="stylesheet" href={{ asset("/admin_resourses/plugins/jqvmap/jqvmap.min.css") }}>
    <link rel="stylesheet" href={{ asset("/admin_resourses/dist/css/adminlte.min.css") }}>
    <link rel="stylesheet" href={{ asset("/admin_resourses/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}>
    <link rel="stylesheet" href={{ asset("/admin_resourses/plugins/daterangepicker/daterangepicker.css") }}>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href= {{ asset("/libs/chosen/chosen.min.css") }}>
	
    
    <link rel="stylesheet" href={{ asset("/css/admin.css") }}>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">@yield('title')</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("index") }}" role="button">
                        <i class="fas fa-home"></i>
                    </a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="aside_admin main-sidebar sidebar-dark-danger elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
            <div class="brand-text font-weight-light" style="text-align: center">Админ панель</div>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 pl-2 mb-3 d-flex">
                <div class="admin-image image" style="padding-left: 35px;">
                    <img src={{Auth::user()->image ? asset("/images/users/".Auth::user()->image) : asset("/images/users/default-user-image.png")}}
                     style="background: white;flex-shrink: unset;" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                
                <li class="nav-item">
                    <a href={{route("admin.index")}} class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{route("anime.admin")}} class="nav-link {{ Request::is('admin/anime/*') ||  Request::is('admin/anime') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Аниме
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route("anime.admin")}} class="nav-link {{Request::is('admin/anime') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Просмотр</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("anime.create")}}" class="nav-link {{Request::is('admin/anime/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить релиз</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href={{route("videos.create")}} class="nav-link {{ Request::is('admin/videos') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Серии
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{route("news.admin")}} class="nav-link {{ Request::is('admin/news/*') ||  Request::is('admin/news') ? 'active' : '' }}">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>
                            Новости
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route("news.admin")}} class="nav-link {{Request::is('admin/news') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Просмотр</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{route("news.create")}} class="nav-link {{Request::is('admin/news/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить новость</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href={{route("team.admin")}} class="nav-link {{ Request::is('admin/team/*') ||  Request::is('admin/team') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Команда
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href={{route("team.admin")}} class="nav-link {{Request::is('admin/team') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Просмотр</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{route("team.create")}} class="nav-link {{Request::is('admin/team/create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Добавить участника</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href={{route("categories.index")}} class="nav-link {{ Request::is('admin/categories') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Категории
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{route("studios.index")}} class="nav-link {{ Request::is('admin/studios') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pencil-ruler"></i>
                        <p>
                            Студии
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{route("users.index")}} class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Пользователи
                        </p>
                    </a>
                </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

    </div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">@yield('title')</h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
    </div>
    
    <script src={{ asset("/admin_resourses/plugins/jquery/jquery.min.js") }}></script>
    <script src={{ asset("/admin_resourses/plugins/jquery-ui/jquery-ui.min.js") }}></script>
    
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src={{ asset("/admin_resourses/plugins/bootstrap/js/bootstrap.bundle.min.js") }}></script>
    <script src={{ asset("/admin_resourses/plugins/chart.js/Chart.min.js") }}></script>
    
    <script src={{ asset("/admin_resourses/plugins/jqvmap/jquery.vmap.min.js") }}></script>
    <script src={{ asset("/admin_resourses/plugins/jqvmap/maps/jquery.vmap.usa.js") }}></script>
    <script src={{ asset("/admin_resourses/plugins/jquery-knob/jquery.knob.min.js") }}></script>
    <script src={{ asset("/admin_resourses/plugins/moment/moment.min.js") }}></script>
    <script src={{ asset("/admin_resourses/plugins/daterangepicker/daterangepicker.js") }}></script>
    <script src={{ asset("/admin_resourses/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js") }}></script>
    
    <script src={{ asset("/admin_resourses/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}></script>
    <script src={{ asset("/admin_resourses/dist/js/adminlte.js") }}></script>
    <script src={{ asset("/admin_resourses/dist/js/demo.js") }}></script>

    <script src= {{ asset("/libs/chosen/chosen.jquery.min.js") }}></script> 
   <!-- <script src="/admin_resourses/dist/js/pages/dashboard.js"></script>-->
    @yield('scripts')

    <script src={{ asset("/js/admin.js") }}></script>
</body>
</html>
