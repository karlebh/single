<template>
	<div>
		<p>
			If you are seeing this, it means you're logged in

			<button @click.prevent="Logout" class="py-1 px-2 text-white font-semibold bg-teal-600">
				Logout
			</button>
		</p>
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