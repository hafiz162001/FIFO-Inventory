<?php  

include "../fungsi/koneksi.php";
$query = mysqli_query($koneksi, "SELECT MAX(kode_brg) from stokbarang");
$kode_brg = mysqli_fetch_array($query);    
if ($kode_brg) {

    $nilaikode = substr($kode_brg[0], 4);
    
    $kode = (int) $nilaikode;

            //setiap kode ditambah 1
    $kode = $kode + 1;
    $kode_otomatis = "111.".str_pad($kode, 3, "0", STR_PAD_LEFT);                   
    
    
} else {
    $kode_otomatis = "111001";
}

?>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Tambah Data Stok Barang</h3>
                </div>
                <form method="post"  action="add-proses.php" class="form-horizontal">
                    <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" value="<?= $kode_otomatis; ?>" class="form-control" name="kode_brg" readonly>
                                <label for="jumlah" class="col-sm-offset-1 col-sm-3 control-label">Nama Barang</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="nama_brg">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jumlah" class="col-sm-offset-1 col-sm-3 control-label">Satuan</label>
                                <div class="col-sm-4">
                                    <input type="text-center" class="form-control" name="satuan">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name="simpan" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                                &nbsp;
                                <input type="reset" class="btn btn-danger" value="Batal">             
                                <a href="index?p=material-m1&id_jenis=1" style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a>  


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $('.tanggal').datepicker({
                format:"yyyy-mm-dd",
                autoclose:true
            });
        });


        var rupiah = document.getElementById("hargabarang");
        rupiah.addEventListener("keyup", function(e) {
            rupiah.value = currencyIdr(this.value, "Rp. ");
        });


        function currencyIdr(angka, prefix) {
          var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split  = number_string.split(","),
          sisa   = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

          if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : "");
    }
</script>