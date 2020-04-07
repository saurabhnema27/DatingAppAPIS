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
<form action="/addsuperlikepckg" style="margin-top: 7em;" method="POST">
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
      <label for="exampleInputEmail1">Price</label>
      <input type="integer" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter a Price of a Package" required = "required">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Total Superlike</label>
      <input type="integer" name="count" class="form-control" id="exampleInputPassword1" placeholder="Count of superlike to be given e.g. (1,2,3)" required = "required">
    </div>
    <div class="form-group">
        <label for="inputState">Package if for</label>
        <select id="inputState" class="form-control" name="package_is_for">
          <option selected>Choose...</option>
          <option>Days</option>
          <option>Months</option>
          <option>Year</option>
        </select>
      </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Package Count</label>
        <input type="integer" name="pacakge_count" class="form-control" id="exampleInputPassword1" placeholder="Package is valid for days" required = "required">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection