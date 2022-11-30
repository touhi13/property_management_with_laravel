/*var __is_jadewits_user_logged_in = false;
var __user_login_check = false;*/

function __jw_readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
	return null;
	}
	
if( __jw_readCookie('jadewits_cross_cookie') ){
	__user_login_check = true;
	document.write('<script type="text/javascript" src="'+ __jw_s_link +'"></script>');
	}
	
if( __jw_readCookie('jw_session') ){
	__user_login_check2 = true;
	}