<template>
<div>
    <div v-for="pos in comments">
        <div class="box-footer box-comments" style="display: block;">
            <div class="box-comment">
              <img class="img-circle img-sm" src="http://localhost:8000/uploads/storeProduct/1508653068-4-1.jpeg" alt="User Image">
              <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted pull-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                {{pos.content}}
              </div>
            </div>
        </div>        
    </div>
    <div class="box-footer" style="display: block;">
        <img class="img-responsive img-circle img-sm" src="http://localhost:8000/uploads/storeProduct/1508653068-4-1.jpeg" alt="Alt Text">
      <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="input-group">
          <input type="text" name="message" placeholder="Type Message ..." class="form-control commentInput" v-model="content">
          <span class="input-group-btn">
            <button type="button" class="btn btn-warning btn-flat" @click="comment()">Send</button>
          </span>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                content:'',
            }
        },
        mounted() {
            
        },
        methods:{
            comment(){
                axios.post('/create/comment', { 
                post_id: this.id,
                content: this.content

                }).then((resp)=>{
                    this.content = ''
                    this.$store.commit('update_post_comment',{
                        id:this.id,
                        comment:resp.data
                    })
                })
            },
            deletComment(){
                axios.get('/unlike/' + this.id).then( (resp)=>{
                    this.$store.commit('unlike_post', {
                        post_id:this.id,
                        like_id:resp.data
                    })
                    //console.log(post)
                })
            }
        },
        props:['id'],
        computed:{
            comments(){
                //console.log(this.post)
                var comments = []
                this.post.post.comments.forEach( (comment) => {
                    comments.push(comment)
                })
                return comments
            },
            commentcount(){
                return this.comments.length
            },
            post(){
                return this.$store.state.posts.find((post) =>{
                    if(post.feed.type == 'post'){
                        return post.post.id == this.id
                    }
                })
            }
        }
    }
</script>
<style>
.commentInput{
    border:0px;
}
</style>