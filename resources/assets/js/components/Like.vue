<template>
<div>
    <button type="button" class="btn btn-default btn-xs" v-if="!auth_user_likes_post" @click="like()">
        <i class="fa fa-thumbs-o-up"></i>
    </button>
    <button type="button" class="btn btn-default btn-xs" v-else @click="unlike()">
        <i class="fa fa-thumbs-o-down"></i>
    </button>

    <span class="pull-right text-muted" v-if="auth_user_likes_post">
        <i class="fa fa-thumbs-o-up"></i> You
        <span v-if="likecount == 2">and {{likecount - 1}} another</span>
        <span v-if="likecount > 2">and {{likecount - 1}} others</span>
        <span v-if="likecount == 1">liked this</span>
        <span> {{commentcount}} comments</span>
    </span>
    <span class="pull-right text-muted" v-else>

        <span v-if="likecount == 1"><i class="fa fa-thumbs-o-up"></i> 1 Like</span>
        <span v-if="likecount > 1"><i class="fa fa-thumbs-o-up"></i> {{likecount}}</span>
        <span> {{commentcount}} comments</span>
    </span>  
</div>
</template>

<script>
    export default {
        data(){
            return{
            }
        },
        mounted() {
            
        },
        methods:{
            like(){
                axios.get('/like/' + this.id).then( (resp)=>{
                    console.log(resp)
                    this.$store.commit('update_post_like', {
                        id:this.id,
                        like:resp.data
                    })
                })
            },
            unlike(){
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
            likers(){
                //console.log(this.post)
                var likers = []
                this.post.post.likes.forEach( (like) => {
                    likers.push(like.user.id)
                })
                return likers
            },
            likecount(){
                return this.likers.length
            },
            commentcount(){
                return this.post.post.comments.length
            },
            auth_user_likes_post(){
                var check_index = this.likers.indexOf(
                    this.$store.state.auth_user.id
                )
                if(check_index === -1)
                    return false
                else
                    return true
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
    .avater-like{
        border-radius: 50%;
    }
</style>