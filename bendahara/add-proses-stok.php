<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['simpan'])) {

	$kode_brg = $_POST['kode_brg'];
	
	
	$hargabarang = preg_replace('/[Rp.]/', '', $_POST['hargabarang']);
	
	$stoknew = $_POST['stok'];
	$supplier = $_POST['supplier'];
	$keluar = 0;
	$sisa = 0;
	$keterangan = '';
	$tgl_input = date('Y-m-d');

		//die($stok);
$cektanggal=mysqli_query($koneksi,"select tgl_input from stokbarang where kode_brg='$kode_brg' and tgl_input='$tgl_input' and  supplier='$supplier'");
$cek=mysqli_num_rows($cektanggal);
if($cek>0){
//echo "tanggal sudah ada, update";
	
	$query = "UPDATE stokbarang SET stok=stok+'$stoknew', hargabarang='$hargabarang', tgl_input='$tgl_input', sisa=sisa+'$stoknew' WHERE kode_brg='$kode_brg' and tgl_input='$tgl_input' and  supplier='$supplier' ";
	
}
else{

	$cekbarang=mysqli_query($koneksi,"select * from stokbarang where kode_brg='$kode_brg'");
	$r=mysqli_fetch_array($cekbarang);

	$query = "insert into stokbarang (kode_brg, nama_brg, hargabarang, satuan, stok, supplier, tgl_input) values ('$kode_brg', '$r[nama_brg]','$hargabarang','$r[satuan]','$stoknew','$supplier','$tgl_input')";
}
	
	$hasil = mysqli_query($koneksi, $query);
	if ($hasil) {
		echo '<script language="javascript">alert("Data Berhasil Disimpan !!!"); document.location="index?p=stokbarang";</script>';
	} else {
		die("ada kesalahan : " . mysqli_error($koneksi));
	}

}