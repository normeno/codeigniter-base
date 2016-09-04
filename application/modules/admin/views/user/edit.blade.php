@extends('layouts.main')

@section('htmlheader_title')
    Admin - {{ $ci->lang->line('edit') }}
@endsection

@section('contentheader_title')
    {{ $ci->lang->line('edit') }} {{ $ci->lang->line('user') }}
@endsection

@section('contentheader_breadcrumb')
    <li><a href="{{ site_url('admin/user') }}">{{ $ci->lang->line('users') }}</a></li>
    <li class="active">{{ $ci->lang->line('edit') }}</li>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $ci->lang->line('form') }}</div>
                    <div class="panel-body">
                        {!! form_open_multipart("admin/user/edit/$id", ['class' => 'form-horizontal']) !!}
                            @include('user.form')

                            <input type="submit" class="btn btn-success" value="{{ $ci->lang->line('edit') }}">
                        {!! form_close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
