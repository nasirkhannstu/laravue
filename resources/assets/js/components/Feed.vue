<template>
<div class="">
  
  <div v-for="pos in posts">
    <div class="box box-widget" v-if="pos.feed.type == 'post'">
      <div class="box-header with-border">
        <div class="user-block">
          <img class="img-circle" :src="pos.post.user.avatar" alt="User Image">
          <span class="username"><a href="#">{{pos.post.user.fullname}}</a></span>
          <span class="description">Shared publicly - {{pos.post.created_at}}</span>
        </div>
        <!-- /user-block -->
        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
            <i class="fa fa-circle-o"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body" style="display: block;">
        <img :src="pos.post.image" alt="Photo" class="img-responsive pad">
        <h4><strong>{{pos.post.name}}</strong></h4>
        <p>{{pos.post.content}}</p>
        <p v-if="pos.post.price"><strong>Product Price: {{pos.post.price}}</strong></p>
        <p v-if="pos.post.qty"><strong>Available Quantity: {{pos.post.qty}}</strong></p>
        <p v-if="pos.post.discount">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" @click="showMore(pos.post.id)"><i class="fa fa-pencil margin-r-5"></i>Show More</button>
        </p>

        <like :id="pos.post.id"></like>
      </div>
      <comment :id="pos.post.id"></comment>
    </div>
    <div class="small-box bg-red" v-else-if="pos.feed.type == 'blood'">
      <div class="inner text-center">
        <p>Meet, New Blood Donar <br><strong><a :href="'/profile/'+pos.profile.user.slug">{{pos.profile.user.fullname}}</a></strong></p>
        <div class="user-block donationImageBlock">
          <img class="img-circle" :src="pos.profile.user.avatar" alt="User Image">
        </div>
        <p>Blood Group: {{pos.profile.bloodgroup}} - Location: {{pos.profile.district}} | Phone: {{pos.profile.postcode}}</p>
      </div>
      <a href="/blood" class="small-box-footer">
        Blood Doners Community &nbsp&nbsp<i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
    <div class="small-box bg-green donationBlock" v-else-if="pos.feed.type == 'donation'">
      <div class="inner text-center donationBlockInner">
        <p><strong><a :href="'/profile/'+pos.profile.user.slug">{{pos.profile.user.fullname}}</a></strong>  
        is going to donate blood <strong> <a :href="'/profile/'+pos.feed.data.slug">{{pos.feed.data.fullname}}</a></strong></p>
        <div class="user-block donationImageBlock">
          <img class="img-circle" :src="pos.profile.user.avatar" alt="User Image">
          <img class="img-circle" :src="pos.feed.data.avatar" alt="User Image">
        </div>
        <p>Location: {{pos.profile.district}} | Phone: {{pos.profile.postcode}}</p>
      </div>
      <a href="/blood" class="small-box-footer">
        Blood Doners Community &nbsp&nbsp<i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <productdisplay :id="clicked"></productdisplay>
</div>
</template>

<script>
import like from './Like.vue'

    export default {
        data(){
            return{
                clicked:'',
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
                this.clicked = id
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
</style>