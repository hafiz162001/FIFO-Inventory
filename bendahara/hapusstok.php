<?php
include "../fungsi/koneksi.php";

if(isset($_GET['id'])){
	$id=$_GET['id'];

	$query = mysqli_query($koneksi,"delete from stokbarang where id_kode_brg='$id'");
	if ($query) {
		echo '<script language="javascript">alert("Data Berhasil Di Hapus !!!"); document.location="index?p=stokbarang";</script>';
	} else {
		echo 'gagal';
	}
	
}
?>