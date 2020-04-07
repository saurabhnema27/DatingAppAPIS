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
<form action="/updateconfiguration/{{$conf->id}}" style="margin-top: 7em;" method="POST">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            {{ session('success') }}
        </div>
    @endif
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="exampleInputPassword1">SuperLike Allowed</label>
        <input type="integer" name="superlike" class="form-control" id="exampleInputPassword1" value={{$conf->SUPERLIKE_ALLOWED}}>
      </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection