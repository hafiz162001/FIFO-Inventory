<?php  

include_once "../fungsi/koneksi.php";

if(isset($_POST['simpan'])) {
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepone = $_POST['telepone'];
    

    $query = mysqli_query($koneksi, "INSERT INTO supplier (nama_supplier,alamat,telepone) VALUES ('$nama_supplier', '$alamat','$telepone') ");        
    if ($query) {
     echo '<script language="javascript">alert("Data Berhasil Disimpan !!!"); document.location="index?p=supplier";</script>';
 } else {
    echo 'gagal : ' . mysqli_error($koneksi);
}
}


?>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Tambah Data Supplier</h3>
                </div>
                <form method="post"  action="" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="username" class="col-sm-offset-1 col-sm-3 control-label">Nama Supplier</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="nama_supplier">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="paswword"class="col-sm-offset-1 col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-4">
                                <input required type="text" class="form-control" name="alamat">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="jabatan" class="col-sm-offset-1 col-sm-3 control-label">Telephone</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="telepone">
                            </div>
                        </div>                       
                                                 
                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


