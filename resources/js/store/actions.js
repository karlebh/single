export default
{
	saveToken({ commit }, payload)
	{
		commit("saveToken", payload)
	},

	async fetchUser({commit})
	{
		try
		{
			const data = await axios.get('api/me')

			commit("fetchUserSuccess", {user: data})
		}
		catch (e)
		{
			commit("fetchUserFailure")
		}
	},

	updateUser({commit}, payload)
	{
		commit("updateUser", payload)
	},

	async logout({commit})
	{
		// try
		// {
		// 	await axios
		// 		.post('api/logout')
		// 		.then(response => {
		// 			this.$route.push({name: 'login'})
		// 		})
		// }
		// catch (e)
		// {}

		commit("logout")
	},
	
	/* Music */

	async allMusics({ commit }, payload){
		commit('allMusics', payload)
	}
}