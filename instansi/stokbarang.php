<?php  
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";


if (isset($_GET['aksi']) && isset($_GET['id'])) {
        //die($id = $_GET['id']);
  $id = $_GET['id'];
  echo $id;

  if ($_GET['aksi'] == 'edit') {
    header("location:?p=editstok&id=$id");
  } else if ($_GET['aksi'] == 'hapus') {
    header("location:?p=hapusstok&id=$id");
  } 
}


  $query = mysqli_query($koneksi, "SELECT * FROM stokbarang  group by kode_brg");        




?>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="text-center">Olah Data Stok Barang  ATK</h3>
        </div>                
        <div class="box-body">
          <div class="row">
           
            <br><br>
          </div>                        
          <div class="table-responsive">
            <table class="table text-center" id="material">
             <thead  > 
              <tr>
               <th>No</th>	  
               <th>Kode Barang</th>        				
               <th>Nama Barang</th>
               <th>Harga Barang</th>
               <th>Satuan</th>
               <th>Stok</th> 
               <th>Keluar</th>
               <th>Sisa</th>
               <th>Keterangan</th>
               <th>Tanggal Masuk</th>

                           				
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
                <td style="text-align: left;"> <?= $row['nama_brg']; ?> </td>
                <td> <?= number_format($row['hargabarang']); ?> </td>
                <td> <?= $row['satuan']; ?> </td>

                <td> <?= $row['stok']; ?> </td>
                <td> <?= $row['keluar']; ?> </td>
                <td> <?= $row['sisa']; ?> </td>                                         
                <td> <?= $row['keterangan']; ?> </td>
                <td><?= $row['tgl_input']; ?> </td>


                       					
              </tr>
              <?php $no++; endwhile; } ?>
            </tbody>
          </table>
        </div>                	
      </div>
    </div>
  </div>
</div>
</section>
<script>
  $(function(){
    $("#material").DataTable({
     "language": {
      "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
      "sEmptyTable": "Tidak ada data di database"
    }
  });
  });
</script> 