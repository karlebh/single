import Vue from 'vue'
import Cookie from 'js-cookie'
import VueRouter from 'vue-router'
import store from './store'

Vue.use(VueRouter)
Vue.use(store)


import RegisterComponent from './components/RegisterComponent.vue'
import LoginComponent from './components/LoginComponent.vue'
import HomeComponent from './components/HomeComponent.vue'
import HelloComponent from './components/HelloComponent.vue'
import AboutComponent from './components/AboutComponent.vue'
import ProfileComponent from './components/ProfileComponent.vue'
import index from './pages/music/index.vue'
import edit from './pages/music/edit.vue'
import create from './pages/music/create.vue'


const router =  new VueRouter({
	mode: 'history',
	routes: 
	[
		{path: '/register', name: 'register', component: RegisterComponent, meta: {guest: true}},
		{path: '/login', name: 'login', component: LoginComponent, meta: {guest: true}},
		{path: '/home', name: 'home', component: HomeComponent, meta: {requiresAuth: true}},
		{path: '/hello', name: 'hello', component: HelloComponent, meta: {requiresAuth: true}},
		{path: '/about', name: 'about', component: AboutComponent, meta: {requiresAuth: true}},
		{path: '/profile', name: 'profile', component: ProfileComponent, meta: {requiresAuth: true}},
		{path: '/music', name: 'music.index', component: index, meta: {requiresAuth: true}},
		{path: '/music/:slug/edit', name: 'music.edit', component: edit, meta: {requiresAuth: true}},
		{path: '/music/create', name: 'music.create', component: create, meta: {requiresAuth: true}},

		
	]
})


router.beforeEach((to, from, next) => {
	if (to.meta.requiresAuth) {
		if (Cookie.get('token')) {
			next()
		} else {
		next({name: 'login'})
		}
	} else {
		next()
	}
})


router.beforeEach((to, from, next) => {
	if (to.meta.guest) {
		if (Cookie.get('token')) {
			next({name: 'home'})
		} else {
		next()
		}
	} else {
		next()
	}
})


export default router;