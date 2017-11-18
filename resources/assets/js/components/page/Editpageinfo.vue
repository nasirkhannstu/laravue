<template>
<div>
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Address</h3>
        <span class="pull-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-pencil margin-r-5"></i>Edit</button>
        </span>
      </div>
      <div class="box-body">
        <strong>District</strong>
        <p class="text-muted">{{requests.district_id}}</p>
        <hr>
        <strong>Thana</strong>
        <p class="text-muted">{{requests.thana_id}}</p>
        <hr>
        <strong>Zip</strong>
        <p class="text-muted">{{requests.zip}}</p>
        <hr>
        <strong>Store Address</strong>
        <p class="text-muted">{{requests.address}}</p>
      </div>
    </div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog bs-example-modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Address</h4>
      </div>
      
      <div class="box-body">
        <p class="text-info"><strong>{{msg}}</strong></p>
        <br>

        <strong>District</strong>
        <input type="text" class="form-control" v-model="requests.district_id">
        <hr>

        <strong>Thana</strong>
        <input type="text" class="form-control" v-model="requests.thana_id">
        <hr>

        <strong>Zip</strong>
        <input type="text" class="form-control" v-model="requests.zip">
        <hr>
        <strong>Store Address</strong>
        <input type="text" class="form-control" v-model="requests.address">
        <br>
        <button class="btn btn-success" @click="create_post()">Save</button>
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
                requests:[],
                msg:'',
                message:''
            }
        },
        mounted() {
            axios.get('/page_info/' + this.page_id).then((response)=>{
                this.requests = response.data
            })
        },
        props: ['page_id'],
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