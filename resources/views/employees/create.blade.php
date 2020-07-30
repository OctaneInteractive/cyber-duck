@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add an Employee</h1>
  <div>
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
  </div>
  @endif
  @if ($companies->count() > 0)
  <form method="post" action="{{ route('employees.store') }}">
    @csrf
    <div class="container">

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="company_id">Company:</label>
            <select class="form-control" name="company_id">
              <option>Choose a Company</option>
              @foreach ($companies as $company)
              <option value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
          <div class="form-group">
            <label for="name_first">First Name:</label>
            <input type="text" class="form-control" name="name_first"/>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
          <div class="form-group">
            <label for="name_last">Last Name:</label>
            <input type="text" class="form-control" name="name_last"/>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email"/>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
          <div class="form-group">
            <label for="telephone">Telephone:</label>
            <input type="tel" class="form-control" name="telephone"/>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Add</button>
    </div>
  </form>
  @else
  <div class="alert alert-info">
    <p>You need to add a new Company first.</p>
    <a class="btn btn-primary" href="/companies/create" role="button">New</a>
  </div>
  @endif
</div>
@endsection