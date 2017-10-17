<template>
<div>
    <button class="btn btn-sm btn-primary pull-right" v-if="status == 'request'" @click="request">Request</button></a>
    <button class="btn btn-sm btn-primary pull-right" v-if="status == 'pending'" @click="cancelrequest">Cancel</button></a>
</div>
</template>

<script>
    export default {
        data(){
            return{
                status:''
            }
        },
        props:['donar_user_id'],
        mounted() {
            axios.get('/check_donation_status/' + this.donar_user_id).then((response)=>{
                this.status = response.data.status
                //console.log(this.donar_user_id)
            })
        },
        methods:{
            request(){
                this.status = 'pending'
                axios.get('/request/' + this.donar_user_id).then( (resp)=>{
                    if(resp.data == 1){
                        new Noty({
                          type: 'success',
                          layout: 'topRight',
                          theme: 'mint',
                          text: 'Your Request Canceled Successfully',
                          timeout: 5000,
                          progressBar: true,
                          closeWith: ['click', 'button']
                        }).show();
                        this.status = 'pending'
                    }else{
                        this.status = 'request'
                        new Noty({
                          type: 'alert',
                          layout: 'topRight',
                          theme: 'mint',
                          text: 'Something Wrong There',
                          timeout: 5000,
                          progressBar: true,
                          closeWith: ['click', 'button']
                        }).show();
                    }
                    //console.log(post)
                })
            },
            cancelrequest(){
                this.status = 'request'
                axios.get('/cancelrequest/' + this.donar_user_id).then( (resp)=>{
                    if(resp.data == 1){
                        new Noty({
                          type: 'success',
                          layout: 'topRight',
                          theme: 'mint',
                          text: 'Your Request Canceled Successfully',
                          timeout: 5000,
                          progressBar: true,
                          closeWith: ['click', 'button']
                        }).show();
                        this.status = 'request'
                    }else{
                        this.status = 'pending'
                        new Noty({
                          type: 'error',
                          layout: 'topRight',
                          theme: 'mint',
                          text: 'Something Wrong There',
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