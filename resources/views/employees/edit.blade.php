@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Update an Employee</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    <br /> 
    @endif
    <form method="post" action="{{ route('employees.update', [ 'id' => $employee->id ] ) }}">
      @method('PATCH') 
      @csrf
      <div class="container">

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
            <div class="form-group">
              <label for="name_first">First Name:</label>
              <input type="text" class="form-control" name="name_first" value="{{ $employee->name_first }}" />
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
            <div class="form-group">
              <label for="name_last">First Name:</label>
              <input type="text" class="form-control" name="name_last" value="{{ $employee->name_last }}" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" value="{{ $employee->email }}" />
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
            <div class="form-group">
              <label for="email">Telephone:</label>
              <input type="tel" class="form-control" name="telephone" value="{{ $employee->telephone }}" />
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

      </div>
    </form>
  </div>
</div>
@endsection