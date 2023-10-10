<?php 

include "../fungsi/koneksi.php";
include "../fungsi/fungsi.php";

ob_start(); 

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
.tabelatas{

  margin-left: 20px;
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
      <br>JL. Tentara Pelajar KM. 04, Purworejo<br>Telp : (0275) 4751119</td>

  </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PENGELUARAN PERMINTAAN BARANG (BPP)</u></p>

  <div class="isi" style="margin: 0 auto;">
    
    <table class="tabelatas">
      <tr>
        <td style="text-align: left; width:80px;  "><b>Periode </b></td>  
        <td style="text-align: left; "><b>: <?= tanggal_indo($tanggala); ?> - S/d  <?= tanggal_indo($tanggalb);?></b></td>           
      </tr>
     
    </table>
    <br>
    <table class="tabel2">      
      <thead>
        <tr>
          <td style="text-align: center; "><b>No.</b></td>        
          <td style="text-align: center; "><b>Tanggal Permintaan</b></td>

          <td style="text-align: center; "><b>Unit</b></td>
          <td style="text-align: center; "><b>Instansi</b></td>
          <td style="text-align: center; "><b>Kode Barang</b></td>
          <td style="text-align: center; "><b>Nama Barang</b></td>
          <td style="text-align: center; "><b>Jumlah</b></td>   
          <td style="text-align: center; "><b>Satuan</b></td>                                     
        </tr>
      </thead>
      <tbody>
        <?php

        $query = mysqli_query($koneksi, "SELECT * from permintaan left join stokbarang on permintaan.kode_brg=stokbarang.kode_brg where tgl_permintaan BETWEEN '$tanggala' and '$tanggalb' group by id_permintaan "); 
        $i   = 1;
        $total = 0;
        while($data=mysqli_fetch_array($query))

        {
          ?>
          <tr>
            <td style="text-align: center; width=10px; "><?php echo $i; ?></td>         
            <td style="text-align: center; width=150px; font-size: 12px;"><?php echo date('d/m/Y', strtotime($data['tgl_permintaan']));  ?></td>

            <td style="text-align: center; width=100px; font-size: 12px;"><?php echo $data['unit']; ?></td>
            <td style="text-align: left; width=150px; font-size: 12px;"><?php echo $data['instansi']; ?></td>
            <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['kode_brg']; ?></td>
            <td style="text-align: center; width=70px; font-size: 12px;"><?php echo $data['nama_brg']; ?></td>

            <td style="text-align: center; font-size: 12px;"><?php echo $data['jumlah']; ?></td>      
            <td style="text-align: center; font-size: 12px;"><?php echo $data['satuan']; ?></td>                         
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
        <td style="text-align: center; width:572px;"><b>Total Barang</b></td>        


        <td style="text-align: center; width=35px;"><b><?= $total = $total; ?></b></td>                                        
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
    <br>
    <p><br><br>Karyawan </p>
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
    $html2pdf->Output('lap_permintaan_brg_detail.pdf');
  }
  catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
  }
  
  ?>