@extends('layouts.home')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-widget widget-user">
      <div class="widget-user-header bg-black" style="background: url('../img/photo1.png') center center;">
        <h3 class="widget-user-username">{{$user->user->fullname}}</h3>
        <h5 class="widget-user-desc">Web Developer</h5>
      </div>
      <div class="widget-user-image">
        <img class="img" src="{{$user->user->avatar}}" alt="User Avatar">
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-4  col-xs-4 border-right">
            <div class="description-block">
              <h5 class="description-header">3,200</h5>
              <span class="description-text">SALES</span>
            </div>
          </div>
          <div class="col-sm-4  col-xs-4 border-right">
            <div class="description-block">
              <h5 class="description-header">13,000</h5>
              <span class="description-text">FOLLOWERS</span>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <div class="description-block">
              <h5 class="description-header">35</h5>
              <span class="description-text">PRODUCTS</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    @if(Auth::id() !== $user->user->id)
    <div class="panel panel-default">
      <div class="panel-body">
        <friend :profile_user_id="{{$user->user->id}}"></friend>
      </div>
    </div>
    @endif
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">About Me</h3>
        @if(Auth::id() == $user->user->id)
        <span class="pull-right">
          <a href="{{route('profile.edit')}}"><i class="fa fa-pencil margin-r-5"></i></a>
        </span>
        @endif
      </div>
      <div class="box-body">
        <strong><i class="fa fa-book margin-r-5"></i> Name</strong>
        <p class="text-muted">
          Full Name: {{$user->user->fullname}}<br>
          Nic Name: {{$user->user->nicname}}
        </p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i> Phone</strong>
        <p class="text-muted">{{$user->phone}}</p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i> FB</strong>
        <p class="text-muted">{{$user->fb}}</p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
        <p class="text-muted">Dictrict: {{$user->district}} - Post Code: {{$user->postcode}}</p>
        <hr>
        <strong><i class="fa fa-file-text-o margin-r-5"></i> Myself</strong>
        <p>{{$user->user->about}}</p>
      </div>
    </div>

    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Latest Members</h3>
        <div class="box-tools pull-right">
          <span class="label label-danger">8 New Members</span>
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <ul class="users-list clearfix">
          <li>
            <img src="../img/user1-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Alexander Pierce</a>
            <span class="users-list-date">Today</span>
          </li>
          <li>
            <img src="../img/user8-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Norman</a>
            <span class="users-list-date">Yesterday</span>
          </li>
          <li>
            <img src="../img/user7-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Jane</a>
            <span class="users-list-date">12 Jan</span>
          </li>
          <li>
            <img src="../img/user6-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">John</a>
            <span class="users-list-date">12 Jan</span>
          </li>
          <li>
            <img src="../img/user2-160x160.jpg" alt="User Image">
            <a class="users-list-name" href="#">Alexander</a>
            <span class="users-list-date">13 Jan</span>
          </li>
          <li>
            <img src="../img/user5-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Sarah</a>
            <span class="users-list-date">14 Jan</span>
          </li>
          <li>
            <img src="../img/user4-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Nora</a>
            <span class="users-list-date">15 Jan</span>
          </li>
          <li>
            <img src="../img/user3-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Nadia</a>
            <span class="users-list-date">15 Jan</span>
          </li>
        </ul>
        <!-- /.users-list -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href="javascript:void(0)" class="uppercase">View All Users</a>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
  <div class="col-md-7">
    <donateaccept><donateaccept>
  </div>
</div>
@endsection
