	<?php
		if ($_SESSION['level']== 'admin1' || $_SESSION['level']== 'user1' || $_SESSION['level']== 'adminuser' || $_SESSION['level']== 'admindata') {
			echo '<script> 
					window.alert("Anda tidak memiliki akses ke halaman ini");
					window.location.href="./logout.php";
				  </script>';		
		}
	?>
	
	<div class="">
 		<div class="page-title">
 			<div class="title_left">
			 <?php 							
			 				$queryx	= "SELECT * FROM mou WHERE id_addendum = '$_GET[id]'";
			 				$sqlx	= mysqli_query($connect, $queryx);
			 				$datax	= mysqli_fetch_array($sqlx)
 						?>
 						<h3> Judul : <b style="color:grey"><?php echo substr($datax['judul'], 0, 100) ?></b></h3>
 			</div>
 		</div>
 		<div class="clearfix"></div>

 		<div class="row">
 			<div class="col-md-12 col-sm-12 col-xs-12">
 				<div class="x_panel">				 
 					<div class="x_title"> 						
						 &nbsp; &nbsp;<a href="index.php?page=tambah_mou_addendum&id=<?php echo $datax['id_mou']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
						 &nbsp; &nbsp;<a href="export_xls_mou_addendum.php?id=<?php echo $datax['id_mou']; ?>" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Download</a>		
 						<ul class="nav navbar-right panel_toolbox">
 							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
 						</ul>
 						<div class="clearfix"></div>
 					</div>
 					<div class="x_content">
 						<table id="pekerjaan" width="150%" class="table table-striped table-bordered table-hover">
 							<thead>
 								<tr style="font-size: 13px;">
 									<th width="1" style="vertical-align: middle;">No</th>
 									<th style="vertical-align: middle;"><center>Nomor MoU</center></th> 	
 									<th style="vertical-align: middle;"><center>Tanggal MoU</center></th> 
 									<th style="vertical-align: middle;"><center>Pihak Pertama</center></th> 	
 									<th style="vertical-align: middle;"><center>Pihak Kedua</center></th> 
 									<th style="vertical-align: middle;"><center>Pihak Ketiga</center></th> 
 									<th style="vertical-align: middle; width:20%"><center>Judul MoU</center></th> 						
 									<th style="vertical-align: middle;"><center>Tanggal Mulai</center></th>
									<th style="vertical-align: middle;"><center>Tanggal Akhir</center></th>
									<th style="vertical-align: middle;"><center>Pemilik</center></th>
 									<th style="vertical-align: middle;"><center>File</center></th> 	
									<th style="vertical-align: middle;"><center>Status</center></th> 									
 									<th style="vertical-align: middle;"><center>Action</center></th>
 								</tr>
 							</thead>
 							<tbody>
 								<tr>
 									<?php
 										$no=1;
 										$query	= "SELECT * FROM mou WHERE id_addendum = '$_GET[id]' ORDER BY tanggal ASC";
 										$sql	= mysqli_query($connect, $query);
 									    while ($data= mysqli_fetch_array($sql)){
 									?>
									
 									<td width="1" style="vertical-align: middle;"><?php echo $no++; ?></td>
 									<td style="vertical-align: middle;"><?php echo $data['nomor']; ?></td>
									<td style="vertical-align: middle;"><?php echo IndonesiaTgl($data['tanggal']) ?></td>
									<td style="vertical-align: middle;"><?php echo $data['phk_1']; ?></td>
									<td style="vertical-align: middle;"><?php echo $data['phk_2']; ?></td>
									<td style="vertical-align: middle;"><?php echo $data['phk_3']; ?></td>
									<td style="vertical-align: middle;"><?php echo $data['judul']; ?></td>
 									<td style="vertical-align: middle;"><?php echo IndonesiaTgl($data['mulai']) ?></td>	
 									<td style="vertical-align: middle;"><?php echo IndonesiaTgl($data['selesai']) ?></td>	
									<td style="vertical-align: middle;"><?php echo $data['tipe']; ?> | <?php echo $data['cabang']; ?></td> 
 									<td style="vertical-align: middle;">
 										<a href="upload/mou/<?php echo $data['file']?>" class="btn btn-default btn-xs fa fa-download">&nbsp;<?php echo $data['file'];?></a>
 									</td>
									<td style="vertical-align: middle;"><?php echo $data['status']; ?></td> 

 									<td>
 										<center style="display : flex">
 											<a href="index.php?page=edit_mou&id=<?php echo $data['id_mou']; ?>" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
 											<?php  if($_SESSION['level']== 'admin' || $_SESSION['level']== 'superadmin') {?>
 											<a href="index.php?page=hapus_mou&id=<?php echo $data['id_mou']; ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ?')" class="btn btn-danger" title="Hapus"><i class="fa fa-trash-o"></i></a>										 		
 											<?php } ?>
 										</center>
 									</td>
 								</tr>
 								<?php } ?>
 							</tbody>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>