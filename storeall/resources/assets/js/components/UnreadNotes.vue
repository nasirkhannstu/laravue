<template>
	<li>
		<a href="/notifications">
			Notifications
			<span class="badge">{{all_notes_count}}</span>
		</a>
	</li>
</template>
<script>
	export default {
		data(){
            return{
                count:''
            }
        },
		mounted(){
			this.get_unread()
		},
		methods:{
			get_unread(){
                axios.get('/get_unread/').then((nots)=>{
                    nots.data.forEach((nots) => {
                    	this.$store.commit('add_not', nots)
                    })
                    //console.log(nots.body)
                    //this.count = nots.data.length
                })
			}
		},
		computed:{
			all_notes_count(){
				return this.$store.getters.all_nots_count
			}
		}
	}
</script>