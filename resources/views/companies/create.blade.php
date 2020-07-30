@extends('adminlte::page')
@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a Company</h1>
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
  <form method="post" action="{{ route('companies.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="container">

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name"/>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email"/>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-6">
          <div class="form-group">
            <input type="file" name="logo" class="form-control-file">
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Add</button>

    </div>
  </form>
</div>
@endsection