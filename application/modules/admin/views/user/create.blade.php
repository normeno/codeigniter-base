@extends('layouts.main')

@section('htmlheader_title')
    Admin - Create
@endsection

@section('contentheader_title')
    Create administrador
@endsection

@section('contentheader_breadcrumb')
    <li><a href="{{ site_url('admin/administrator') }}">Administrator</a></li>
    <li class="active">Create</li>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $ci->lang->line('form') }}</div>
                    <div class="panel-body">
                        {!! form_open_multipart('admin/user/create', ['class' => 'form-horizontal']) !!}
                            @include('user.form')

                        <input type="submit" class="btn btn-success" value="{{ $ci->lang->line('create') }}">
                        {!! form_close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
