@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-4">
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
		</div>
		<div class="col-md-6 col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						Account Info
					</div>
					<div class="panel-body">
						Phone No: <strong>{{$user->profile->phone}}</strong><br>
						Facebook: <strong>{{$user->profile->fb}}</strong><br>
						District: <strong>{{$user->profile->district}}</strong><br>
						Postal Code: <strong>{{$user->profile->postcode}}</strong><br>
						About: <strong>{{$user->profile->about}}</strong>
					</div>
				</div>
			</form>
		</div>

	</div>
		
</div>
@endsection
