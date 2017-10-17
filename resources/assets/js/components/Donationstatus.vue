<template>
<div class="">
    <div v-if="donation == 'donar'">
        <h3>You Registered as a blood Donar</h3>
        <button class="btn btn-success" @click="sign_out()">Sign out Now</button>
        <br><br>
    </div>
    <div v-if="donation == 'notdonar'">
        <h3>You are not a blood doner!!! {{this.$store.state.donars.id}}</h3>
        <p>Many patients dies everyday for blood. Please donate blode right now.</p>

        <label>Blood Group</label>
        <input type="text" class="form-control" v-model="content"></textarea>
        <br>
        <button class="btn btn-success" :disabled="not_working" @click="make_doner()">Sign in Now</button>
        <br><br>
    </div>
</div>
</template>

<script>
    
    export default {
        data(){
            return{
                content:'',
                not_working: true,
                donation:''
            }
        },
        mounted() {
            axios.get('/check_auth_donation_status').then((response)=>{
                this.donation = response.data.status
                console.log(response.data)
            })
        },
        methods:{
            make_doner(){
                this.donation = 'donar'
                axios.post('/new_doner', { content: this.content }).then((resp)=>{
                    this.content = ''
                    this.$store.commit('update_donars',{
                        donar:resp.data
                    })
                    new Noty({
                        type: 'success',
                        layout: 'bottomLeft',
                        text: 'Happy Blood Donating'
                    }).show();
                })
            },
            sign_out(){
                this.donation = 'notdonar'
                axios.get('/cancel_doner').then((resp)=>{
                    this.$store.state.donars.find((donar) =>{
                    if(donar.user_id == this.$store.state.auth_user.id){
                        this.$store.commit('remove_donars',{
                            donar:this.$store.state.auth_user.id
                        })
                        new Noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: 'Hey!!! Come Back Soon'
                        }).show();
                    }
                })
                })
            }
        },
        computed:{
            auth_user_is_doner(){
                return this.$store.state.donars.find((donar) =>{
                    if(donar.id == this.$store.state.auth_user.id){
                        return true
                    }else{
                        return false
                    }
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
    .avater-feed{
        border-radius: 50%;
    }
</style>