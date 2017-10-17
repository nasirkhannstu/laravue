<template>
<div class="">
  <div v-for="pos in posts">
    <div class="box box-widget" v-if="pos.content">
      <div class="box-header with-border">
        <div class="user-block">
          <img class="img-circle" :src="pos.user.avatar" alt="User Image">
          <span class="username"><a href="#">{{pos.user.fullname}}</a></span>
          <span class="description">Shared publicly - {{pos.created_at}}</span>
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
        <p>{{pos.content}}</p>
        <like :id="pos.id"></like>
      </div>
      <div class="box-footer box-comments" style="display: block;">
        <div class="box-comment">
          <!-- User image -->
          <img class="img-circle img-sm" src="img/user3-128x128.jpg" alt="User Image">

          <div class="comment-text">
                <span class="username">
                  Maria Gonzales
                  <span class="text-muted pull-right">8:03 PM Today</span>
                </span><!-- /.username -->
            It is a long established fact that a reader will be distracted
            by the readable content of a page when looking at its layout.
          </div>
          <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
      </div>
      <div class="box-footer" style="display: block;">
        <form action="#" method="post">
          <img class="img-responsive img-circle img-sm" src="img/user4-128x128.jpg" alt="Alt Text">
          <!-- .img-push is used to add margin to elements next to floating images -->
          <div class="img-push">
            <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
          </div>
        </form>
      </div>
    </div>
    <div class="small-box bg-red" v-else-if="pos.blood == 1">
      <div class="inner text-center">
        <h4>Meet, New Blood Donar</h4>
        <h3>{{pos.user.fullname}}</h3>
        <p>Blood Group: {{pos.bloodgroup}}</p>
        <p>Location: {{pos.district}} | Phone: {{pos.postcode}}</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">
        Register Now <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>
</template>

<script>
import like from './Like.vue'

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
        methods:{
            get_feed(){
                axios.get('/feed').then( (post)=>{
                    post.data.forEach( (post) => {
                        this.$store.commit('add_post', post)
                    })
                    //console.log(post)
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
    .avater-feed{
        border-radius: 50%;
    }
</style>