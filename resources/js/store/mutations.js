import Cookies from 'js-cookie'

export default
{
	 saveToken(state, { token, expiration, user }) {
	 	// if ( !state.authError ) {
			state.token = token
			state.regError = 
			Cookies.set('token', token, {expires: expiration ? 365 : null})
			Cookies.set('user', user)
	 	// } 
	},

	 fetchUserSuccess(state, {user}) {
	 	// state.authError = false
		state.user = user
	},

	 fetchUserFailure(state) {
	 	// state.authError = true
		state.token = null
		Cookies.remove('token')
		Cookies.remove('user')
	},

	 logout(state) {
		state.user = null
		state.token = null
		Cookies.remove('token')
		Cookies.remove('user')
	},

	 updateUser(state, {user}) {
		state.user = user
	},

	/* Music methods */

	allMusics(state, payload) {
		state.musics = payload
	}
}