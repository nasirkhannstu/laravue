<!-- Profile Image -->
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
      <!-- /.col -->
      <div class="col-sm-4 col-xs-4">
        <div class="description-block">
          <h5 class="description-header">35</h5>
          <span class="description-text">PRODUCTS</span>
        </div>
        <!-- /.description-block -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</div>
<!-- /.Services -->
<div class="info-box bg-red">
  <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
  <div class="info-box-content">
    <span class="info-box-text"><a href="{{route('search.blood')}}" style="color:white">Blood Doners</a></span>
    <span class="info-box-number">41,410</span>

    <div class="progress">
      <div class="progress-bar" style="width: 70%"></div>
    </div>
        <span class="progress-description">
          70% Increase in 30 Days
        </span>
  </div>
</div>
<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">About Me</h3>
    @if(Auth::id() == $user->user->id)
    <span class="pull-right">
      <a href=""><i class="fa fa-pencil margin-r-5"></i></a>
    </span>
    @endif
  </div>
  <!-- /.box-header -->
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
    <p>{{$user->about}}</p>
  </div>
  <!-- /.box-body -->
</div>