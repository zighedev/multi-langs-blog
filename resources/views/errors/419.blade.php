@extends('layouts.app')

@section('title', __('errors.page expired'))

@section('navbar') @endsection

@section('content')
@include('includes.errors.error', ['code'=> '419', 'message'=> __('errors.page expired')])
@endsection
