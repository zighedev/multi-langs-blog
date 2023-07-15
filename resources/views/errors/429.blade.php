@extends('layouts.app')

@section('title', __('errors.too many requests'))

@section('navbar') @endsection

@section('content')
@include('includes.errors.error', ['code'=> '429', 'message'=> __('errors.too many requests')])
@endsection
