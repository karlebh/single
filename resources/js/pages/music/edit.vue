<template>
	<div class=" py-5 px-10">
		<h1
		class="text-teal-500 text-center font-semibold py-5 leading-10"
		>Edit Artist Records Here</h1>

		<form @submit.prevent="updateArtist()" class="max-w-2xl lg:ml-20">
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
				  placeholder="Enter Name" 
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
				  placeholder="Enter Name" 
				  v-model="form.country"
				  required
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
				  placeholder="Enter Name" 
				  v-model="form.genre"
				  required
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
				  placeholder="Enter Name" 
				  v-model="form.latest_album"
				  required
			  >
			</div>
				
			<!-- Latest Hit -->
			<div class="mb-12">
			  <label class="block text-gray-700 text-sm font-bold mb-2" for="latest_hit">
				Latest Hit
			  </label>
			  <input 
				  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
				  id="latest_hit" 
				  name="latest_hit" 
				  type="text" 
				  placeholder="Enter Name" 
				  v-model="form.latest_hit"
				  v-validate="'required|max:30'"
				  required
			  >
			  <span class="text-red-500 font-semibold">{{ errors.first('latest_hit') }}</span>
			</div>
			
			<div>
				<button class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4" type="submit">
		        Update Artist's Record
			    </button>

		    	<a 
					class="cursor-pointer link bg-red-600 hover:bg-red-500 float-right" 
					@click="deleteMusic(slug)"
				>
					Delete
				</a>
			</div>
			
		</form>
	</div>
</template>

<script>
	import { Validator } from 'vee-validate'

	export default
	{
		data()
		{
			return{
				slug: this.$route.params.slug,

				form: {
					artist: null,
					country: null,
					genre: null,
					latest_album: null,
					latest_hit: null,
				},

			}
		},

		mounted(){
			this.getArtist()
		},

		methods: 
		{
			async getArtist(){
				try{
					const { data } = await axios.get('/api/music/' + this.slug + '/edit')
					this.form = data
				} catch(err) {
					console.log(err.response.data)
				}
			},

			async updateArtist(){
				try{
					const { data } = await axios.patch('/api/music/' + this.slug , this.form)
					this.$router.push({name: 'music.index'})
					console.log(data)
				} catch(err) {
					console.log(err.response.data)
				}
			},

			async deleteMusic(slug)
			{
				if(confirm('Are you sure you want to delete this artist\'s record')){
					try{
						await axios.delete('/api/music/' + slug )
						this.deleteMessage = "Model deleted successfully!"
						this.color = 'bg-red-500'
						this.$router.push({name: 'music.index'})
					} catch (err) {
						throw new Error(err)
						this.deleteMessage = "Could not delete Model"
						this.color = 'bg-green-500'
					}

					}
			}
			
		}
	}
</script>

<style>
	.link {
		@apply text-white font-bold py-2 px-4 rounded outline-none mx-5;
	}
</style>