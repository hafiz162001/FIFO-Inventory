<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['simpan'])) {

	$kode_brg = $_POST['kode_brg'];
	$id_jenis = $_POST['id_jenis'];
	$nama_brg = $_POST['nama_brg'];
	$hargabarang = preg_replace('/[Rp.]/', '', $_POST['hargabarang']);
	$satuan = $_POST['satuan'];	
	$stok = $_POST['stok'];
	$supplier = $_POST['supplier'];
	$keluar = 0;
	$sisa = 0;
	$keterangan = '';
	$tgl_input = date('Y-m-d');

		//die($stok);

	$query = "INSERT into stokbarang (kode_brg, id_jenis, nama_brg, hargabarang, satuan, stok, supplier, keluar, sisa, keterangan, tgl_input) VALUES 
	('$kode_brg', '$id_jenis', '$nama_brg','$hargabarang', '$satuan', '$stok', '$supplier', '$keluar', '$sisa', '$keterangan','$tgl_input');

	";
	$hasil = mysqli_query($koneksi, $query);
	if ($hasil) {
		echo '<script language="javascript">alert("Data Berhasil Disimpan !!!"); document.location="index?p=tambahmaterial-m1";</script>';
	} else {
		die("ada kesalahan : " . mysqli_error($koneksi));
	}

}