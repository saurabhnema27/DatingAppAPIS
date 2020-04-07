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
<form action="/addslottingonprofile" style="margin-top: 7em;" method="POST">
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
      <label for="exampleInputEmail1">Total profile to be shown in slot</label>
      <input type="integer" name="slotnumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter a slot to show" required = "required">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Total like profile to show</label>
      <input type="integer" name="likeprofiletodisplay" class="form-control" id="exampleInputPassword1" placeholder="like profile to display in slot" required = "required">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Total Dislike profile to show</label>
        <input type="integer" name="dislikeprofiletodisplay" class="form-control" id="exampleInputPassword1" placeholder="Dislike profile to display in slot" required = "required">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Total Notseen profile to show</label>
        <input type="integer" name="notseenprofiletodisplay" class="form-control" id="exampleInputPassword1" placeholder="Notseen profile to display in slot" required = "required">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Slot Sequence / Order of a Slot to Display</label>
        <input type="integer" name="slotsequence" class="form-control" id="exampleInputPassword1" placeholder="slots Sequence ex (1,2,3)" required = "required">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Timing on Slot (in Minutes: format hh:mm:ss)</label>
        <input type="time" name="slottime" class="form-control" id="exampleInputPassword1" placeholder="enter a slot timing">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection