<?php  

include "../fungsi/koneksi.php";
$tgl = date('Y-m-d');



$query =  "INSERT INTO pengajuan SELECT * FROM pengajuan_sementara";
$query2 = "DELETE FROM pengajuan_sementara WHERE tgl_pengajuan='$tgl'";



if(mysqli_query($koneksi, $query)){
	mysqli_query($koneksi, $query2);
	echo '<script language="javascript">alert("From Pengajuan Berhasil Di Buat  !!!"); document.location="index?p=datapengajuan";</script>';
} else {
	echo "gagal euy" . mysqli_error($koneksi);
}


?>