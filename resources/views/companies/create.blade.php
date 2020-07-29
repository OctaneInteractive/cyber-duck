@extends('layouts.app')
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
    <div class="form-group">    
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name"/>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" name="email"/>
    </div>
    <div class="form-group">
      <input type="file" name="logo" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
  </form>
</div>
@endsection