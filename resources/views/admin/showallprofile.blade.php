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
        <th scope="col">Profile to be Displayed</th>
        <th scope="col">Slots Needed in Profile</th>
      </tr>
    </thead>
    <tbody>
        @if (count($profile) < 1)
            <div class="alert alert-danger" style="margin-top:5em;">
                <strong>Profile is not added till now please add it here <a href="/addprofile">Add Profile</a></strong>
            </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="margin-top:5em;">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        @elseif(session('delete'))
        <div class="alert alert-secondary alert-dismissible" style="margin-top:5em;">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible" style="margin-top:5em;">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        @endif
        @foreach ($profile as $s)
        <tr>
            <th scope="row">{{$s->id}}</th>
            <td>{{$s->profile_to_displayed}}</td>
            <td>{{$s->slots_needed ? : 0}}</td>
            <td><a href = "/editprofile/{{$s->id}}" class="btn btn-info">edit profile</a></td>
            <td>
                <form action="/deleteprofile/{{$s->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Delete</button>
                </form>
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
@endsection