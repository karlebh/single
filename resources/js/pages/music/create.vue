<template>
	<div class="py-5 px-10">

		<h1
		class="text-teal-500 text-center font-semibold py-5 leading-10"
		>Add Artist Records Here</h1>


		<form @submit.prevent="createArtist()" class="max-w-2xl lg:ml-20">
			<!-- Artist -->
			<div class="mb-4">
			  <label class="block text-gray-700 text-sm font-bold mb-2" for="artist">
				Artist
			  </label>
			  <input 
				  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
				  id="artist" 
				  name="artist"
				  type="text" 
				  placeholder="Enter Artist's Name" 
				  v-model="form.artist"
				  v-validate="'required|max:30'"
				  required
			  >
			  <span class="text-red-500 font-semibold">{{ errors.first('artist') }}</span>
			</div>

			<!-- Country -->
			<div class="mb-4">
			  <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
				Country (Optional)
			  </label>
			  <input 
				  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
				  id="country" 
				  name="country" 
				  type="text" 
				  placeholder="Enter Country" 
				  v-model="form.country"
			  >
			</div>

			<!-- Genre -->
			<div class="mb-4">
			  <label class="block text-gray-700 text-sm font-bold mb-2" for="genre">
				Genre (Optional)
			  </label>
			  <input 
				  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
				  id="genre" 
				  name="genre" 
				  type="text" 
				  placeholder="Enter Artist's Genre of Music" 
				  v-model="form.genre"
			  >
			</div>
			
			<!-- Latest Album -->
			<div class="mb-4">
			  <label class="block text-gray-700 text-sm font-bold mb-2" for="latest_album">
				Latest Album (Optional)
			  </label>
			  <input 
				  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
				  id="latest_album" 
				  name="latest_album" 
				  type="text" 
				  placeholder="Enter Latest Album" 
				  v-model="form.latest_album"
			  >
			</div>
				
			<!-- Latest Hit -->
			<div class="mb-6">
			  <label class="block text-gray-700 text-sm font-bold mb-2" for="latest_hit">
				Latest Hit
			  </label>
			  <input 
				  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
				  id="latest_hit" 
				  name="latest_hit" 
				  type="text" 
				  placeholder="Enter Latest Hit" 
				  v-model="form.latest_hit"
				  v-validate="'required|max:30'"
				  required
			  >
			  <span class="text-red-500 font-semibold">{{ errors.first('latest_hit') }}</span>
			</div>
			
			<div>
				<button class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4" type="submit">
		        Create Artist
			    </button>
			</div>
			
		</form>
	</div>
</template>

<script>

	export default
	{
		data()
		{
			return{
				form: {
					artist: null,
					country: null,
					genre: null,
					latest_album: null,
					latest_hit: null,
				},
				successMessage: null,
			}
		},

		computed: 
		{
			Success(){
				return this.successMessage !== null
			}
		},

		methods: 
		{
			Hide(){
				document.querySelector('#hide').style.display = 'none'
				document.querySelector('#hide').style.transition = 'opacity 0'
				this.error = null
			},

			createArtist(){
				axios
					.post('/api/music', this.form)
					.then(response => {
						this.$router.push({name: 'music.index'})
						this.successMessage = response.data
					})
					.catch(err => {
						this.successMessage = err.response.data.message
					})
			}
		}
	}
</script>