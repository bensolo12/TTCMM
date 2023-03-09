<?php

if(isset($_POST['phpFunction'])) {
		if($_POST['phpFunction'] == 'checkLogin') {
			checkLogin();
		} elseif($_POST['phpFunction'] == 'logout') {
			logout();
		}
}

function logout () {
	session_start();

	//Destroys all sessions
	if( session_destroy() )
	{
		echo 'true';
	} else {
		echo 'false';
	}
}
//checks if the user is logged in
function checkLogin() {
	session_start();
	$un = $_SESSION['user_id'];
	$role = $_SESSION['user_role'];
	if( isset( $un ) ) {
		echo $role;
	} else {
		echo 'false';
	}
}
?>
