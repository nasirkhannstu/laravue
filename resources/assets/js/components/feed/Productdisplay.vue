<template>
<div>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          
          <div class="box-body">
            <p class="text-info"><strong>{{varr}}{{id}} is id.</strong></p>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
</div>
</template>

<script>
    export default {
        data(){
            return{
                varr:'',
                post:[],
            }
        },
        mounted() {
            this.varr = this.id,
            this.post = this.$store.getters.all_posts.find( (p) => {
                if(p.feed.type == 'post'){
                    return p.post.id === this.id
                }
            })
            console.log(this.post)
        },
        props: ['id'],
        methods:{
            get_post(){
                axios.get('/get_this_post', this.requests).then( (response)=>{
                    this.msg = response.data.msg
                    console.log(this.msg)
                    // if(response.errors){
                    //     this.errors = response.data.errors
                    // }else{
                    //     this.message = 'Address Updated!'
                    // }
                })
            }
        },
    }
</script>
<style>

</style>