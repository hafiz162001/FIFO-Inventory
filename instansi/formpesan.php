<?php
include "../fungsi/koneksi.php";
$error = "";

//cek stok mines
/*
$caridata1=mysqli_query($koneksi, "select * from stokbarang where stok<0 order by id_kode_brg limit 0,1");
		$ketemu1=mysqli_fetch_assoc($caridata1);
        $stoknow=$stok
		mysqli_query($koneksi,"update stokbarang set stok = stok+$ketemu1[stok] where kode_brg=$ketemu1[kode_brg]");
		*/

?>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Form Permintaan Barang</h3>
                </div>
                <form method="post" id="tes" action="add-proses.php" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="nama_brg" class="a col-sm-3 control-label">Nama</label>
                            <div class="col-sm-3">
                                <input type="text" readonly value="<?= $_SESSION['username']; ?>" class="form-control" name="unit">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instansi" class=" col-sm-3 control-label">Pegawai</label>
                            <div class="col-sm-5">
                                <input id="instansi" type="text" readonly value="<?= $_SESSION['jabatan']; ?>" class="form-control" name="instansi">
                            </div>
                            <span class="col-sm-7"> <?php echo $error; ?></span>
                        </div>


                        <div class="form-group">
                            <label for="nama_brg" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-5">
                                <select id="nama_brg" required="isikan dulu" class="form-control" name="kode_brg">
                                    <?php

                                    include "../fungsi/koneksi.php";


                                    $query = mysqli_query($koneksi, "select distinct(nama_brg), kode_brg from stokbarang");

                                    if (mysqli_num_rows($query)) {
                                        echo "<option>--Pilih Barang--</option>";
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<option value=$row[kode_brg]>$row[nama_brg]</option>\n";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stok" class="col-sm-3 control-label">Stok Tersedia</label>
                            <div class="col-sm-2">
                                <input id="stok" disabled value="----" type="text" class="form-control" name="stok">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stok" class=" col-sm-3 control-label">Jumlah</label>
                            <div class="col-sm-2">
                                <input id="jumlah" type="number" onkeyup="sendAjax()" class="form-control" name="jumlah" required>
                            </div>
                            <span class="col-sm-7"> <?php echo $error; ?></span>
                        </div>


                        <div class="form-group">
                            <input type="submit" id="simpan" name="simpan" class="btn btn-primary col-sm-offset-3 " value="Simpan">
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">
                        </div>
                    </div>
                </form>
            </div>
        </div>


</section>

<script>
    $(document).ready(function() {
        $("#jenis_brg").change(function() {
            var jenis = $(this).val();
            var dataString = 'jenis=' + jenis;
            $.ajax({
                type: "POST",
                url: "getdata.php",
                data: dataString,
                success: function(html) {
                    $("#nama_brg").html(html);
                }
            });
        });

        $("#nama_brg").change(function() {
            var kode = $(this).val();
            var dataString = 'kode=' + kode;
            $.ajax({
                type: "POST",
                url: "getkode.php",
                data: dataString,
                success: function(html) {
                    $("#stok").val(html);
                }
            });
        });

    });



    function cek_stok() {
        var jumlah = $("#jumlah").val();
        var kode_brg = $("#nama_brg").val();
        $.ajax({
            url: 'cekstok.php',
            data: "jumlah=" + jumlah + "&kode_brg=" + kode_brg,
            dataType: 'json',
        }).success(function(data) {


            if (data.hasil == 1) {
                $("#tes").submit(function(e) {
                    e.preventDefault();
                    alert(data.pesan);
                });
            }



        });
    }

    function sendAjax() {
        setTimeout(
            function() {
                var jumlah = $("#jumlah").val();
                var kode_brg = $("#nama_brg ").val();
                $.ajax({
                    url: 'cekstok.php',
                    data: "jumlah=" + jumlah + "&kode_brg=" + kode_brg,
                    dataType: 'json',
                }).success(function(data) {


                    if (data.hasil == 1) {

                        alert(data.pesan);
                        $("#jumlah").val("");

                    }



                });
            }, 1000);
    }
</script>