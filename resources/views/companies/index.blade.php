@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Companies</h1>
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
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Logo</th>
          <th scope="col" colspan="3">Actions</th>
        </tr>
      </thead>
      <tbody>
      @if ($companies)
        @foreach ($companies as $company)
        <tr>
          <th scope="row">{{ $company->id }}</th>
          <td><strong>{{ $company->name }}</strong></td>
          <td>{{ $company->email }}</td>
          <td><img src="{{ asset('logos/' . $company->logo) }}" width="50"></td>
          <td><a class="btn btn-primary btn-sm" href="/companies/edit/{{ $company->id }}" role="button">Edit</a></td>
          <td>
          <form action="{{ route('companies.destroy', [ 'id' => $company->id ] )}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
          </form>
          </td>
        </tr>
        @endforeach
        {{ $companies->links() }}
      @endif
      </tbody>
    </table>
    <a class="btn btn-primary" href="/companies/create" role="button">New</a>
  </div>
</div>
@endsection