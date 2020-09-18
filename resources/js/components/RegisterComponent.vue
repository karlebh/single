<template>
<div class="flex">
		
	<div class="max-w-xl bg-gray-300 p-20 justify-center lg:w-1/2">
	  
	  <div 
			v-if="Error" 
			id="hide" 
			class="mb-6 bg-red-500 py-5 px-10 text-white font-semibold transition duration-100 ease max-w-md"

		>
			<p>{{ error }} 
				<span 
					class="ml-24 w-20 h-20 cursor-pointer"
					@click="Hide()"
				>&times</span>
			</p>
		</div>
		
	

	  <form @submit.prevent="Register()" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">


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
		      v-validate="'required|alpha_num|min:4'"
		      required
	      >
		<span 
			v-show="errors.has('name')" 
			class="text-red-500 font-semibold"
		>{{ errors.first('name') }}</span>
	    </div>




	    <div class="mb-4">
	      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
	        Email
	      </label>
	      <input 
		      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
		      id="email" 
		      type="email" 
		      placeholder="Enter Email"
		      name="email"
			  v-model="email"
			  v-validate="'required|email|min:6'"
			  required 
	      >

		  <span 
		      v-show="errors.has('email')" 
		      class="text-red-500 font-semibold"
	      >{{ errors.first('email') }}</span>
	    </div>



	   <!--  <div class="mb-4">
	      <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
	        Gender
	      </label>

	      <select 
		      class="w-full border rounded w-full py-2 px-3 text-gray-700  focus:outline-none focus:shadow-outline leading-tight shadow"
		      name="gender"
		      id="gender"
		      v-model="gender"
		      v-validate="'required'"
	      >
	      	<option disabled value="">Select a Gender</option>
	      	<option value="male">Male</option>
	      	<option value="female">Female</option>
	      	<option value="others">Others</option>
	      </select>
	      <span 
		      v-show="errors.has('gender')" 
		      class="text-red-500 font-semibold"
	      >{{ errors.first('gender') }}</span>
	    </div> -->


	    <div class="mb-4">
	      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
	        Password
	      </label>
	      <input 
		      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
		      id="password" 
		      type="password" 
		      placeholder="Enter Password"
		      name="password"
		      ref="password"
		      v-model="password"
		      v-validate="'required|alpha_num|min:6'"
	      >
	      <span 
		      v-show="errors.has('password')"
		      class="text-red-500 font-semibold"
	      >{{ errors.first('password') }}</span>
	    </div>


	    <div class="mb-6">
	      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
	        Confirm Password
	      </label>
	      <input 
		      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
		      id="password_confirm" 
		      type="password" 
		      placeholder="Confirm password"
		      name="password_confirmation"
		      v-model="password_confirmation"
		      v-validate="'required|alpha_num|min:6|confirmed:password'"
		      data-vv-as="password"
	      >
	      <span 
		      v-show="errors.has('password_confirmation')"
		      class="text-red-500 font-semibold"
	      >{{ errors.first('password_confirmation') }}</span>
	    </div>


	    <div class="flex items-center justify-content-around">
	      <button class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4" type="submit">
	        Sign Up
	      </button>

		
			<router-link
				:to="{name: 'login'}"
				class="inline-block align-baseline font-bold text-sm text-teal-600 hover:text-teal-500 "
			>
	        Already have an account. Log In?
			</router-link>
	    </div>

	  </form>


	</div>
	<div class="hidden md:block md:w-1/2 top-0">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum hic porro, fugit dignissimos aliquid pariatur. Asperiores vel laudantium pariatur, quia tenetur temporibus modi laborum rem perspiciatis animi voluptas illum placeat minus tempora totam cum, eveniet at corporis a itaque omnis dolores magnam expedita saepe. Sint eaque dicta, qui autem animi illo, beatae, vitae rerum explicabo iure iusto accusantium in quis harum. Dolor a porro libero totam necessitatibus unde enim qui nulla voluptatibus animi illo eligendi expedita nobis temporibus, dolores velit fugiat assumenda soluta! Saepe, voluptatem. Illo perferendis reiciendis sit placeat at, veritatis, corrupti consectetur rerum iure ipsum ex vel mollitia.
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
				// f: {
					name: null,
					email: null,
					// gender: null,
					password: null,
					password_confirmation: null,
					error: null,
				// }
			}
		},

		computed: 
		{
			Error(){
				return this.error !== null
			},

		},

		methods: 
		{
			...mapActions([
				'saveToken',
				'fetchUser',
				]),

			Hide(){
				document.querySelector('#hide').style.display = 'none'
				document.querySelector('#hide').style.transition = 'opacity 0'
				this.error = null
			},

			Register(){
				axios
					.post('/api/register', 
						{name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation})
					.then(response => {
						//log in the user
						let data = {
							'token': response.data.token,
							'user': response.config.data,
							'expires': null
						}
						// console.log(response)
						//save the token
						this.saveToken(data)
						this.fetchUser()
						//update user
						//redirect home
						this.$router.push({name: 'home'})
					})
					.catch(err => {
						this.error = err.response.data.message || err.response.data.error 
						// console.log(this.error)
					})

			}
		}
	}
</script>

<style>
	/*button:hover{
		filter: brightness(120%) saturate(120);
	}*/
</style>