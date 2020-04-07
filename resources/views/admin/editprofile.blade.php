@extends('layouts.layouts')

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
<form action="/updateprofile/{{$profile->id}}" style="margin-top: 7em;" method="POST">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @method('PUT')
    @csrf

    <div class="form-group">
      <label for="exampleInputEmail1">Display Profile Number</label>
    <input type="integer" name="profile" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value={{$profile->profile_to_displayed}}>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Slots Needed</label>
      <input type="integer" name="slots" class="form-control" id="exampleInputPassword1" value={{$profile->slots_needed}}>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection