import VueRouter from 'vue-router';

let routes=[
{
	path:'/',
	component:require('./components/Index')
},{
	path:'/about',
	component:require('./components/About')
},{
	path:'/profile',
	component:require('./components/Profile')
}
];
export default new VueRouter({
	routes
})