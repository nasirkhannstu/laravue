@extends('layouts.home')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-widget widget-user">
      <div class="widget-user-header bg-black" style="background: url('../img/photo1.png') center center;">
        <h3 class="widget-user-username">{{$page->user->fullname}}</h3>
        <h5 class="widget-user-desc">Web Developer</h5>
      </div>
      <div class="widget-user-image">
        <img class="img" src="{{$page->user->avatar}}" alt="User Avatar">
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
        @if(Auth::id() == $page->user->id)
        <span class="pull-right">
          <a href=""><i class="fa fa-pencil margin-r-5"></i>Edit</a>
        </span>
        @endif
      </div>

      <div class="box-body">
        <strong>Name</strong>
        <p class="text-muted">{{$page->name}}</p>
        <hr>
        <strong>UniqueName</strong>
        <p class="text-muted">{{$page->slug}}</p>
        <hr>
        <strong>Description</strong>
        <p class="text-muted">{{$page->description}}</p>
        <hr>
        <strong>Status</strong>
        <p class="text-muted">Approved</p>
      </div>
    </div>

    
    <editpageinfo :page_id="{{$page->id}}"></editpageinfo>
    
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Contact Information</h3>
        @if(Auth::id() == $page->user->id)
        <span class="pull-right">
          <a href="{{route('editStoreInfo', $page->slug)}}"><i class="fa fa-pencil margin-r-5"></i>Edit</a>
        </span>
        @endif
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
  <div class="col-md-7">
    <post :page_id="{{$page->id}}"></post>
    <storefeed :page_id="{{$page->id}}"></storefeed>
  </div>
</div>
@endsection
