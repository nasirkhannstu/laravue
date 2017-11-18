import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state:{
		nots:[],
		posts:[],
		donars:[],
		auth_user:{}
	},
	getters:{
		all_nots(state){
			return state.nots
		},
		all_nots_count(state){
			return state.nots.length
		},
		all_posts(state){
			return state.posts
		},
		all_donars(state){
			return state.donars
		}
	},
	mutations:{
		add_not(state, not){
			state.nots.push(not)
		},
		add_donars(state, donars){
			state.donars.push(donars)
		},
		update_donars(state, payload){
			state.donars.unshift(payload.donar)
		},
		remove_donars(state, payload){
			var donar = state.donars.find( (donar) => {
				return donar.user_id === payload.donar
			})
			var index = state.donars.indexOf(donar)
			state.donars.splice(index, 1)
		},
		add_post(state, post){
			state.posts.push(post)
		},
		update_post(state, payload){
			state.posts.unshift(payload.post)
		},
		auth_user_data(state, user){
			state.auth_user = user
		},
		update_post_comment(state, payload){
			var post = state.posts.find( (p) => {
				if(p.feed == 'product'){
					return p.post.id === payload.id
				}
			})
			post.post.comments.push(payload.comment)
		},
		update_post_like(state, payload){
			var post = state.posts.find( (p) => {
				if(p.feed == 'product'){
					return p.post.id === payload.id
				}
			})
			post.post.likes.push(payload.like)
		},
		unlike_post(state, payload){
			var post = state.posts.find( (p) => {
				if(p.feed == 'product'){
					return p.post.id === payload.post_id
				}
			})
			console.log(post)
			var like = post.post.likes.find( (l) => {
				return l.id === payload.like_id
			})
			var index = post.post.likes.indexOf(like)
			post.post.likes.splice(index, 1)
		}
	},
	actions:{

	}
})