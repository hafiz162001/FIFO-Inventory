<?php ob_start(); ?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
</style>
<!-- Setting Margin header/ kop -->
<!-- Setting CSS Tabel data yang akan ditampilkan -->
<style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 5px;
  }
  .tabel2 th, .tabel2 td {
    padding: 5px 5px;
    border: 1px solid #000;
  }

  div.kanan {
   width:300px;
   float:right;
   margin-left:210px;
   margin-top:-140px;
 }

 div.kiri {
   width:300px;
   float:left;
   margin-left:30px;
   display:inline;
 }

</style>
<table>
  <?php 
  include "../fungsi/koneksi.php";
  /*
  $id = isset($_GET['idjenis']) ? $_GET['idjenis'] : "";
  switch($id) {
    case 1 :
    $material = "ATK";
    break;
    default:
    $material = "";
  }*/

  ?>
  <tr>
    <th rowspan="3"></th>
    <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>Toko Wida</b></font>
      <br>JL. Tentara Pelajar KM. 04, Purworejo<br>Telp : (0275) 4751119</td>

  </tr>
  </table>
  <hr>
  
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN DATA STOK BARANG</u></p>

   <div class="kiri">
     <h5>Dicetak pada  : <?php echo date('d-m-Y');?></h5> 
   </div>
  
  <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>
        <td style="text-align: center; "><b>Tanggal Input</b></td>
        <td style="text-align: center; "><b>Supplier</b></td>
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
        <td style="text-align: center; "><b>Harga Barang</b></td>
        <td style="text-align: center; "><b>Satuan</b></td>
        <td style="text-align: center; "><b>Masuk</b></td>
        <td style="text-align: center; "><b>Keluar</b></td>
        <td style="text-align: center; "><b>Sisa</b></td>
        <td style="text-align: center; "><b>Keterangan</b></td>

      </tr>
    </thead>
    <tbody>
      <?php

      $sql = mysqli_query($koneksi, "SELECT * FROM stokbarang order by tgl_input ASC");  
      $i   = 1;
      while($data=mysqli_fetch_array($sql))
      {
        ?>
        <tr>
          <td style="text-align: center; width=15px; font-size: 12px;"><?php echo $i; ?></td>
          <td style="text-align: center; width=15px; font-size: 12px;"><?php echo $data['tgl_input']; ?></td>
          <td style="text-align: center; width=50px; font-size: 12px;"><?php echo $data['supplier']; ?></td>
          <td style="text-align: center; width=50px; font-size: 12px;"><?php echo $data['kode_brg']; ?></td>
          <td style="text-align: left; width=150px; font-size: 12px;"><?php echo $data['nama_brg']; ?></td>
          <td style="text-align: center; width=70px; font-size: 12px;"><?php echo number_format($data['hargabarang']); ?></td> 
          <td style="text-align: center; width=50px; font-size: 12px;"><?php echo $data['satuan']; ?></td> 
          <td style="text-align: center; width=30px; font-size: 12px;"><?php echo $data['stok']; ?></td>
          <td style="text-align: center; width=30px; font-size: 12px;"><?php echo $data['keluar']; ?></td>
          <td style="text-align: center; width=30px; font-size: 12px;"><?php echo $data['sisa']; ?></td>
          <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['keterangan']; ?></td>

        </tr>
        <?php
        $i++;
      }
      ?>
    </tbody>
  </table>
  
  <!-- <div class="kiri">
    <p>Mengetahui :<br>Kepala Sekolah</p>
    <br>
    <br>
    <br>
    <p><b><u>Agus Eko Suwarno</u><br></b></p>
  </div>

  <div class="kanan">
    <p><br><br>Bendahara Pengelola Barang </p>
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
    $html2pdf = new HTML2PDF('L', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('laporan_stok_smk.pdf');
  }
  catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
  }
  ?>