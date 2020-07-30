@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Update a Company</h1>
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
    <form method="post" action="{{ route('companies.update', [ 'id' => $company->id ] ) }}">
      @method('PATCH') 
      @csrf
      <div class="container">

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name" value="{{ $company->name }}" />
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" value="{{ $company->email }}" />
            </div>
          </div>
        </div>
 
        <button type="submit" class="btn btn-primary">Update</button>
 
      </div>
    </form>
  </div>
</div>
@endsection