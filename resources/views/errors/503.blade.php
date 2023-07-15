@extends('layouts.app')

@section('title', __('errors.service unavailable'))

@section('navbar') @endsection

@section('content')
@include('includes.errors.error', ['code'=> '503', 'message'=> __('errors.service unavailable')])
@endsection
