
<?php  
include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

if (isset($_GET['aksi']) && isset($_GET['tgl'])) {
        //die($id = $_GET['id']);
    $tgl = $_GET['tgl'];
    echo $tgl;


}

$query = mysqli_query($koneksi, "SELECT distinct(unit),  tgl_pengajuan FROM pengajuan WHERE  status=1"); 

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
                <a href="cetakbarang.php" target="_blank" style="margin:10px;" class="btn btn-success"><i class='fa fa-print'> Cetak Laporan</i></a>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" id="datapesanan">
                        <thead  > 
                            <tr>
                                <th>No</th> 
                                <th>Tanggal Pengajuan</th>
                                <th>Nama</th>

                                <th>Detail</th>   
                                <th>Catak</th>                               
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


                                     <td>
                                        <a href="?p=detilpengajuan&unit=<?= $row['unit'];?>&tgl=<?= $row['tgl_pengajuan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Pengajuan'><button    class="btn btn-info">Detail Barang</button></span></a>     

                                    </td>  
                                    <td>
                                        <a  target="_blank" href="cetakpemasukan.php?&tgl=<?= $row['tgl_pengajuan']; ?>&unit=<?= $row['unit']; ?>"><span data-placement='top' data-toggle='tooltip' title='Cetak'><button    class="btn btn-success">Cetak</button></span></a>     

                                    </td>  

                                </tr>
                                <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Belum ada permintaan disetujui</td></tr>" . mysqli_error($koneksi);} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>



</section>