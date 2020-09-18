<template>
	<div class="flex">
		
	
	<div class="bg-gray-300 p-20 pl-20 justify-center w-full lg:w-1/2">

		<div 
			v-if="Error" 
			id="hide" 
			class="mb-6 bg-red-500 py-5 px-10 text-white font-semibold transition duration-100 ease"

		>
			<p>{{ error }} 
				<span 
					class="ml-24 w-20 h-20 cursor-pointer"
					@click="Hide()"
				>&times</span>
			</p>
		</div>

	  <form 
		class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" 
		@submit.prevent="Login"
		>

		<!-- Name -->
		<div class="mb-4">
		  <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
			Name
		  </label>
		  <input 
			  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
			  id="name" 
			  name="name" 
			  type="text" 
			  placeholder="Enter Name" 
			  v-model="name"
			  v-validate="'required|alpha_num'"
			  required
		  >
		  <span class="text-red-500 font-semibold">{{ errors.first('name') }}</span>
		</div>


		<div class="mb-6">
		  <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
			Password
		  </label>
		  <input 
			  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
			  id="password" 
			  name="password" 
			  type="password" 
			  placeholder="Enter Password" 
			  v-model="password"
			  v-validate="'required|alpha_num|min:6|max:100'"
			  required 
		  >
		  <span class="text-red-500 font-semibold">{{ errors.first('password') }}</span>
		</div>


		<div class="flex items-center justify-between">
		  <button class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
			Log In
		  </button>

		</div>

	  </form>


	</div>
		<div class="hidden md:w-1/2 lg:block">
			<div>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem expedita repellendus tium. Sapiente, voluptas, hic quisquam dicta quaerat dolores. Iusto veritatis, id si incidunt eius necessitatibus autem nam facere dolorum voluptatibus impedit veritatis, ab odio sed. Deleniti necessitatibus eius, id aut ullam tempora reiciendis iusto iure, modi, odio asperiores architecto ipsam repellendus excepturi delectus expedita culpa, officia accusantium impedit corrupti. Neque dolore autem nam eius omnis dolorem labore eligendi sequi illo minima distinctio, molestias odit, iste ducimus laboriosam ipsa consequuntur esse illum deleniti ipsum. Rem vel ullam ex perferendis sed nihil ratione repellendus animi quae eum. Possimus nulla deleniti ex assumenda, quasi harum rem cum quas eius. Perferendis recusandae voluptates qui totam facilis. Assumenda repudiandae dolor rem sit, vel dolores magni ullam cumque quis praesentium eius quos modi, nemo quasi excepturi perferendis iste necessitatibus inventore quidem ut vitae, aspernatur labore? Reiciendis laborum numquam at adipisci repellat, dolore exercitationem sint libero. Perferendis quas corrupti id architecto ut, quos. Voluptatum laborum, aliquid nam ullam laudantium magni repudiandae nesciunt fugiat, pariatur expedita possimus repellat voluptatem cumque quis maxime numquam. Velit tempore adipisci et quaerat modi voluptatum vero, sed minus sapiente, soluta eaque harum necessitatibus eligendi voluptate nemo doloremque. Quod reprehenderit nobis eligendi, corrupti, blanditiis molestias veniam laborum eum maiores similique odio? Corporis dicta aut aspernatur tenetur repellendus voluptatum modi architecto pariatur autem quae explicabo soluta eius rem voluptatibus maiores ipsa sed eum eos minima, id odit totam. Quia fugit, officia sit ipsam ipsum voluptatum suscipit aut, laudantium eligendi ipsa reiciendis velit ex odio illo voluptas aspernatur! Quod tempora vero veniam officiis. Earum.
			</div>
		</div>
	</div>
</template>

<script>

	import { mapActions } from 'vuex'

	export default
	{
		data()
		{
			return{
					name: null,
					password: null,
					error: null
				
			}
		},

		computed: 
		{
			Error(){
				return this.error !== null
			}
		},

		methods: 
		{
			...mapActions([
				'saveToken',
				'fetchUser'
				]),

			Hide(){
				document.querySelector('#hide').style.display = 'none'
				document.querySelector('#hide').style.transition = 'opacity 0'
				this.error = null
			},

			Login(){

				axios
					.post('/api/login', {name: this.name, password: this.password})
					.then(response => {
						let data = {
							'user' : response.config.data,
							'token' : response.data.access_token,
							'expiration' : response.data.expires_in, 
						}
						this.saveToken(data)
						this.fetchUser()
						this.$router.push({name: 'music.index'})
					})
					.catch(err => {
						this.error = err.response.data.error
						})
		} 

}

}
</script>




