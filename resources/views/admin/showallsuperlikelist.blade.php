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
@if(session('delete'))
<div class="alert alert-success alert-dismissible" style="margin-top:5em;">
    {{ session('delete') }}
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
{{-- @elseif (count($superlike) < 1)
  <div class="alert alert-danger" style="margin-top:5em;">
      <strong>Package is not added till now please add it here <a href="/addsuperlikepackage">Add Package</a></strong>
    </div> --}}
  @endif
<a href="/addsuperlikepackage" class="btn btn-primary" style="position: absolute; margin-top: 4em;">Add Superlike Package</a>
<table class="table table-striped" style="margin-top:10em;">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Price</th>
        <th scope="col">Count</th>
        <th scope="col">Package is for (Days, Months, Year)</th>
        <th scope="col">Package Count</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($superlike as $s)
        <tr>
            <th scope="row">{{$s->id}}</th>
            <td>{{$s->price}}</td>
            <td>{{$s->count}}</td>
            <td>{{$s->package_is_for}}</td>
            <td>{{$s->pacakge_count}}</td>
            <td><a href = "/editsuperlikepckg/{{$s->id}}" class="btn btn-info">edit Package</a></td>
            <td>
                <form action="/deletesuperlikepckg/{{$s->id}}" method="POST">
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