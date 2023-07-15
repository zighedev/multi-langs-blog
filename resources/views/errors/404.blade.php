@extends('layouts.app')

@section('title', __('errors.page not found'))

@section('navbar') @endsection

@section('content')
@include('includes.errors.error', ['code'=> '404', 'message'=> __('errors.page not found')])
@endsection