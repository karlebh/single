<template>
	<div v-if="loading">
		<div class="loader"></div>
	</div>
</template>

<script>
	export default
	{
		props: {
			loading: false,
		},
	}
</script>

<style>
	.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid teal; /* Blue */
    border-radius: 50%;
    width: 200px;
    height: 200px;
    animation: spin 2s linear infinite;
    margin: auto;
    max-width: 50%;

}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
@-webkit-keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>