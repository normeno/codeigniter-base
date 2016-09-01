@extends('layouts.main')

@section('htmlheader_title')
    Admin - Create
@endsection

@section('contentheader_title')
    {{ $ci->lang->line('list') }} {{ $ci->lang->line('administrator') }}
@endsection

@section('contentheader_breadcrumb')
    <li>{{ $ci->lang->line('administrator') }}</li>
    <li class="active">{{ $ci->lang->line('list') }}</li>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $ci->lang->line('administrators') }}</div>
                    <div class="panel-body table-responsive">
                        <table id="table" class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>{{ $ci->lang->line('username') }}</th>
                                    <th>{{ $ci->lang->line('email') }}</th>
                                    <th>{{ $ci->lang->line('first_name') }}</th>
                                    <th>{{ $ci->lang->line('last_name') }}</th>
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
                "url": "{{ site_url('admin/administrator/dataTable') }}",
                "type": "POST"
            },
            columns: [
                { data: "u.username" },
                { data: "u.email" },
                { data: "u.first_name" },
                { data: "u.last_name" },
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
            window.location = '{{ site_url('admin/administrator/edit/') }}'+id
        });
    });
</script>
@endpush