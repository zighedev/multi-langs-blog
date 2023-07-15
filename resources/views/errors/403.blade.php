@extends('layouts.app')

@section('title', __('errors.forbidden'))

@section('navbar') @endsection

@section('content')
@include('includes.errors.error', ['code'=> '403', 'message'=> __($exception->getMessage() ?: 'errors.forbidden')])
@endsection