<template>
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Your Blood Donation Requests</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <ul class="products-list product-list-in-box">
          <li class="item" v-for="request in requests">
            <div class="product-img">
              <img :src="request.user.avatar" alt="Requester Image">
            </div>
            <div class="product-info">
              <a href="" class="product-title">{{request.user.fullname}}({{request.user.nicname}})</a>
              <donationaccepted :requester_id="request.user.id"></donationaccepted>
              <span class="product-description">
                <p>Email: {{request.user.email}} | Phone: {{request.phone}}</p>
                <p>District: {{request.district}} | Post Code: {{request.postcode}}</p>
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
    import donationaccepted from './Donationaccepted.vue'
    export default {
        data(){
            return{
              requests:[]
            }
        },
        components:{
            donationaccepted
        },
        mounted() {
            axios.get('/user_all_donation_requests').then((response)=>{
                this.requests = response.data
            })
        },
        methods:{

        }
    }
</script>
<style>
    .avater-like{
        border-radius: 50%;
    }
</style>