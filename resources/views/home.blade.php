@extends('layouts.app')

@section('title')
{{ $settings->translate(app()->getLocale())->site_name ?? $_ENV['APP_NAME'] }}
@endsection

@section('content')

home

@endsection