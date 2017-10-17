<template>
    <div>
        <p class="text-center" v-if="loading">
            Loading....
        </p>
        <p class="text-center" v-if="!loading">
            <button class="btn btn-success" v-if="status == 0" @click="add_friend">Add Friend</button>
            <button class="btn btn-success" v-if="status == 'pending'" @click="accept_friend">Accept Friend</button>
            <span class="text-success" v-if="status == 'waiting'">Waiting for response</span>
            <span class="text-success" v-if="status == 'friends'">Friends</span>
        </p>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                status:'',
                loading: true
            }
        },
        mounted() {
            axios.get('/check_relationship_status/' + this.profile_user_id).then((response)=>{
                this.status = response.data.status
                this.loading = false;
                console.log(response)
            })
        },
        props: ['profile_user_id'],
        methods:{
            add_friend(){
                this.loading = true;
                axios.get('/add_friend/' + this.profile_user_id).then((r)=>{
                    if(r.data == 1){
                        this.status = 'waiting'
                        new Noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: 'Friend request sent'
                        }).show();
                        this.loading = false
                    }
                })
            },
            accept_friend(){
                this.loading = true;
                axios.get('/accept_friend/' + this.profile_user_id).then((r)=>{
                    if(r.data == 1){
                        this.status = 'friends'
                        new Noty({
                            type: 'success',
                            layout: 'bottomLeft',
                            text: 'Friend request sent'
                        }).show();
                        this.loading = false
                    }
                })
            }
        }
    }
</script>
