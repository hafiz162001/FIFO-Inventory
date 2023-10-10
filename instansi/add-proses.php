<?php
//proses
include "../fungsi/koneksi.php";
if(isset($_POST['simpan'])) {

	$unit = $_POST['unit'];
	$instansi = $_POST['instansi'];
	$kode_brg = $_POST['kode_brg'];
	$jumlah = $_POST['jumlah'];		
	$tgl_pemesanan = date('Y-m-d');

//script validasi data

	// $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM sementara WHERE kode_brg='$kode_brg'"));
	// if ($cek > 0){
	// 	echo "<script>window.alert('Nama Barang Sudah Ada')
	// 	window.location='index?p=formpesan'</script>";
	// }else {
	// 	$query = "INSERT into sementara (unit, instansi, kode_brg, id_jenis,  jumlah, tgl_permintaan ) VALUES 
	// 	('$unit','$instansi', '$kode_brg', '$id_jenis', '$jumlah', '$tgl_pemesanan')

	// 	";
	// 	$hasil = mysqli_query($koneksi, $query);
	// 	if ($hasil) {
	// 		header("location:index?p=formpesan");
	// 	} else {
	// 		die("ada kesalahan : " . mysqli_error($koneksi));
	// 	}
	// }

/*
		//mengambil data stok
		$getalldata=mysqli_query($koneksi,"select * from stokbarang where kode_brg=$_POST[kode_brg] and stok>0");
		$dataku=mysqli_fetch_array($getalldata);
		//mengurangi stok dengan jumlah yang diambil
		$sisabarang=$dataku['stok']-$_POST['jumlah'];
		$keluarbarang = $dataku['keluar']+$_POST['jumlah'];
		//update data stok terbaru
		//ambil data paling lama
		$caridata=mysqli_query($koneksi, "select * from stokbarang where kode_brg=$kode_brg and stok>0 order by id_kode_brg limit 0,1");
		$ketemu=mysqli_fetch_array($caridata);

		mysqli_query($koneksi,"update stokbarang set keluar=$_POST[jumlah], stok = $sisabarang, sisa=$sisabarang, keluar=$keluarbarang where kode_brg=$kode_brg and id_kode_brg=$ketemu[id_kode_brg]");


		//echo "update stokbarang set stok = stok+$ketemu1[stok] where kode_brg=$kode_brg and id_kode_brg=$ketemu[id_kode_brg]";
		//echo "update stokbarang set keluar=$_POST[jumlah], stok = $sisabarang, sisa=$sisabarang, keluar=$keluarbarang where kode_brg=$kode_brg and id_kode_brg=$ketemu[id_kode_brg]";

		//echo "update stokbarang set keluar=$_POST[jumlah], stok = $sisabarang, sisa=$sisabarang, keluar=$keluarbarang where kode_brg=$kode_brg order by id_kodebrg ASC limit 0,1";
		//query menambah pengajuan
		mysqli_query($koneksi, "INSERT INTO pengeluaran (unit, kode_brg, jumlah, tgl_keluar)
		VALUES ('$unit', '$kode_brg', '$jumlah', '$tgl_pemesanan' ) ");


	$query = "INSERT into permintaan (unit, instansi, kode_brg,  jumlah, tgl_permintaan ) VALUES 
		('$unit','$instansi', '$kode_brg', '$jumlah', '$tgl_pemesanan')";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			echo '<script language="javascript">alert("From Permintaan Barang Berhasil Di Kirim !!!"); document.location="index?p=datapesanan";</script>';
			// $getalldata=mysqli_query($koneksi,"select * from stokbarang where kode_brg=$_POST[kode_brg]");
			// $dataku=mysqli_fetch_array($getalldata);
			// echo "stokbarang adalah $dataku[stok]";
			// $namabarang=$dataku['nama_brg'];
			// $sisabarang=$dataku['stok']-$_POST['jumlah'];
			// echo "sisa barang sekarang = $sisabarang";
			// $sql=mysqli_query($koneksi,"update stokbarang set keluar=$_POST[jumlah], sisa=$sisabarang where nama_brg=$namabarang");
			
			
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}

} 
*/
//metode FIFO, barang masuk duluan, habis duluan

$barang = $_POST['kode_brg'];
  $qty    = $_POST['jumlah'];

  // Jumlahkan keseluruhan Stok barang yg terpilih
  $sql      = "SELECT SUM(stok) AS total FROM stokbarang WHERE kode_brg = '$barang'";
  $result   = mysqli_query($koneksi, $sql);
  $data     = mysqli_fetch_assoc($result);
  
  $stok_all = $data['total'];

  
  $sql    = "SELECT * FROM stokbarang WHERE kode_brg = '$barang' AND stok > 0 ORDER by id_kode_brg ASC";
  $result = mysqli_query($koneksi, $sql);

  if($qty <= $stok_all) {

    

      while($row = mysqli_fetch_assoc($result)) {
      
          $id_kode_brg  = $row['id_kode_brg'];
          $stok = $row['stok'];

        

          if($qty > 0) { 
              
              // buat var $temp sbg. pengurang
              $temp = $qty;

              //proses pengurangan
              $qty = $qty - $stok;

              // jika hasil pengurangan > 0 berarti stok pd list pertama kurang  .. jadi update stok jd 0.. 
              // contoh : qty = 50 , stok = 30 .....maka 50 - 30 = 20.. (20 > 0 =>true)
              // dan juga sebaliknya jika stok berikutnya cukup yawess.. $stok - $temp;
              
              if($qty > 0) {      
                  $stok_update = 0;
              }else{
                  $stok_update = $stok - $temp;
              }
              
              $sql = "UPDATE stokbarang SET stok = $stok_update WHERE kode_brg = '$barang' AND id_kode_brg = '$id_kode_brg'";
              echo "<br>$sql<br><br>";
              mysqli_query($koneksi, $sql);

			  
			}
		}
	
	mysqli_query($koneksi, "INSERT INTO pengeluaran (unit, kode_brg, jumlah, tgl_keluar)
			  VALUES ('$unit', '$kode_brg', '$jumlah', '$tgl_pemesanan' ) ");
	  
	  
		  $query = "INSERT into permintaan (unit, instansi, kode_brg,  jumlah, tgl_permintaan ) VALUES 
			  ('$unit','$instansi', '$kode_brg', '$jumlah', '$tgl_pemesanan')";
			  $hasil = mysqli_query($koneksi, $query);

			  $sql=mysqli_query($koneksi,"update stokbarang set keluar=keluar+$jumlah where kode_brg=$kode_brg");

if($hasil){
	echo '<script language="javascript">alert("From Permintaan Barang Berhasil Di Kirim !!!"); document.location="index?p=datapesanan";</script>';
}
else{
	echo "Maaf ada error";
}

			  
          
      }
  }else{

      echo "Stok Barang Tidak Cukup, Stok = $stok_all <br><br>";
  }   


?>