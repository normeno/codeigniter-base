@extends('layouts.main')

@section('htmlheader_title')
    Admin - {{ $ci->lang->line('create') }} {{ $ci->lang->line('administrator') }}
@endsection

@section('contentheader_title')
    {{ $ci->lang->line('create') }} {{ $ci->lang->line('administrator') }}
@endsection

@section('contentheader_breadcrumb')
    <li><a href="{{ site_url('admin/administrator') }}">{{ $ci->lang->line('administrator') }}</a></li>
    <li class="active">{{ $ci->lang->line('create') }}</li>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $ci->lang->line('form') }}</div>
                    <div class="panel-body">
                        {!! form_open_multipart('admin/administrator/create', ['class' => 'form-horizontal']) !!}
                            @include('administrator.form')

                        <input type="submit" class="btn btn-success" value="{{ $ci->lang->line('create') }}">
                        {!! form_close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
