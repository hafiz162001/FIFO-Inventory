<?php  

	if (isset($_SESSION['login'])) {
		if ($_SESSION['level'] == "instansi") {
			header("location:instansi/index");
		} else if ($_SESSION['level'] == "bendahara"){
			header("location:bendahara/index");
		} else if ($_SESSION['level'] == "kepala"){
			header("location:kepala/index");
		} else {
			header("location:index");
		}
	}

?>