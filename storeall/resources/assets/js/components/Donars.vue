<template>
<div class="">
    <div class="box-body">
      <ul class="products-list product-list-in-box">
        <li class="item" v-for="donar in donars">
          <div class="product-img">
            <img :src="donar.user.avatar" alt="Product Image">
          </div>
          <div class="product-info">
            <a href="" class="product-title">{{donar.user.fullname}}
              <span class="label label-warning"> &nbsp{{donar.bloodgroup}}</span></a>
              <donarrequest :donar_user_id="donar.user.id"></donarrequest>
                <span class="product-description">
                  <p>District: {{donar.district}} | Post Code: {{donar.postcode}}</p>
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
    import donarrequest from './Donarrequest.vue'
    export default {
        data(){
            return{
                
            }
        },
        components:{
            donarrequest
        },
        mounted() {
            this.get_donars()
        },
        methods:{
            get_donars(){
                axios.get('/search/blood_donars').then( (donars)=>{
                    donars.data.forEach( (donar) => {
                        this.$store.commit('add_donars', donar)
                    })
                    //console.log(donars)
                })
            }
        },
        computed:{
            donars(){
                return this.$store.getters.all_donars
            }
        }
    }
</script>
<style>
    .avater-feed{
        border-radius: 50%;
    }
</style>