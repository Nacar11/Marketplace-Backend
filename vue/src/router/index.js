import {createRouter, createWebHistory} from 'vue-router'
import home from '../views/home.vue'
import shop from '../views/shop.vue'
import about from '../views/about.vue'
import account from '../views/account.vue'
import sale from '../views/sale.vue'
import dashboardLayout from '../components/layout/dashboardLayout.vue'
import authenticationLayout from '../components/layout/authenticationLayout.vue'
import login from '../views/login.vue'
import signup from '../views/signup.vue'
import addProduct from '../views/addProduct.vue'
import shoppingCart from '../views/shoppingCart.vue'
import address from '../views/address.vue'
import checkout from '../views/checkout.vue'
import store from '../store'

const routes = [
	{
	path: '/',
	component: dashboardLayout,
	children: [
				{
				path: '/',
				name:'home',
				component:home
				},
				{
				path: '/shop',
				name:'shop',
				component: shop
						},
				{
				path: '/about',
				name:'about',
				component: about
						},
				{
				path: '/sale',
				name:'sale',
				component: sale
						},
				{
				path: '/account',
				name:'account',
				component: account
						},
				{
				path: '/product',
				meta: {requiresAuth: true},
				name:'addProduct',
				component: addProduct
						},
				{
				path: '/cart',
				meta: {requiresAuth: true},
				name:'shoppingCart',
				component: shoppingCart
						},
				{
				path: '/address',
				meta: {requiresAuth: true},
				name:'address',
				component: address
						},
				{
				path: '/checkout',
				meta: {requiresAuth: true},
				name:'checkout',
				component: checkout
						},
				],
				},
	{
	path: '/',
	component: authenticationLayout,
	children: [
				{
				path: '/login',
				name:'login',
				component:login
				},
				{
				path: '/signup',
				name:'signup',
				component: signup
						},
			],
			}
];

const router = createRouter ({
    history: createWebHistory(),
    routes
})


router.beforeEach((to,from,next) => {
	if( to.meta.requiresAuth && !store.state.user.token ){
		next({name: 'login'})
	}
	else if( store.state.user.token && (to.name === 'login' || to.name === 'signup')){
		next({name: 'home'})
	}
	else {
		next();
	}
});


export default router;