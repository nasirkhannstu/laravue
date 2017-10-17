<template>
<div class="">
    <div class="panel panel-default">
        <div class="panel-body">
            <textarea class="form-control feed-form" rows="3" v-model="content" placeholder="Write Something Awesome..."></textarea>
            <br>
            <button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">CreatePost</button>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                content:'',
                not_working: true
            }
        },
        mounted() {
            
        },
        methods:{
            create_post(){
                axios.post('/create/post', { content: this.content }).then((resp)=>{
                    this.content = ''
                    this.$store.commit('update_post',{
                        post:resp.data
                    })
                    new Noty({
                        type: 'success',
                        layout: 'bottomLeft',
                        text: 'Your post has published'
                    }).show();
                    console.log(resp)
                })
            }
        },
        watch:{
            content(){
                if(this.content.length > 0){
                    this.not_working = false
                }else{
                    this.not_working = true
                }
            }
        }
    }
</script>
<style>
    .feed-form{
        border:none;
        resize: none;
        background:#ffffff;
    }
</style>