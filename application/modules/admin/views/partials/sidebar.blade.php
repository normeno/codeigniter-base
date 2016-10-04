<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $current_user->avatar }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ "{$current_user->first_name} {$current_user->last_name}" }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            @foreach ($sidebar as $sb)

                @if (empty($sb['module_id']) && !isset($sb['childs']))
                    <li><a href="{{ $sb['route'] }}"><i class="{{ $sb['font'] }}"></i> <span>{{ $sb['name'] }}</span></a></li>
                @elseif (empty($sb['module_id']) && isset($sb['childs']))
                    <li class="treeview">
                        <a href="#">
                            <i class="{{ $sb['font'] }}"></i>
                            <span>{{ $sb['name'] }}</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu" id="ul-menu-{{ $sb['id'] }}">
                            @foreach ($sb['childs'] as $child)
                                <li><a href="{{ $child['route'] }}">{{ $child['name'] }}</a></li>
                            @endforeach
                        </ul>
                @endif
            @endforeach
        </ul>
    </section>

</aside>