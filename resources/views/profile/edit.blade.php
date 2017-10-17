@extends('layouts.home')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-widget widget-user">
      <div class="widget-user-header bg-black" style="background: url('../../img/photo1.png') center center;">
        <h3 class="widget-user-username">{{$user->fullname}}</h3>
        <h5 class="widget-user-desc">Web Developer</h5>
      </div>
      <div class="widget-user-image">
        <img class="img" src="{{$user->avatar}}" alt="User Avatar">
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
    <div class="panel panel-default">
		<form action="{{route('account.update')}}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
			<div class="panel-heading">
				<img src="{{$user->avatar}}" width="100%">
				<div class="form-group">
					<label for="avatar"></label><br>
					<input type="file" name="avatar" accept="image/*">
				</div>
			</div>
			<div class="panel-body">
				<strong>Email: {{$user->email}}</strong><br><br>
				<div class="form-group">
					<label for="fullname">Full Name</label><br>
					<input type="text" name="fullname" style="border:0px;border-bottom:2px solid;" value="{{$user->fullname}}">
				</div>
				<div class="form-group">
					<label for="nicname">Nic Name</label><br>
					<input type="text" name="nicname" style="border:0px;border-bottom:2px solid;" value="{{$user->nicname}}">
				</div>
				<div class="form-group">
					<input type="submit" value="SAVE" class="btn btn-success">
				</div>
			</div>
		</form>
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
    <form action="{{route('profile.update')}}" method="POST">
		{{ csrf_field() }}
		<div class="panel panel-default">
			<div class="panel-heading">
				Account Info
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="phone">Phone No.</label><br>
					<input type="text" name="phone" style="border:0px;border-bottom:2px solid;" placeholder="Ex: +8801xxxxxxxx" value="{{$user->profile->phone}}">
				</div>
				<div class="form-group">
					<label for="fb">Facebook</label><br>
					<input type="text" value="{{$user->profile->fb}}" name="fb" placeholder="Ex: www.fb.com/profile/nasirkhan" style="border:0px;border-bottom:2px solid;width:100%;">
				</div>
				<div class="form-group">
					<label for="district">District</label><br>
					<input type="text" value="{{$user->profile->district}}" name="district" placeholder="Ex: Dhaka" style="border:0px;border-bottom:2px solid;">
				</div>
				<div class="form-group">
					<label for="postcode">Postal Code</label><br>
					<input type="number" value="{{$user->profile->postcode}}" name="postcode" placeholder="Ex: 1400" style="border:0px;border-bottom:2px solid;">
				</div>
				<div class="form-group">
					<label for="about">About Yourself</label><br>
					<textarea name="about" id="about" rows="4" style="border:0px;border-bottom:2px solid;width:100%">{{$user->profile->about}}</textarea>
				</div>
				<div class="form-group">
					<p class="text-center">
						<input type="submit" name="submit" value="SAVE" class="btn btn-success">
					</p>
				</div>
			</div>
		</div>
	</form>
  </div>
</div>
@endsection