@extends('layouts.home')
@section('title', 'Edit Information')

@section('content')
<div class="row">
  <div class="col-md-5">
    @include ('partials._leftsidebar')    
  </div>
  <div class="col-md-7">
	<post></post>
	<feed></feed>    
  </div>
</div>
@endsection