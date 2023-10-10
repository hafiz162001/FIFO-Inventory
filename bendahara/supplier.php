<?php  
      include "../fungsi/koneksi.php";
      if (isset($_GET['aksi']) && isset($_GET['id'])) {
        //die($id = $_GET['id']);
        $id = $_GET['id'];        

        if ($_GET['aksi'] == 'edit') {
            header("location:?p=editsupplier&id=$id");
        } else if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapussupplier&id=$id");
        } 
    }
	
	$query = mysqli_query($koneksi, "SELECT * FROM supplier");	

?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-sm-12">
			 <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Olah Data Supplier</h3>
                </div>                
                <div class="box-body">
               <div class="row">
                    <div class="col-md-2">
                        <a href="index?p=tambahsupplier" class=" btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> 
                    </div>
                    <br><br>
                </div>                  
                	<div class="table-responsive">
                		<table class="table text-center" id="user">
                			<thead  > 
	                			<tr>
	                				<th>No</th>
	                				<th>Nama Supplier</th>	                					                				
                                    <th>Alamat</th>
                                    <th>Telephone</th>
	                				<th>Aksi</th>	                				
	                			</tr>
                			</thead>
                			<tbody>
                				<tr>
                					<?php 
                						$no =1 ;
                						if (mysqli_num_rows($query)) {
                							while($row=mysqli_fetch_assoc($query)):

                					 ?>
                						<td> <?= $no; ?> </td>
                						<td> <?= $row['nama_supplier']; ?> </td>                                        
                						<td> <?= $row['alamat']; ?> </td>
                                        <td> <?= $row['telepone']; ?> </td>
                                        
                						
                                         <td>
                                            <a href="?p=supplier&aksi=edit&id=<?= $row['id_supplier']; ?>"><span data-placement='top' data-toggle='tooltip' title='Edit'><button  class="btn btn-info">Edit</button></span></a>                     

                                            <a href="?p=supplier&aksi=hapus&id=<?= $row['id_supplier']; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button></span></a>                    
                                        </td>              					
                				</tr>
                			<?php $no++; endwhile; } ?>
                			</tbody>
                		</table>
                	</div>                	
                </div>
            </div>
		</div>
	</div>

</section>

<script>
    $(function(){
        $("#user").DataTable({
             "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            "sEmptyTable": "Tidak ada data di database"
            }
        });
    });
</script> 
