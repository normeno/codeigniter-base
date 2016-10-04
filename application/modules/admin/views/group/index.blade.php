@extends('layouts.main')

@section('htmlheader_title')
    User - List
@endsection

@section('contentheader_title')
    {{ $ci->lang->line('list') }} {{ $ci->lang->line('users') }}
@endsection

@section('contentheader_breadcrumb')
    <li>{{ $ci->lang->line('user') }}</li>
    <li class="active">{{ $ci->lang->line('list') }}</li>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $ci->lang->line('users') }}</div>
                    <div class="panel-body table-responsive">

                        <a href="{{ site_url('admin/group/create') }}" class="btn btn-success btn-sm">{{ $ci->lang->line('create') }} {{ $ci->lang->line('group') }}</a>
                        <br><br>

                        <table id="table" class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>{{ $ci->lang->line('name') }}</th>
                                <th>{{ $ci->lang->line('actions') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $( document ).ready(function() {
        // Generate datatable
        var table = $("#table").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ site_url('admin/group/dataTable') }}",
                "type": "POST"
            },
            columns: [
                { data: "g.name" },
                {
                    data: null,
                    className: "center",
                    searchable: false,
                    defaultContent: '<button class="btn btn-primary btn-xs btn-edit" type="button"><span class="fa fa-pencil-square-o"></span> {{ $ci->lang->line('edit') }}</button> '
                },
            ],
        });

        // Edit Record
        $('#table').on('click', '.btn-edit', function (e) {
            e.preventDefault();

            var id = table.row( $(this).parents('tr') ).id();

            if(id < 3) {
                alert("{{ $ci->lang->line('not_editable') }}");
                return false;
            }

            window.location = '{{ site_url('admin/group/edit/') }}'+id
        });
    });
</script>
@endpush