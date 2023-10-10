<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['simpan'])) {

	$kode_brg = $_POST['kode_brg'];
	$nama_brg = $_POST['nama_brg'];
	$satuan = $_POST['satuan'];	
	$hargabarang = 0;

		//die($stok);

	$query = "INSERT into stokbarang (kode_brg, nama_brg, satuan, hargabarang) VALUES 
	('$kode_brg',  '$nama_brg', '$satuan', '$hargabarang');

	";
	$hasil = mysqli_query($koneksi, $query);
	if ($hasil) {
		echo '<script language="javascript">alert("Data Berhasil Disimpan !!!"); document.location="index?p=datapemasukan";</script>';
	} else {
		die("ada kesalahan : " . mysqli_error($koneksi));
	}

}