<?php  

	include "../fungsi/koneksi.php";


	$query = mysqli_query($koneksi,"select * from stokbarang");
    
    if (mysqli_num_rows($query)) {
    	echo "<option>--Pilih Barang--</option>";
        while($row=mysqli_fetch_assoc($query)){

        	echo "<option value=$row[kode_brg]>$row[nama_brg]</option>\n";

    	}                                                    
    }
  
?>