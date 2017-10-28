@extends('layouts.home')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-widget widget-user">
      <div class="widget-user-header bg-black" style="background: url('../img/photo1.png') center center;">
        <h3 class="widget-user-username">{{$page->user->fullname}}</h3>
        <h5 class="widget-user-desc">Web Developer</h5>
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
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Basic Info</h3>
      </div>
      <div class="box-body">
        <strong>Name</strong>
        <input type="text" name="name" class="form-control" value="{{$page->name}}">
        <hr>
        <strong>Unique Name</strong>
        <input type="text" name="slug" class="form-control" value="{{$page->slug}}">
        <hr>
        <strong>Description</strong>
        <p class="text-muted"></p>
        <textarea class="form-control" name="description">{{$page->description}}</textarea>
        <hr>
        <button class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Address</h3>
      </div>
      <div class="box-body">
        <strong>District</strong>
        <p class="text-muted">{{$page->address->district_id}}</p>
        <hr>
        <strong>Thana</strong>
        <p class="text-muted">{{$page->address->thana_id}}</p>
        <hr>
        <strong>Zip</strong>
        <p class="text-muted">{{$page->address->zip}}</p>
        <hr>
        <strong>Store Address</strong>
        <p class="text-muted">{{$page->address->address}}</p>
      </div>
    </div>
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Contact Information</h3>
      </div>
      <div class="box-body">
        <strong>Phone</strong>
        <p class="text-muted">{{$page->address->phone}}</p>
        <hr>
        <strong>E-mail</strong>
        <p class="text-muted">{{$page->address->email}}</p>
      </div>
    </div>
  </div>
</div>
@endsection
