<?php
	if (isset($_COOKIE['access_token'])) {
		unset($_COOKIE['access_token']);
	    setcookie('access_token', null, -1, '/');
		return true;
	}
	else {
		return false;
	}
?>