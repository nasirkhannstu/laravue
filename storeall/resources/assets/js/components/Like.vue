<template>
<div>
    <button type="button" class="btn btn-default btn-xs" v-if="!auth_user_likes_post" @click="like()">
        <i class="fa fa-thumbs-o-up"></i>
         Like
    </button>
    <button type="button" class="btn btn-default btn-xs" v-else @click="unlike()">
        <i class="fa fa-thumbs-o-down"></i>
        Unlike
    </button>
    <span class="pull-right text-muted">127 likes - 3 comments</span>
    <p v-for="like in post.likes">
        <img :src="like.user.avatar" alt="" width="20px" height="20px" class="avater-like">
    </p>   
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
                    this.$store.commit('update_post_like', {
                        id:this.id,
                        like:resp.data
                    })
                    //console.log(post)
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
                var likers = []

                this.post.likes.forEach( (like) => {
                    likers.push(like.user.id)
                })
                return likers
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
                    return post.id == this.id
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