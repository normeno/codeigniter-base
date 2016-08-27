<html>
    @section('htmlheader')
        @include('partials.htmlheader')
    @show

    <body class="skin-green-light sidebar-mini">
        <div class="wrapper">
            @include('partials.mainheader')
            @include('partials.sidebar')

            <div class="content-wrapper">
                @include('partials.contentheader')

                <section class="content">
                    @yield('main-content')
                </section>
            </div>

            @include('partials.footer')
        </div>

        @section('scripts')
            @include('partials.scripts')
        @show
    </body>
</html>