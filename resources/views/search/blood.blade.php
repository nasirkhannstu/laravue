@extends('layouts.home')
@section('title', 'Edit Information')

@section('content')
<div class="row">
  <div class="col-md-5">
    <profilehead></profilehead>
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Accepted Blood requests</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <donationsaccept><donationsaccept>
    </div>
  </div>
  <div class="col-md-7">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Your donationship status</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="product-info blood-register">
          <donationstatus></donationstatus>
        </div>
        <!-- <donationreq><donationreq> -->
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Newly joined blood doners</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
          <br><br>
          <div class="row">
            <div class="col-md-6">
              <input class="form-control" placeholder="Search by Location"></input>              
            </div>
            <div class="col-md-6">
              <input class="form-control" placeholder="Search by Group"></input>  
            </div>
          </div>
        </div>
        <donars><donars>
    </div>
  </div>
</div>  

@endsection
<style>
	.blood-register{
		padding:10px;
	}
</style>