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
<table class="table table-striped" style="margin-top:10em;">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Superliked Allowed</th>
      </tr>
    </thead>
    <tbody>
        @if (count($conf) < 1)
            <div class="alert alert-danger" style="margin-top:5em;">
                <strong>Configuration is not added till now please add it here <a href="/addconfiguration">Add Configuration</a></strong>
            </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="margin-top:5em;">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible" style="margin-top:5em;">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>  
        @endif
        @foreach ($conf as $c)
        <tr>
            <th scope="row">{{$c->id}}</th>
            <td>{{$c->SUPERLIKE_ALLOWED}}</td>
            <td><a href = "/editconfiguration/{{$c->id}}" class="button button-info">edit configuration</a></td>
          </tr>
        @endforeach
    </tbody>
</table>

@endsection