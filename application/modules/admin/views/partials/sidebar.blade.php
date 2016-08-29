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

        </ul>
    </section>

</aside>

@push('scripts')
<script type="text/javascript">
    $.get( "{{ site_url('admin/home/modules') }}",
            {
                csrf_token: "{{ $csrf['hash'] }}"
            }
    ).done(function( data ) {
        var html = '';

        $.each( data, function( key, value ) {

            if (!value.module_id && typeof value.childs === 'undefined') { alert('admin.administrator');
                html += '<li><a href="' + value.route + '"><i class="fa fa-'+value.font+'"></i> <span>' + Lang.get(value.name) + '</span></a></li>';
            } else if (!value.module_id && typeof value.childs !== 'undefined') {
                html += '<li class="treeview">' +
                        '<a href="#">' +
                        '<i class="fa '+value.font+'"></i>' +
                        '<span>' + value.name + '</span>' +
                        '<i class="fa fa-angle-left pull-right"></i>' +
                        '</a>' +
                        '<ul class="treeview-menu" id="ul-menu-' + value.id + '">';

                $.each( value.childs, function( k, v ) {
                    html += '<li><a href="' + v.route + '">'+v.name+'</a></li>';
                });

                html += '</ul></li>';
            }
        });

        $(".sidebar-menu").append(html);
    });
</script>
@endpush