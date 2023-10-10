<?php ob_start();
include "../fungsi/fungsi.php";

?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #3C8DBC; color: #fff; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #3C8DBC; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
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
   margin-top:-140px;
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
      <br>JL. Rawa Kalieung<br>Telp : (0275) 4751119</td>

  </tr>
</table>
<hr>
<p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN PENGELUARAN BARANG</u></p>
<table class="tabel2">
  <thead>
    <tr>
      <td style="text-align: center; "><b>No.</b></td>
      <td style="text-align: center; "><b>Tanggal Keluar</b></td>
      <td style="text-align: center; "><b>Unit </b></td>
      <td style="text-align: center; "><b>Instansi</b></td>
      <td style="text-align: center; "><b>Kode Barang</b></td>
      <td style="text-align: center; "><b>Nama Barang</b></td>
     
      <td style="text-align: center; "><b>Jumlah</b></td>
      <td style="text-align: center; "><b>Satuan</b></td>
    </tr>
  </thead>
  <tbody>
    <?php

    include "../fungsi/koneksi.php";
    $query = mysqli_query($koneksi, "SELECT * from permintaan left join stokbarang on permintaan.kode_brg=stokbarang.kode_brg group by id_permintaan"); 
    $i   = 1;
    $total = 0;
    while($data=mysqli_fetch_array($query))
    {
      ?>
      <tr>
        <td style="text-align: center; width=15px; font-size: 12px;"><?php echo $i; ?></td>
        <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['tgl_permintaan']; ?></td>
        <td style="text-align: left; width=80px; font-size: 12px;"><?php echo $data['unit']; ?></td>        
        <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['instansi']; ?></td>
        <td style="text-align: left; width=120px; font-size: 12px;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['nama_brg']; ?></td> 
        <td style="text-align: center; width=50px; font-size: 12px;"><?php echo $data['jumlah']; ?></td>   
        <td style="text-align: center; width=50px; font-size: 12px;"><?php echo $data['satuan']; ?></td>                  
      </tr>
      <?php
      $i++;
      $total=$total+$data['jumlah'];
    }
    ?>
  </tbody>
</table>

<div class="kiri">
  <p></p>
  <br>
  <br>
  <br>
  <p></p>
</div>

<div class="kanan">
  <br><br><br><br><br><br>
  <p> Jumlah Barang : <?= $total = $total; ?></p>
  <p> </p>
  <br>
  <br>
  <br>
  <p></p>
</div>
<!-- <div class="kiri">
  <br>
  <p>Diketahui :<br>Kepala Toko</p>
  <br>
  <br>
  <br>
  <p><b><u>Toko Wida</u><br></b></p>
</div>

<div class="kanan">
  <br>
  <br>
  <p>Bendahara </p>
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
  $html2pdf->Output('laporan_pengeluaran_barang.pdf');
}
catch(HTML2PDF_exception $e) {
  echo $e;
  exit;
}

?>