<?php  

	include "../fungsi/koneksi.php";
	
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = mysqli_query($koneksi, "DELETE FROM pengajuan_sementara WHERE id_pengajuan_sementara='$id' ");

		if($query) {
			header("Location:index?p=formpengajuan");
		}
	}


?>