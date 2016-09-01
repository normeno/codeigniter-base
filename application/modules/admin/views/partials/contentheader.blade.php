<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> {{ $ci->lang->line('home') }}</li>
        @yield('contentheader_breadcrumb', 'Breadcrumb here')
    </ol>
</section>