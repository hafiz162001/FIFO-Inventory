<?php  
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";



//$query = mysqli_query($koneksi, "SELECT pemasukan.kode_brg, unit, nama_brg, jumlah, satuan, tgl_masuk FROM pemasukan INNER JOIN stokbarang ON pemasukan.kode_brg = stokbarang.kode_brg  "); 
$query = mysqli_query($koneksi, "SELECT * FROM stokbarang");

?>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="text-center">Data Barang Masuk</h3>
        </div>                 
        <div class="box-body">
         <div class="row">
          <div class="col-md-2">
                        <a href="index?p=tambahbarang" class=" btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> 
                    </div>
<!--            <div class="col-md-2 pull-right">
            <a target="_blank" href="cetaksemuapemasukan.php" class="btn btn-success"><i class="fa fa-print"></i> Cetak Barang Masuk</a><br>
           </div>   -->
            <br><br>
          </div> 
          <div class="table-responsive">
            <table class="table text-center" id="material">
             <thead  > 
              <tr>
               <th>No</th>    
               <th>Kode Barang</th>

               <th>Nama Barang</th>
               <th>Satuan</th>


             </tr>
           </thead>
           <tbody>
            <tr>
             <?php 
             $no =1 ;
             if (mysqli_num_rows($query)) {
               while($row=mysqli_fetch_assoc($query)):

                ?>
                <td> <?= $no; ?> </td>      

                <td> <?= $row['kode_brg']; ?> </td>

                <td> <?= $row['nama_brg']; ?> </td>                                        
                <td> <?= $row['satuan']; ?> </td>




              </tr>
              <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada Data.</td></tr>";} ?>
            </tbody>
          </table>
        </div>                  
      </div>
    </div>
  </div>
</div>
</section>