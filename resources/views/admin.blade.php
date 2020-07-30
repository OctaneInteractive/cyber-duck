@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to Cyber Duck.</p>
    <a class="btn btn-primary" href="/companies/create" role="button">New Company</a>
    <a class="btn btn-primary" href="/employees/create" role="button">New Employee</a>
@stop