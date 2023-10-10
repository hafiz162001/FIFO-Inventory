<?php  
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

if (isset($_GET['aksi']) && isset($_GET['tgl'])) {
        //die($id = $_GET['id']);
  $tgl = $_GET['tgl'];
  echo $tgl;

  if ($_GET['aksi'] == 'detil') {
    header("location:?p=detil&tgl=$tgl");
  } 
}

$query = mysqli_query($koneksi, "SELECT unit, tgl_pengajuan, count(kode_brg)  FROM pengajuan WHERE unit= '$_SESSION[username]'  GROUP BY tgl_pengajuan  ");    

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
        <a href="index?p=formpengajuan" style="margin:10px 15px;" class="btn btn-success"><i class='fa fa-plus'> Form Input Barang Masuk</i></a>
        <div class="table-responsive">
          <table class="table text-center">
            <thead  > 
              <tr>
                <th>No</th>                                                                                             
                <th>Tanggal Pengajuan</th>
                <th>User</th>
                
                <th>Aksi</th>
                <th>Cetak</th>
                
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
                   <td> <?= tanggal_indo($row['tgl_pengajuan']); ?> </td> 
                   <td> <?= $row['unit']; ?> </td>
                   
                   <td>                                                                                                                                                                                    <a href="?p=detilpengajuan&unit=<?= $row['unit'];?>&tgl=<?= $row['tgl_pengajuan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Input Barang Masuk'><button    class="btn btn-info">Input Barang Masuk</button></span></a>   

                   </td>
                   <td><a target="_blank" href="cetakpengajuan?&tgl=<?= $row['tgl_pengajuan']; ?>&unit=<?= $row['unit']; ?>"><span data-placement='top' data-toggle='tooltip' title='Cetak'><button class="btn btn-success"><i class="fa fa-print"> Cetak Data Barang Masuk</i></button></span></a>  

                   </tr>    

                   <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada permintaan material teknik.</td></tr>";} ?>

                 </tbody>
               </table>
             </div>                  
           </div>
         </div>
       </div>
     </div>


   </section>

