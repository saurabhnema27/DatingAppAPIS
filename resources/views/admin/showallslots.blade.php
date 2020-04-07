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
  @elseif(session('error'))
  <div class="alert alert-danger alert-dismissible" style="margin-top:5em;">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>    
@elseif (count($slots) < 1)
  <div class="alert alert-danger" style="margin-top:5em;">
      <strong>Slotting is not added till now please add it here <a href="/addslotting">Add Slots</a></strong>
    </div>
  @endif
<a href="/addslotting" class="btn btn-primary" style="position: absolute;margin-top: 4em;">Add Slots</a>
<table class="table table-striped" style="margin-top:10em;">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Displaying Profile on Slot</th>
        <th scope="col">Displaying Like profile on Slot</th>
        <th scope="col">Displaying Dislike Profile on Slot</th>
        <th scope="col">Displaying not Seen Profile on slot</th>
        <th scope="col">Slot Sequence</th>
        <th scope="col">Slot timing</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($slots as $s)
        <tr>
            <th scope="row">{{$s->id}}</th>
            <td>{{$s->slot_number}}</td>
            <td>{{$s->liked_profile_to_display}}</td>
            <td>{{$s->dislike_profile_to_display}}</td>
            <td>{{$s->notseen_profile_to_display}}</td>
            <td>{{$s->slot_sequence}}</td>   
            <td>{{$s->slot_timing}}</td>  
            <td><a href = "/editslots/{{$s->id}}" class="btn btn-info">edit slots</a></td>
            <td>
                <form action="/deleteslots/{{$s->id}}" method="POST">
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