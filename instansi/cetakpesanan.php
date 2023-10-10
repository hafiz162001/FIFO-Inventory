<?php 

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

ob_start(); 
$id  = isset($_GET['id']) ? $_GET['id'] : false;


$unit = $_GET['unit'];
$instansi = $_GET['instansi'];
$tgl= $_GET['tgl'];

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
  margin-left: 80px;
}
.tabel2 th, .tabel2 td {
  padding: 5px 5px;
  border: 1px solid #000;
}
.tabelatas{

  margin-left: 80px;
}
p{

  margin-left: 80px;
}

div.kanan {
 width:300px;
 float:right;
 margin-left:150px;
 margin-top:-236px;
}

div.kiri {
 width:300px;
 float:left;
 margin-left:-10px;
 display:inline;
}
div.tengah {
 width:300px;
 float:left;
 margin-left:195px;
 margin-top:2;
 display:inline;
}
</style>
<table>
  <tr>
    <th rowspan="3"><img src="../gambar/download.png" style="width:100px;height:100px" /></th>
    <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>Toko Wida</b></font>
      <br>Jl. Semawung Daleman, Kutoarjo,, Purworejo<br>Telp : (0275) 641342</td>

  </tr>
</table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PERMINTAAN BARANG (BPP)</u></p>
  
  <div class="isi" style="margin: 0 auto;">

   <table class="tabelatas">
    <tr>
      <td style="text-align: left; width=100px;  "><b>Karyawan </b></td>  
      <td style="text-align: left; "><b>: <?= $instansi; ?></b></td>           
    </tr>
    <tr>
      <td style="text-align: left; width=100px;  "><b>Pada tanggal </b></td>   
      <td style="text-align: left; "><b>: <?=  tanggal_indo($tgl); ?></b></td>       
    </tr>

  </table>
  <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; width=10px; "><b>No.</b></td>        
        <td style="text-align: center; width=100px;"><b>Kode Barang</b></td>
        <td style="text-align: center; width=150px;"><b>Nama Barang</b></td>
        <td style="text-align: center; width=80px;"><b>Satuan</b></td> 
        <td style="text-align: center; width=80px;"><b>Jumlah</b></td>                                        
      </tr>
    </thead>
    <tbody>
      <?php


      $query = mysqli_query($koneksi, "SELECT permintaan.kode_brg, unit, nama_brg, jumlah, satuan, tgl_permintaan FROM permintaan INNER JOIN stokbarang ON permintaan.kode_brg = stokbarang.kode_brg  WHERE unit='$unit' AND  status=1 AND tgl_permintaan='$tgl' "); 
      $i   = 1;
      $total = 0;
      while($data=mysqli_fetch_array($query))
      {
        ?>
        <tr>
          <td style="text-align: center; font-size: 12px;"><?php echo $i; ?></td>             
          <td style="text-align: center; font-size: 12px;"><?php echo $data['kode_brg']; ?></td>
          <td style="text-align: left; font-size: 12px;"><?php echo $data['nama_brg']; ?></td>
          <td style="text-align: center; font-size: 12px;"><?php echo $data['satuan']; ?></td>  
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
      <td style="text-align: center; width=409px;"><b>Total Barang</b></td>        


      <td style="text-align: center; width=80px;"><b><?= $total = $total; ?></b></td>                                        
    </tr>
  </table>


</div>

<?php 

$query2 = mysqli_query($koneksi, "SELECT jabatan,username FROM user WHERE username='$unit' ");
if ($query2){                
  $data = mysqli_fetch_assoc($query2);

} else {
  echo 'gagal';
}
?>

<div class="kiri">
  <p> </p>
  <p>Diminta Oleh :<br>Karyawan  </p>
  <p></p>
  <p></p>
  <b><p><u><?= $data['username'] ?></u><br><?= $data['jabatan'] ?></p></b>
  <br>
  <br>
  <br>
</div>



<div class="kanan">
  <p></p>
  <p>Dikeluarkan Oleh :<br>Staf Wakil Kepala Sarpras </p>
  <p></p>
  <p> </p>
  <b><p><u>Puspa Pramu Shinta </u><br></p></b>
  <br>
  <br>
  <br>

</div>

<div class="tengah">
 <p></p>
 <p><br>Disetujui Oleh :<br>Wakil Kepala Sarpras </p>
 <p></p>
 <p> </p>
 <b><p><u>Andri Wijaya </u><br></p></b>
 <br>
 <br>
 <br>

</div>
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