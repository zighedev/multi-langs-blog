@extends('layouts.app')

@section('title', __('errors.server error'))

@section('navbar') @endsection

@section('content')
@include('includes.errors.error', ['code'=> '500', 'message'=> __('errors.server error')])
@endsection
