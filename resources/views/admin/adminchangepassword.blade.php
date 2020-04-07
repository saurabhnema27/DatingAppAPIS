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
<form action="/changepassword" style="margin-top: 7em;" method="POST">
    @method('PUT')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>

    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @elseif(session('update'))
        <div class="alert alert-success">
            {{ session('update') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>    
    @endif
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Old Password</label>
    <input type="password" name="oldpassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your old password ******" required = "required">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">New Password</label>
    <input type="password" name="newpassword" class="form-control" id="exampleInputPassword1" placeholder="enter new password ******" required = "required" >
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="confirmpassword" class="form-control" id="exampleInputPassword1" placeholder="confirm new password *******" required = "required">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection