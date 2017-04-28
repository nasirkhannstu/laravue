@extends('layouts.app')

@section('content')
<div class="">
	<div class="row">
		<div class="col-md-3 col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<img src="{{Storage::url($user->avatar)}}" width="100%">
				</div>
				<div class="panel-body">
					<strong>Email:<br>{{$user->email}}</strong><br><br>
					<strong>Full Name:<br>{{$user->fullname}}</strong><br><br>
					<strong>Nicname:<br>{{$user->nicname}}</strong><br><br>
					<p>
						@if(Auth::id() == $user->id)
							<a href="{{route('profile.edit')}}" class="btn btn-info">Edit Ptofile</a>
						@endif
					</p>
				</div>
			</div>
			@if(Auth::id() !== $user->id)
			<div class="panel panel-default">
				<div class="panel-body">
					<friend :profile_user_id="{{$user->id}}"></friend>
				</div>
			</div>
			@endif
		</div>
		<div class="col-md-6 col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						Account Info
					</div>
					<div class="panel-body">
						<h3 class="text-info">Educational Information</h3>
						School: <strong>{{$user->profile->phone}}</strong><br>
						College: <strong>{{$user->profile->fb}}</strong><br>
						University: <strong>{{$user->profile->fb}}</strong><br>

						<h3 class="text-info">Contact Information</h3>
						Phone No: <strong>{{$user->profile->phone}}</strong><br>
						Facebook: <strong>{{$user->profile->fb}}</strong><br>

						<h3 class="text-info">Address</h3>
						District: <strong>{{$user->profile->district}}</strong><br>
						Postal Code: <strong>{{$user->profile->postcode}}</strong><br>

						<h3 class="text-info">About Yourself</h3>
						<strong>{{$user->profile->about}}</strong>
					</div>
				</div>
			</form>
		</div>

	</div>
		
</div>
@endsection
