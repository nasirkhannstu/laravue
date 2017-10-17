<template>
<div class="box box-widget widget-user">
  <div class="widget-user-header bg-black" style="background: url('../img/photo1.png') center center;">
    <h3 class="widget-user-username">{{this.$store.state.auth_user.fullname}}</h3>
    <h5 class="widget-user-desc">Web Developer</h5>
  </div>
  <div class="widget-user-image">
    <img class="img" :src="this.$store.state.auth_user.avatar" alt="User Avatar">
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
</template>