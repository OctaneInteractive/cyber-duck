@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>{{ __('Welcome to the Cyber Duck CRUD demonstration!') }}</p>
                    <a class="btn btn-primary" href="/companies/create" role="button">New Company</a>
                    <a class="btn btn-primary" href="/employees/create" role="button">New Employee</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
