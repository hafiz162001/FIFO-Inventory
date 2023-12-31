<?php  
    include "../fungsi/koneksi.php";
    //mengambil id untuk edit user
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier = $id ");
        if (mysqli_num_rows($query)) {
            while($row2 = mysqli_fetch_assoc($query)):
?>

<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Edit Data Supplier</h3>
                </div>                
                <form method="post"  action="editsupplierproses.php" class="form-horizontal">
                    <div class="box-body">
                     <div class="row">
                        <div class="col-md-2">
                            <a href="index?p=user" class="btn btn-primary"><i class="fa fa-backward"></i> Kembali</a> 
                        </div>
                        <br><br>
                    </div>     
                        <input type="hidden" name="id_supplier" value="<?= $row2['id_supplier']; ?>">
                        <div class="form-group ">
                            <label for="username" class="col-sm-offset-1 col-sm-3 control-label">Nama Supplier</label>
                            <div class="col-sm-4">
                                <input type="text"  required value="<?= $row2['nama_supplier']; ?>" class="form-control" name="nama_supplier">
                            </div>
                        </div>
                         <div class="form-group ">
                            <label for="jabatan" class="col-sm-offset-1 col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= $row2['alamat'];  ?>" required  class="form-control" name="alamat">
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="jabatan" class="col-sm-offset-1 col-sm-3 control-label">Telephone</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= $row2['telepone'];  ?>" required  class="form-control" name="telepone">
                            </div>
                        </div>
                                           
                                            
                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php endwhile; } }  ?>