
<template>
	<div>
		<header-component></header-component>
		
		<main-component></main-component>

		<footer-component />
	</div>
</template>

<script>
	import FooterComponent from './layouts/FooterComponent'
	import HeaderComponent from './layouts/HeaderComponent'
	import MainComponent from './layouts/MainComponent'

	export default
	{
		name: 'App',
		components: {
			FooterComponent,
			HeaderComponent,
			MainComponent,
		}


	}
</script>