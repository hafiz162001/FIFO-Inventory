<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['update'])) {
	
	$kode_brg = $_POST['kode_brg'];
	$nama_brg = $_POST['nama_brg'];
	$hargabarang = $_POST['hargabarang'];
	$satuan = $_POST['satuan'];
	$stok = $_POST['jumlah'];
	$keterangan = $_POST['keterangan'];
	$id=$_POST['id'];
	
	

	$query = mysqli_query($koneksi, "UPDATE stokbarang SET nama_brg='$nama_brg', satuan='$satuan', hargabarang='$hargabarang', stok='$stok', keterangan='$keterangan' WHERE id_kode_brg ='$id' ");
	if ($query) {
		echo '<script language="javascript">alert("Data Berhasil Di Ubah !!!"); document.location="index?p=stokbarang";</script>';
	} else {
		echo 'error' . mysqli_error($koneksi);
	}

}



?>