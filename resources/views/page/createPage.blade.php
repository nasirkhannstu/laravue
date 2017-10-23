@extends('layouts.home')
@section('title', 'Start Your Business')
@section('content')
<div class="row">
  <div class="col-md-5">
    @include ('partials._leftsidebar')
  </div>
  <div class="col-md-7">
@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
	<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create Your Store</h3>
        </div>
        <form action="{{route('createStore')}}" method="post" enctype="multipart/form-data">
        	{{csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Store Name</label>
              <input type="text" name="name" class="form-control" placeholder="...">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Store Unique Name</label>
              <input type="text" name="slug" class="form-control" placeholder="...">
              <p class="help-block">Store Unique Name.</p>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" name="description" rows="3" placeholder="..."></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Store Banner</label>
              <input type="file" name="banner" id="exampleInputFile">
              <p class="help-block">This is your store's banner.</p>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection