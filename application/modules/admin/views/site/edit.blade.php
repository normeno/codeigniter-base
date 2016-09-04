@extends('layouts.main')

@section('htmlheader_title')
    Admin - {{ $ci->lang->line('edit') }} {{ $ci->lang->line('site') }}
@endsection

@section('contentheader_title')
    {{ $ci->lang->line('site_config') }}
@endsection

@section('contentheader_breadcrumb')
    <li>{{ $ci->lang->line('site') }}</li>
    <li class="active">{{ $ci->lang->line('edit') }}</li>
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $ci->lang->line('form') }}</div>
                    <div class="panel-body">
                        {!! form_open_multipart("admin/site/edit", ['class' => 'form-horizontal']) !!}
                            @include('site.form')

                            <input type="submit" class="btn btn-success" value="{{ $ci->lang->line('edit') }}">
                        {!! form_close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
