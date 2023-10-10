<?php 

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

ob_start(); 
$id  = isset($_GET['id']) ? $_GET['id'] : false;


$tanggala=$_POST['tanggala'];
$tanggalb=$_POST['tanggalb'];

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

div.kanan {
 width:300px;
 float:right;
 margin-left:250px;
 margin-top:-141px;
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

    <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>Toko Wida</b></font>
      <br>JL.Rawa Kalieung<br>Telp : (021) 4751119</td>

  </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN REKAPITULASI PERMINTAAN BARANG</u></p>

  <div class="isi" style="margin: 0 auto;">
    Periode : <?= tanggal_indo($tanggala); ?> S/d <?= tanggal_indo($tanggalb);?>
    <br><br>
    <table class="tabel2">      
      <thead>
        <tr>
          <td style="text-align: center; "><b>No.</b></td>        
          <td style="text-align: center; "><b>Tanggal Keluar</b></td>
          <td style="text-align: center; "><b>Nama </b></td>
          <td style="text-align: center; "><b>Kode Barang</b></td>
          <td style="text-align: center; "><b>Nama Barang</b></td>
          <td style="text-align: center; "><b>Satuan</b></td>
          <td style="text-align: center; "><b>Jumlah</b></td>                                        
        </tr>
      </thead>
      <tbody>
        <?php

        $query = mysqli_query($koneksi, "SELECT pengeluaran.kode_brg, unit, nama_brg, jumlah, satuan, tgl_keluar FROM pengeluaran INNER JOIN stokbarang ON pengeluaran.kode_brg = stokbarang.kode_brg WHERE tgl_keluar BETWEEN '$tanggala' and '$tanggalb' "); 
        $i   = 1;
        $total = 0;
        while($data=mysqli_fetch_array($query))

        {
          ?>
          <tr>
            <td style="text-align: center; width=10px; "><?php echo $i; ?></td>         
            <td style="text-align: center; width=70px; font-size: 12px;"><?php echo date('d/m/Y', strtotime($data['tgl_keluar']));  ?></td>
            <td style="text-align: left; width=100px; font-size: 12px;"><?php echo $data['unit']; ?></td>             
            <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['kode_brg']; ?></td>
            <td style="text-align: left; width=150px; font-size: 12px;"><?php echo $data['nama_brg']; ?></td>
            <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['satuan']; ?></td>

            <td style="text-align: center; font-size: 12px;"><?php echo $data['jumlah']; ?></td>                            
          </tr>
          <?php
          $i++; 
          $total=$total+$data['jumlah'];
        }
        ?>
      </tbody>
    </table>
    <table class="tabel2">
      <tr>
        <td style="text-align: center; width=601px;"><b>Total Barang</b></td>        


        <td style="text-align: center; width=34px;"><b><?= $total = $total; ?></b></td>                                        
      </tr>
    </table>

  </div>

  <!-- <div class="kiri">
    <br>
    <p>Mengetahui <br>Kepala Toko</p>
    <br>
    <br>
    <br>
    <p><b><u>Agus Eko Suwarno</u><br></b></p>
  </div>

  <div class="kanan">
    <p><br> <br>Karyawan </p>
    <br>
    <br>
    <br>
    <p><b><u>Siti Huroiroh</u><br></b></p>
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