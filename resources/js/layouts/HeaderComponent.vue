<template>
	<div class="shadow-lg mb-5">
		<div class="py-8 px-10 bg-teal-600 text-white">
			

			<router-link :to="{name: 'music.index'}">
				<h1 class="font-bold cursor-pointer">Single Page Application</h1>
			</router-link>
			

			<nav class="block md:hidden ">
				<div class="float-right cursor-pointer">
					<div @click="toggle">
						<hambuger-component></hambuger-component>
					</div>
				</div>
			</nav>
			
			<!-- Navigatio links for guests on big screen  -->
			<nav class="hidden md:block" v-if="Guest()">
				<div class="float-right mr-20">
					<router-link 
						:to="{name: 'login'}"
						class="pr-5 hover:text-gray-400"
					>Login</router-link>
					
					<router-link 
						:to="{name: 'register'}"
						class="pr-5 hover:text-gray-400"
					>Register</router-link>

				</div>
			</nav>

			<!-- Navigation links for users on big screen -->
			<nav class="hidden md:block" v-if="Auth()">
					<div class="float-right mr-20">

					<router-link 
						:to="{name: 'music.index'}"
						class="pr-5 hover:text-gray-400"
					>Musics</router-link>

					<router-link 
						:to="{name: 'music.create'}"
						class="pr-5 hover:text-gray-400"
					>Add Artist</router-link>

					<router-link 
						:to="{name: 'about'}"
						class="pr-5 hover:text-gray-400"
					>About</router-link>
					
					<router-link 
						:to="{name: 'profile'}"
						class="pr-5 hover:text-gray-400"
					>Profile </router-link>	

					<a
						class="pr-5 cursor-pointer hover:text-gray-400"
						@click="Logout()"
					>Logout</a>

				</div>
			</nav>

		</div>

		<!-- Navigation links for guests on small screen -->
		<div class="block md:hidden bg-teal-500 text-white">
			<div v-if="Guest()">
				<nav v-if="isOpen" class="transition duration-500 ease" >
					<router-link 
						:to="{name: 'login'}"
						class="block px-2 py-1 hover:bg-gray-200 hover:text-teal-500 mb-2"
					>Login</router-link>
					
					<router-link 
						:to="{name: 'register'}"
						class="block px-2 py-2 hover:bg-gray-200 hover:text-teal-500"
					>Register</router-link>
					
				</nav>
			</div>
			
			<!-- Navigation links for users on small screen -->
			<div v-if="Auth()">
				<nav v-if="isOpen" class="transition duration-500 ease">

					<router-link 
						:to="{name: 'music.index'}"
						class="block px-2 py-1 hover:bg-gray-200 hover:text-teal-500 mb-2"
					>Musics</router-link>

					<router-link 
						:to="{name: 'music.create'}"
						class="block px-2 py-1 hover:bg-gray-200 hover:text-teal-500 mb-2"
					>Add Artist</router-link>

					<router-link 
						:to="{name: 'about'}"
						class="block px-2 py-1 hover:bg-gray-200 hover:text-teal-500 mb-2"
					>About</router-link>
					
					<router-link 
						:to="{name: 'profile'}"
						class="block px-2 py-1 hover:bg-gray-200 hover:text-teal-500"
					>Profile</router-link>

					<a 
						class="block px-2 py-2 hover:bg-gray-200 hover:text-teal-500"
						@click="Logout()"
					>Logout</a>
				</nav>
			</div>

		</div>
	</div>
</template>

<script>
	import HambugerComponent from '../components/HambugerComponent.vue'
	import { mapGetters, mapActions } from 'vuex'

	export default
	{
		data()
		{
			return{
				isOpen: false,
			}
		},

		computed:
		{
			...mapGetters([
				'user',
				'token',
				]),
		},

		methods: {
			...mapActions([
				'logout'
				]),

			toggle()
			{
				this.isOpen = !this.isOpen
			},

			Auth()
			{
				return !!this.user
			},

			Guest()
			{
				return !this.user
			},
			async Logout(){
				await this.logout()
				this.$router.push({name: 'login'})
			}
		},

		components: 
		{
			HambugerComponent,
		}
	}
</script>