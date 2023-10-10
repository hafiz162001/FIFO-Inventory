<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['update'])) {
	$id_supplier = $_POST['id_supplier'];
	
	$nama_supplier = $_POST['nama_supplier'];
	$alamat = $_POST['alamat'];
	$telepone = $_POST['telepone'];

	
	$query = mysqli_query($koneksi, "UPDATE supplier SET nama_supplier='$nama_supplier', alamat='$alamat', telepone='$telepone' WHERE id_supplier ='$id_supplier' ");
	
	if ($query) {
		echo '<script language="javascript">alert("Data Berhasil Di Ubah !!!"); document.location="index?p=supplier";</script>';
	} else {
		echo 'error' . mysqli_error($koneksi);
	}

}



?>