<?php 

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

ob_start(); 
$id  = isset($_GET['id']) ? $_GET['id'] : false;

$tanggala=$_POST['tanggala'];
$tanggalb=$_POST['tanggalb'];
$unit=$_POST['unit'];

?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  
  
</style>
<!-- Setting Margin header/ kop -->
<!-- Setting CSS Tabel data yang akan ditampilkan -->
<style type="text/css">
 .tabel2 {
  border-collapse: collapse;
  margin-left: 20px;    
}
.tabel2 th, .tabel2 td {
  padding: 5px 5px;
  border: 1px solid #000000;
}
.tabelatas{

  margin-left: 20px;
}


div.kanan {
 width:300px;
 float:right;
 margin-left:210px;
 margin-top:-235px;
}

div.kiri {
  width:300px;
  float:left;
  margin-left:20px;
  display:inline;
}

</style>
<table>
  <tr>
  >
    <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>PENGADILAN NEGERI PURWOREJO</b></font>
      <br>JL. Tentara Pelajar KM. 04 Banyuurip, Purworejo<br>Telp : (021) 4751119</td>

  </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN BARANG MASUK</u></p>

  <div class="isi" style="margin: 0 auto;">

    <?php 

    $query2 = mysqli_query($koneksi, "SELECT jabatan FROM user WHERE username='$unit' ");
    if ($query2){                
      $data = mysqli_fetch_assoc($query2);

    } else {
      echo 'gagal';
    }
    ?>
    <table class="tabelatas">

      <tr>
        <td style="text-align: left; width=80px;  "><b>Periode </b></td>   
        <td style="text-align: left; "><b>: <?= tanggal_indo($tanggala); ?> S/d  <?= tanggal_indo($tanggalb);?></b></td>       
      </tr>
      <tr>
        <td style="text-align: left; width=80px;  "><b>Nama </b></td>   
        <td style="text-align: left; "><b>: <?= ($unit);?></b></td>       
      </tr>
      <tr>
        <td style="text-align: left; width=80px;  "><b>Jabatan </b></td>   
        <td style="text-align: left; "><b>: <?= $data['jabatan'] ?></b></td>       
      </tr>

    </table>
    
    <br>
    <table class="tabel2">      
      <thead>
        <tr>
         <td style="text-align: center; width=10px;"><b>No.</b></td>        
         <td style="text-align: center; width=90px;"><b>Kode Barang</b></td>
         <td style="text-align: center; width=150px;"><b>Nama Barang</b></td>
         <td style="text-align: center; width=50px;"><b>Satuan</b></td>
         <td style="text-align: center; width=50px;"><b>Jumlah</b></td> 
         <td style="text-align: center; width=90px;"><b>Harga Barang</b></td>
         <td style="text-align: center; width=70px;"><b>Total</b></td>                            
       </tr>
     </thead>
     <tbody>
      <?php

      $query = mysqli_query($koneksi, "SELECT  pengajuan.kode_brg, nama_brg, pengajuan.jumlah,pengajuan.satuan, pengajuan.hargabarang, pengajuan.total, tgl_pengajuan FROM pengajuan INNER JOIN stokbarang ON pengajuan.kode_brg = stokbarang.kode_brg  WHERE unit='$unit' AND tgl_pengajuan BETWEEN '$tanggala' and '$tanggalb' "); 
      $i   = 1;

      while($data=mysqli_fetch_array($query))

      {
        ?>
        <tr>
          <td style="text-align: center; font-size: 12px;"><?php echo $i; ?></td>             
          <td style="text-align: center; font-size: 12px;"><?php echo $data['kode_brg']; ?></td>
          <td style="text-align: left; font-size: 12px;"><?php echo $data['nama_brg']; ?></td>
          <td style="text-align: center; font-size: 12px;"><?php echo $data['satuan']; ?></td>
          <td style="text-align: center; font-size: 12px;"><?php echo $data['jumlah']; ?></td>
          <td style="text-align: center; font-size: 12px;"><?php echo number_format($data['hargabarang']); ?></td>
          <td style="text-align: center; font-size: 12px;"><?php echo number_format($data['total']); ?></td>

        </tr>
        <?php
        $i++; 

      }
      ?>
    </tbody>
  </table>

  <?php 

  $query2 = mysqli_query($koneksi, "SELECT SUM(jumlah), SUM(hargabarang), SUM(total) FROM pengajuan WHERE unit='$unit' AND unit='$unit' AND tgl_pengajuan BETWEEN '$tanggala' and '$tanggalb' ");  
  $data2 = mysqli_fetch_assoc($query2);

  ?>
  <table class="tabel2">
    <tr>
      <td style="text-align: center; width=369px;"><b>Sub Total</b></td>  
      <td style="text-align: center; width=50px;"><b><?= $data2['SUM(jumlah)']; ?> </b></td>        
      <td style="text-align: center; width=90px;"><b>Rp.<?= number_format($data2['SUM(hargabarang)']); ?>.- </b></td>    
      <td style="text-align: center; width=70px;"><b>Rp.<?= number_format($data2['SUM(total)']); ?>.-</b></td>                                        
    </tr>
  </table>
</div>


<!-- <div class="kiri">
  <p></p>
  <p>Mengetahui<br>Kepala Toko</p>
  <p></p>
  <p> </p>
  <p><b><u>Agus Eko Suwarno</u><br></b></p>
  <br>
  <br>
  <br>
</div> -->




<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
include '../assets/html2pdf/html2pdf.class.php';
try
{
  $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
  $html2pdf->pdf->SetDisplayMode('fullpage');
  $html2pdf->writeHTML($content);
  $html2pdf->Output('bukti_permintaan_dan_pengeluaran_barang.pdf');
}
catch(HTML2PDF_exception $e) {
  echo $e;
  exit;
}
?>