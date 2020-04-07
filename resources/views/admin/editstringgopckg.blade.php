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
<form action="/updatestringgopckg/{{$find->id}}" style="margin-top: 7em;" method="POST">
    @method('PUT')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            {{ session('success') }}
        </div>

    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif(session('update'))
        <div class="alert alert-success">
            {{ session('update') }}
        </div>    
    @endif
    @csrf
        <div class="form-row">
          <div class="col-sm-6">
            <label for="inputEmail4">Superlike</label>
            <input type="text" value="superlike" class="form-control" readonly>
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Superlike Count</label>
          <input type="text" value="{{$find->superlike_count}}" name="superlike_count" class="form-control">
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Boosts</label>
            <input type="text" value="boosts" class="form-control" readonly>
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Boosts Count</label>
          <input type="text" value="{{$find->boosts_count}}" name="boosts_count" class="form-control">
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Change Location</label>
            <input type="text" value="Change Location" class="form-control" readonly>
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Location Count</label>
          <input type="text" value="{{$find->change_location_count}}" name="change_location_count" class="form-control">
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Rewind Swipe</label>
            <input type="text" value="Rewind Swipe" class="form-control" readonly>
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Rewind Swipe Count</label>
          <input type="text" value="{{$find->rewind_count}}" name="rewind_count" class="form-control">
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">Package Is For</label>
            <select id="inputState" class="form-control" name="package_is_for">
            <option selected>{{$find->package_is_for}}</option>
                <option>Days</option>
                <option>Months</option>
                <option>Year</option>
              </select>
          </div>
          <div class="col-sm-6">
            <label for="inputEmail4">package Validity</label>
            <input type="integer" value="{{$find->pacakge_count}}" name="pacakge_count" class="form-control" id="exampleInputPassword1" placeholder="Package is valid for days" required = "required">
          </div>
        </div>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>

@endsection