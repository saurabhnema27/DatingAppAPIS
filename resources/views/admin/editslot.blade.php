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
<form action="/updateslot/{{$check->id}}" style="margin-top: 7em;" method="POST">
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
        <label for="exampleInputEmail1">Total profile to be shown in slot</label>
    <input type="integer" name="slotnumber" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$check->slot_number}}" required = "required">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Total like profile to show</label>
      <input type="integer" name="likeprofiletodisplay" class="form-control" id="exampleInputPassword1" value="{{$check->liked_profile_to_display}}" placeholder="like profile to display in slot" required = "required">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1">Total Dislike profile to show</label>
      <input type="integer" name="dislikeprofiletodisplay" class="form-control" id="exampleInputPassword1" value = "{{$check->dislike_profile_to_display}}" placeholder="Dislike profile to display in slot" required = "required">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1">Total Notseen profile to show</label>
      <input type="integer" name="notseenprofiletodisplay" class="form-control" id="exampleInputPassword1" value="{{$check->notseen_profile_to_display}}" placeholder="Notseen profile to display in slot" required = "required">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1">Slot Sequence / Order of a Slot to Display</label>
      <input type="integer" name="slotsequence" class="form-control" id="exampleInputPassword1" value="{{$check->notseen_profile_to_display}}" placeholder="slots Sequence ex (1,2,3)" required = "required">
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1">Timing on Slot (in Minutes format (hh:mm:ss))</label>
      <input type="integer" name="slottime" class="form-control" id="exampleInputPassword1" value="{{$check->slot_timing ?: 0}}" placeholder="enter a slot timing">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection