<?php  

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

if(isset($_GET['id_jenis'])){
    $id_jenis = $_GET['id_jenis'];
    $query = mysqli_query($koneksi, "SELECT * FROM stokbarang WHERE id_jenis='$id_jenis' ");    
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM stokbarang");        
}


?>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="text-center">Data Stok Barang</h3>
            </div>                
            <div class="box-body">                                      
               <div class="table-responsive">
                  <table class="table text-center" id="material">
                     <thead  > 
                        <tr>
                           <th>No</th>	        
                           <th>Kode Barang</th>        				
                           <th>Nama Barang</th>
                           <th>Satuan</th>	
                           <th>Keluar</th>
                           <th>STOK</th>           				
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
                          <td style="text-align: left;";> <?= $row['nama_brg']; ?> </td>
                          <td> <?= $row['satuan']; ?> </td>
                          <td> <?= $row['keluar']; ?> </td>
                          <td> <?= $row['sisa']; ?> </td>  				
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