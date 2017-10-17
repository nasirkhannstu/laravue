<template>
<div class="">
  <button class="btn btn-sm btn-primary pull-right" v-if="status == 'accepted'">Accepted</button>
  <button class="btn btn-sm btn-primary pull-right"  v-if="status == 'notaccepted'" @click="accept">Accept</button>
</div>
</template>

<script>
    export default {
        data(){
            return{
              status:'notaccepted'
            }
        },
        props:['requester_id'],
        methods:{
            accept(){
                this.status = 'accepted'
                axios.get('/accept_donation_request/' + this.requester_id).then( (resp)=>{
                    if(resp.data.status == 'accepted'){
                        new Noty({
                          type: 'success',
                          layout: 'topRight',
                          theme: 'mint',
                          text: 'You accepted',
                          timeout: 5000,
                          progressBar: true,
                          closeWith: ['click', 'button']
                        }).show();
                        this.status = 'accepted'
                    }else{
                        this.status = 'notaccepted'
                        new Noty({
                          type: 'alert',
                          layout: 'topRight',
                          theme: 'mint',
                          text: 'You are not able to donate blood right now',
                          timeout: 5000,
                          progressBar: true,
                          closeWith: ['click', 'button']
                        }).show();
                    }
                    //console.log(post)
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