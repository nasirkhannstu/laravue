<template>
<div>
  <div v-for="pos in posts">
    <div class="box box-widget" v-if="pos.feed == 'product'">
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
        <p v-if="pos.post.price">Price: <strong>{{pos.post.price}}</strong></p>
        <p v-if="pos.post.qty">Available Quantity: <strong>{{pos.post.qty}}</strong></p>
        <p v-if="pos.post.discount"><button class="btn btn-success">Order Now</button> & get {{pos.post.discount}}% discount</p>

        <like :id="pos.post.id"></like>
      </div>
      <comment :id="pos.post.id"></comment>
    </div>
  </div>
</div>
</template>

<script>
import like from './../Like.vue'

    export default {
        data(){
            return{
                
            }
        },
        components:{
            like
        },
        mounted() {
            this.get_feed()
        },
        props: ['page_id'],
        methods:{
            get_feed(){
                axios.get('/pagefeed/' + this.page_id).then( (post)=>{
                    post.data.forEach( (post) => {
                        this.$store.commit('add_post', post)
                    })
                })
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