<template>
	<div class="m-5">
		
			<Loader :loading="loading"></Loader>
		
		<div 
			v-if="deleteMessage" 
			id="hide" 
			class="mb-6 bg-green-500 py-5 px-10 text-white font-semibold transition duration-100 ease"
			:class="{color}"
		>
			<p>{{ deleteMessage }} 
				<span 
					class="ml-24 w-20 h-20 cursor-pointer"
					@click="Hide()"
				>&times</span>
			</p>
		</div>


		
		<div v-for="music in musics.data" :key="music.id"  class="pagination">
			<div  class="py-20  px-5 mb-20 bg-gray-300 text-black shadow-md">
				<p class="mb-10">
				{{ music.artist }} sang {{ music.latest_hit }} in {{ music.latest_album }} album. 
				{{ music.slug }}
				</p>
				<p class="text-center">
					<router-link 
					:to="{name: 'music.edit', params: {slug: music.slug} }" 
					class="link bg-teal-600 hover:bg-teal-500"
					style="border-radius: 4px 17px"
					>
						Edit
					</router-link>
	
				</p>
			</div>
		</div>

		<div>
			<laravel-vue-tailwind-pagination
				:data="musics"
				:showNumbers="true"
			></laravel-vue-tailwind-pagination>
		</div>
	</div>
</template>

<script>

	// import { mapActions, mapState } from 'vuex'

	import Loader from '../../components/Loader.vue'

	export default
	{
		data(){
			return{
				musics: {},
				artist: null,
				deleteMessage: null,
				color: null,
				loading: true,
			}
		},

		computed:
		{
			// deleteMessage(){
			// 	return this.deleteSuccess !== null
			// }
			// ...mapState([
			// 	'music'
			// 	]),
		
		},

		mounted()
		{
			this.allMusics()
		},

		methods: 
		{
			// ...mapActions([
			// 	'allMusic'
			// 	]),

			allMusics(){
				// const { data } = awiat axios.get('/api/music')
				axios
					.get('/api/music')
					.then(response => {
						this.musics = response.data
						this.loading = false
					})
			},

			Hide(){
				document.querySelector('#hide').style.display = 'none'
				document.querySelector('#hide').style.transition = 'opacity 2s'
			},

			

		},

		components: {
			Loader,
		}
	}

</script>

<style>
	.link {
		@apply text-white font-bold py-2 px-4 rounded outline-none mx-5;
	}
</style>