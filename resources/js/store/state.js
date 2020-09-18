import Cookies from 'js-cookie'

export default
{
	user: Cookies.get('user'),
	token: Cookies.get('token'),
	authError: Boolean,
	musics: Array|Object,
}