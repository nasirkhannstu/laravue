<template>
<div class="">
  <div class="row text-info">
    <div class="col-xs-3 text-left">
      <p><strong>All</strong></p>
    </div>
    <div class="col-xs-3 text-left">
      <p><strong>Products</strong></p>
    </div>
    <div class="col-xs-3  text-center">
      <p><strong>Service</strong></p>
    </div>
    <div class="col-xs-3 text-right">
      <p><strong>Blood</strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="lockscreen-item">
        <form class="lockscreen-credentials">
          <div class="input-group">
            <input type="password" class="form-control" placeholder="password">
            <div class="input-group-btn">
              <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form>
      </div>      
    </div>
  </div>

  <div v-for="pos in posts">
    <div class="box box-widget" v-if="pos.feed == 'product'">
      <div class="box-header with-border">
        <div class="user-block">
          <img class="img-circle" :src="pos.post.user.avatar" alt="User Image">
          <span class="username"><a href="#">{{pos.post.page.name}}</a></span>
          <span class="description">Shared publicly - {{pos.post.created_at}}</span>
        </div>
        <!-- /user-block -->
        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body" style="display: block;">
        <img :src="pos.post.image" alt="Photo" class="img-responsive pad">
        <h4><strong>{{pos.post.name}}</strong></h4>
        <p>{{pos.post.content}}</p>
        <div class="row text-info">
          <div class="col-xs-4 text-left">
            <p v-if="pos.post.price"><strong>Price: {{pos.post.price}}tk</strong></p>
          </div>
          <div class="col-xs-4 text-center">
            <p v-if="pos.post.qty"><strong>Quantity: {{pos.post.qty}}</strong></p>
          </div>
          <div class="col-xs-4 text-right">
            <p v-if="pos.post.qty"><strong>Discount: {{pos.post.discount}}%</strong></p>
          </div>
        </div>

        <like :id="pos.post.id"></like>
        <br>
        <p class="text-center pcursore text-info" data-toggle="modal" data-target=".bs-example-modal-sm" @click="showMore(pos.post.id)"><strong>Details</strong></p>
      </div>

    </div>
    <div class="small-box bg-red" v-else-if="pos.feed == 'blood'">
      <div class="inner text-center">
        <p>Meet, New Blood Donar <br><strong><a :href="'/profile/'+pos.post.user.slug">{{pos.post.user.fullname}}</a></strong></p>
        <div class="user-block donationImageBlock">
          <img class="img-circle" :src="pos.post.user.avatar" alt="User Image">
        </div>
        <p>Blood Group: {{pos.post.bloodgroup}} - Location: {{pos.post.district}} | Phone: {{pos.post.postcode}}</p>
      </div>
      <a href="/blood" class="small-box-footer">
        Blood Doners Community &nbsp&nbsp<i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  

  <!-- Single Product View -->


  <div v-if="apost != ''" class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog bs-example-modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        
        <div class="box box-widget" v-if="apost.feed == 'product'">
          <div class="box-header with-border">
            <div class="user-block">
              <img class="img-circle" :src="apost.post.user.avatar" alt="User Image">
              <span class="username"><a href="#">{{apost.post.page.name}}</a></span>
              <span class="description">Shared publicly - {{apost.post.created_at}}</span>
            </div>
            <!-- /user-block -->
            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body" style="display: block;">
            <img :src="apost.post.image" alt="Photo" class="img-responsive pad">
            <h4><strong>{{apost.post.name}}</strong></h4>
            <p>{{apost.post.content}}</p>

            <div class="row text-info">
              <div class="col-xs-4 text-left">
                <p v-if="apost.post.price"><strong>Price: {{apost.post.price}}tk</strong></p>
              </div>
              <div class="col-xs-4 text-center">
                <p v-if="apost.post.qty"><strong>Quantity: {{apost.post.qty}}</strong></p>
              </div>
              <div class="col-xs-4 text-right">
                <p v-if="apost.post.discount"><strong>Discount: {{apost.post.discount}}%</strong></p>
              </div>
            </div>

            <like :id="apost.post.id"></like>
          </div>
          <comment :id="apost.post.id"></comment>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>

</div>
</template>

<script>
import like from './Like.vue'

    export default {
        data(){
            return{
                name:'',
                apost:[],
            }
        },
        components:{
            like
        },
        mounted() {
            this.get_feed()
        },
        methods:{
            get_feed(){
                axios.get('/feed').then( (post)=>{
                    post.data.forEach( (post) => {
                        this.$store.commit('add_post', post)
                    })
                    //console.log(post)
                })
            },
            showMore(id){
                this.apost = this.$store.state.posts.find((post) =>{
                    if(post.feed == 'product'){
                        return post.post.id == id
                    }
                })
                this.name = this.apost.post.page.name
            }
        },
        computed:{
            posts(){
                return this.$store.getters.all_posts
            }
        }
    }
</script>
<style>
    .small-box a{
      color:white;
    }
    .donationBlock > .inner {
        padding: 20px;
    }
    .donationImageBlock{
      padding: 20px;
    }
    .donationImageBlock img{
      text-align: center;
      float: none;
      width: 100px;
      height: 100px;
    }
    .pcursore{
      cursor: pointer;
    }
</style>