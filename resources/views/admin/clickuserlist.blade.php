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

  <nav style = "margin-top: 5em;">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">User Deatils</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Packages he buyed</a>
      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Total like he have done</a>
      <a class="nav-item nav-link" id="nav-images-tab" data-toggle="tab" href="#nav-images" role="tab" aria-controls="nav-images" aria-selected="false">Customer Images</a>
      <a class="nav-item nav-link" id="nav-matches-tab" data-toggle="tab" href="#nav-matches" role="tab" aria-controls="nav-matches" aria-selected="false">Matches he Got</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <h3>User Id</h3>
            <p>{{$data['userdetails']->user_id}}</p>
          </div>
          <div class="col-sm-4">
            <h3>First Name</h3>
            <p>{{$data['userdetails']->first_name}}</p>
          </div>
          <div class="col-sm-4">
            <h3>Last Name</h3>
            <p>{{$data['userdetails']->last_name}}</p>
          </div>
          <div class="col-sm-4">
            <h3>DOB</h3>
            <p>{{$data['userdetails']->dob}}</p>
          </div>
          <div class="col-sm-4">
            <h3>Bio</h3>
            <p>{{$data['userdetails']->bio}}</p>
          </div>
          <div class="col-sm-4">
            <h3>Gender</h3>
            <p>{{$data['userdetails']->gender}}</p>
          </div>
          <div class="col-sm-4">
            <h3>Age</h3>
            <p>{{$data['userdetails']->age}}</p>
          </div>
          <div class="col-sm-4">
            <h3>Work</h3>
            <p>{{$data['userdetails']->work}}</p>
          </div>
          <div class="col-sm-4">
            <h3>Designation</h3>
            <p>{{$data['userdetails']->designation}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Total Packages he Bought</th>
            <th scope="col">SuperLike Packages</th>
            <th scope="col">Hidden Profile Package</th>
            <th scope="col">Boosts Package</th>
            <th scope="col">String Go Package</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <th scope="row">{{$data['total_pck']}}</th>
          <td>{{count($data['superlike_pck'])}}</td>
          <td>{{count($data['hiddenprofile_pck'])}}</td>
          <td>{{count($data['boosts_pck'])}}</td>
          <td>{{count($data['stringsgo_pck'])}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Total Swipe</th>
            <th scope="col">Right Swipe</th>
            <th scope="col">Left Swipe</th>
            <th scope="col">SuperLike</th>
            <th scope="col">Pattern he follows</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <th scope="row">{{count($data['like'])}}</th>
          <td>{{$data['rightswipe']}}</td>
          <td>{{$data['leftswipe']}}</td>
          <td>{{$data['superlike']}}</td>
          <td>{{$data['pattern']}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="tab-pane fade" id="nav-images" role="tabpanel" aria-labelledby="nav-images-tab">
      @foreach($data['userimages'] as $ui)
        <a href="{{'http://localhost:8000/userimages/'.$ui->image_name}}" target="_blank">{{$ui->image_name}}</a><br>
      @endforeach
    </div>
    <div class="tab-pane fade" id="nav-matches" role="tabpanel" aria-labelledby="nav-matches-tab">
      @if (isset($data['matches']['0']) == false)
        <h3>No Matches he Got</h3>
      @endif
    </div>
    {{-- <div class="container">
      <h3>Matches He Got:</h3>{{(count($data['matches']))}}
    </div> --}}
  </div>
@endsection 