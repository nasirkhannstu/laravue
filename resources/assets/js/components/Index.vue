<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default" v-for="user in users">
                    <div class="panel-heading">
                        Full Name: {{user.fullname}}
                    </div>
                    <div class="panel-body">
                        Nic Name: {{user.nicname}} <br>
                        E-mail: {{user.profile.phone}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                Nasir Khan Home
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users:[]
            }
        },
        mounted() {
            // var self=this;
            // axios.get('/vuetest').then(function(response){
            //     self.users = response.data;
            //     //console.log(response);
            // });
            axios.get('/vuetest').then((response)=>this.users = response.data)
        }
    }
</script>
