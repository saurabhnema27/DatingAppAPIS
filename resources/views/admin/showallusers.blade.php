@extends('layouts/layouts')

@section('content')
<div class="main-content-wrap  d-flex flex-column mt-4">
    <div class="main-content">
                   <div class="breadcrumb">
    <h1>Version 1</h1>
    <ul>
        <li><a href="">Dashboard</a></li>
        <li>Version 1</li>
    </ul>
</div>

<table class="table table-striped" style="margin-top:10em;">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Email</th>
        <th scope="col">Number</th>
        <th scope="col">created At</th>
        <th scope="col">User Active</th>
      </tr>
    </thead>
    <tbody>
      @if(session('error'))
      <div class="alert alert-danger alert-dismissible" style="margin-top:5em;">
          {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>  
      @elseif(session('success'))
        <div class="alert alert-success alert-dismissible" style="margin-top:5em;">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>  
      @elseif (count($users) < 1)
        <div class="alert alert-danger" style="margin-top:5em;">
            <strong>No users has Registred till now.</strong>
          </div>
        @endif
        @foreach ($users as $u)
        <tr>
            <th scope="row">{{$u->id}}</th>
            <td>{{$u->email}}</td>
            <td>{{$u->number}}</td>
            <td>{{$u->created_at->diffForHumans()}}</td>
            <td>{{$u->is_user_active}}</td>
            <td><a href = "/viewuser/{{$u->id}}" class="btn btn-primary">View User</a></td>
            @if($u->is_user_active == '1')
              <td><a href = "/deactivateuser/{{$u->id}}" class="btn btn-danger">Deactivate User</a></td>
            @elseif($u->is_user_active == '0')
              <td><a href = "/activateuser/{{$u->id}}" class="btn btn-info">Activated User</a></td>
            @endif  
          </tr>
        @endforeach
    </tbody>
  </table>
  {{ $users->links() }}
@endsection 