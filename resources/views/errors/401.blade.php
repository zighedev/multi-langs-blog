@extends('layouts.app')

@section('title', __('errors.unauthorized'))

@section('navbar') @endsection

@section('content')
@include('includes.errors.error', ['code'=> '401', 'message'=> __('errors.unauthorized')])
@endsection