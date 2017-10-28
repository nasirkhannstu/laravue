<template>
<div>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          
          <div class="box-body">
            <p class="text-info"><strong>{{varr}}{{id}}</strong></p>
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
                varr: '',
            }
        },
        mounted() {
            this.varr = this.id
            console.log(this.id)
        },
        id: ['id'],
        methods:{
            create_post(){
                axios.post('/save_page_info', this.requests).then( (response)=>{
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