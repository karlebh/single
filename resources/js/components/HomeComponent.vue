<template>
	<div class="p-3">
		<section class="text-teal-500">
			Hello and welcome to single!

			Single is a single page application built with Laravel and Vue.js!
		</section>
	</div>
</template>

<script>

	import { mapActions } from 'vuex'

	export default
	{
		mounted()
		{
			console.log()
		},

		methods: {
			...mapActions([
			'logout'
			]),

			async Logout() {
				axios
					.post('api/logout')
					.then(response => {
						this.logout()
						this.$router.push('login')
					})
					.catch(err => {
						console.log(err.message)
					})
			}
		}
	}
</script>