<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="{{ asset('javascript:void(0)') }}" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
            <div class="top-left-part"><a class="logo" href="{{ asset('index.html') }}">
                    <b>
                        <!--This is dark logo icon-->
                        <img src="{{ asset('../plugins/images/eliteadmin-logo.png') }}" alt="home" class="dark-logo" />
                    </b></a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="{{ asset('#') }}" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
            </ul>
    </nav>
    <!-- Left navbar-header -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">

            <div class="user-profile">
                <div class="dropdown user-pro-body">
                    <div><img src="{{ asset('../plugins/images/users/varun.jpg') }}" alt="user-img" class="img-circle"></div>
                    <a href="{{ asset('#') }}" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Super Admin
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu animated flipInY">
                        <li><a href="{{ Route('profile') }}"><i class="ti-user"></i> Profile</a></li>
                        <li><a href="{{ Route('changePassword') }}"><i class="ti-wallet"></i> Change Password</a></li>
                        <li><a href="{{Route('singOut')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <ul class="nav" id="side-menu">
                <li> <a href="{{Route('dashboard')}}" class="waves-effect active">
                        <i class="linea-icon linea-basic fa-fw" data-icon="v"></i>
                        <span class="hide-menu"> Dashboard </span></a>
                </li>
                
                <li><a href="{{ asset('inbox.html') }}" class="waves-effect">
                        <i data-icon="6" class="fa fa-cogs"></i> <span class="hide-menu">General<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ Route('index')}}"><i class="linea-icon linea-basic fa-fw" data-icon="!"></i> Users</a></li>
                        <li><a href="{{ asset('chat.html') }}"><i class="fa fa fa-fort-awesome" data-icon="v"></i> Company</a></li>
                        <li><a href="{{ asset('javascript:void(0)') }}" class="waves-effect"><i class="fa fa-sitemap" data-icon="v"></i> Department</a></li>
                        <li><a href="{{ asset('javascript:void(0)') }}" class="waves-effect"><i class="fa fa-envelope" data-icon="e"></i> Email Formet</a></li>
                        <li><a href="{{ Route('holiday-index') }}" class="waves-effect"><i class="fa fa-file-video-o" data-icon="2"></i> Holiday</a></li>
                        <li><a href="{{ asset('javascript:void(0)') }}" class="waves-effect"><i class="fa icon-key" data-icon="2"></i> Role</a></li>
                        <li><a href="{{ asset('javascript:void(0)') }}" class="waves-effect"><i class="fa fa-key" data-icon="2"></i> Special Module permision</a></li>

                </li>

            </ul>
            </li>
            <li> <a href="{{ asset('#') }}" class="waves-effect"><i data-icon="/" class="ti-announcement"></i>
                    <span class="hide-menu">Announcement</span></a>
            </li>
            <li> <a href="{{ asset('forms.html') }}" class="waves-effect"><i data-icon="&#xe00b;" class="icon-rocket"></i> <span class="hide-menu">Asset<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <!-- asset pages -->
                </ul>
            </li>
            <li> <a href="{{ asset('#') }}" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Attendance Menagment<span class="fa arrow"></span></span></a>
                <!-- attendance menagment pages -->
            </li>
            <li> <a href="{{ asset('#') }}" class="waves-effect"><i data-icon="&#xe006;" class="fa fa-institution"></i> <span class="hide-menu">Check Menagment<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <!-- check menagment pages -->
                </ul>
            </li>
            <li> <a href="{{ asset('tables.html') }}" class="waves-effect"><i data-icon="O" class="fa fa-file"></i>
                    <span class="hide-menu">Company Document</span></span></a>
            </li>

        </div>
    </div>
