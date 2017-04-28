@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-default">
				<form action="{{route('account.update')}}" method="post" enctype="multipart/form-data">
				{{Session::get('success')}}
				{{ csrf_field() }}
					<div class="panel-heading">
						<img src="{{Storage::url($user->avatar)}}" width="100%">
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
		</div>
		<div class="col-md-6">
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
		
</div>
@endsection