<section class="content">
  <div class="row">
    <div class="col-sm-12 col-xs-18">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="text-center">Detil Laporan Permintaan Barang</h3>
        </div>
        <form method="POST"  class="form-inline">
          <div class="box-body">

            <div class="form-group">
              <label>  Dari  Tanggal   </label>
              <input type="date" id="tanggala" class="form-control" name="tanggala" required>
            </div>&emsp;
            <div class="form-group">
              <label>  Sampai Tanggal   </label>
              <input type="date" id="tanggalb" class="form-control" name="tanggalb" required>
            </div>
            &emsp;
            

            <div class="form-group">&emsp;
              <input type='submit' name="tampilkan" value="View" class='btn btn-success'>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";

    if(isset($_POST["tampilkan"])){
      $tanggala = $_POST["tanggala"];
      $tanggalb = $_POST["tanggalb"];
      
      ?>

      <div class="col-sm- col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="form-group">
              <!-- Untuk Cetak -->

              <div class="col-md-12">
                <form method="POST" action='cetak_lap_detilpermintaan.php' target="_blank" class="form-inline">
                  <div class="form-group">
                    <label> Periode</label>
                    <input type="text"  value='<?= ($tanggala); ?>' id="tanggala" class="form-control" name="tanggala" required>
                  </div>
                  <div class="form-group">
                    <label> s/d </label>
                    <input type="text"  value='<?= ($tanggalb); ?>' id="tanggalb" class="form-control" name="tanggalb" required>
                  </div>&emsp;
                 
                  <div class="form-group">

                    <input type='submit' name="POST" value="Cetak" class='btn btn-success'>
                    

                  </div>
                </form>
              </div>
            </div>

            <!-- Untuk Cetak -->
          </div>
          <table class="table table-responsive">
            <tr>
              <th>No</th>
              <th>Tanggal Permintaan</th>
              <th>Unit</th>
              <th>Instansi</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Satuan</th>
              
            </tr>
            <tbody>   

              <?php
              $query = mysqli_query($koneksi, "SELECT * from permintaan left join stokbarang on permintaan.kode_brg=stokbarang.kode_brg where tgl_permintaan BETWEEN '$tanggala' and '$tanggalb' group by id_permintaan"); 

              //echo "ELECT * from permintaan left join stokbarang on permintaan.kode_brg=stokbarang.kode_brg where tgl_permintaan BETWEEN '$tanggala' and '$tanggalb' group by id_permintaan";
              $no = 1;    
              echo "
              ";
              if (mysqli_num_rows($query))      {
                while($data=mysqli_fetch_assoc($query)):

                  ?>

                  <tr>
                   <td><?php echo $no;?></td>
                   <td> <?php echo date('d/m/Y', strtotime($data['tgl_permintaan']));  ?></td>
                   <td><?php echo $data['unit'];?></td>
                   <td><?php echo $data['instansi'];?></td>
                   <td><?php echo $data['kode_brg'];?></td>
                   <td><?php echo $data['nama_brg'];?></td>
                   <td><?php echo $data['jumlah'];?></td>
                   <td><?php echo $data['satuan'];?></td>
                  
                 </tr>
                 
                 <?php $no++;  ?>

               <?php  endwhile; } else { 




                echo "<script>window.alert('DATA BARANG TIDAK ADA')
                window.location='index?p=detil_lap_permintaan'</script>
                ";}



              } ?>
            </tbody>  
          </table>    
        </div>
      </div>
    </div>
  </section>