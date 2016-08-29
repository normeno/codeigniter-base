<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="//lorempixel.com/100/100" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ "{$current_user->first_name} {$current_user->last_name}" }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">menu navegacion</li>

            <li class="active">
                <a href="{{ site_url('admin') }}"><i class='fa fa-pie-chart'></i> <span>Home</span></a>
            </li>

            <li>
                <a href="#">
                    <i class='fa fa-building'></i> <span>A</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class='fa fa-users'></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ site_url('admin/administrator') }}">Administrators</a></li>
                    <li><a href="{{ site_url('admin/user') }}">Users</a></li>
                </ul>
            </li>
        </ul>
    </section>

</aside>