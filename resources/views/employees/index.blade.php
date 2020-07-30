@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Employees</h1>
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
          <th scope="col">Telephone</th>
          <th scope="col" colspan="3">Actions</th>
        </tr>
      </thead>
      <tbody>
      @if ($employees)
        @foreach ($employees as $employee)
        <tr>
          <th scope="row">{{ $employee->id }}</th>
          <td><strong>{{ $employee->name_first . ' ' . $employee->name_last }}</strong></td>
          <td>{{ $employee->email }}</td>
          <td>{{ $employee->telephone }}</td>
          <td><a class="btn btn-primary btn-sm" href="/employees/edit/{{ $employee->id }}" role="button">Edit</a></td>
          <td>
            <form action="{{ route('employees.destroy', [ 'id' => $employee->id ] )}}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
        {{ $employees->links() }}
      @endif
      </tbody>
    </table>
    <a class="btn btn-primary" href="/employees/create" role="button">New</a>
  </div>
</div>
@endsection