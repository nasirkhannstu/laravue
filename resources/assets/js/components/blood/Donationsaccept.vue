<template>
<div class="">
    <div class="box-body">
      <ul class="products-list product-list-in-box">
        <li class="item" v-for="accept in accepts">
          <div class="product-img">
            <img :src="accept.user.avatar" alt="Product Image">
          </div>
          <div class="product-info">
            <a href="" class="product-title">{{accept.user.nicname}}</a> 
              <span class="label label-warning"> &nbsp{{accept.bloodgroup}}</span>
                <p>Accepts your request to donate blood. Here is his contact details.</p>
                <span class="product-description">
                  <p>Post Code: <strong>{{accept.postcode}}</strong> | Contact: District: <strong>{{accept.district}}</strong> <br> Phone: <strong>{{accept.phone}}</strong></p>
                </span>
          </div>
        </li>
      </ul>
    </div>
    <div class="box-footer text-center">
      <a href="" class="uppercase">Load More</a>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                accepts:[]
            }
        },
        mounted() {
            this.get_accepted_donars()
        },
        methods:{
            get_accepted_donars(){
                axios.get('/get_accepted_donars').then( (accepts)=>{
                    this.accepts = accepts.data
                })
            }
        }
    }
</script>
<style>
    .avater-feed{
        border-radius: 50%;
    }
</style>