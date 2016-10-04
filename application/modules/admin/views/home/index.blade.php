@extends('layouts.main')

@section('htmlheader_title')
    Home - Index
@endsection

@section('contentheader_title')
    Index Dashboard
@endsection

@section('contentheader_breadcrumb')
    <li class="active">Admin</li>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ $ci->lang->line('users') }}</span>
                    <span class="info-box-number">{{ $users }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-log-in"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ $ci->lang->line('logged_today') }}</span>
                    <span class="info-box-number">{{ count($logged_today) }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
