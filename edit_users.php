	<?php
		if ($_SESSION['level']== 'user') {
			echo '<script> 
					window.alert("Anda tidak memiliki hak akses ke halaman ini");
					window.location.href="./logout.php";
				  </script>';
		}
		if (isset($_REQUEST['edit'])) {
			$username 		= $_POST['username'];
			$fullname 		= $_POST['fullname'];
			$level 	  		= $_POST['level'];
			$tipe	  		= $_POST['tipe'];
			$cabang		 	= $_POST['cabang'];
			$status 		= $_POST['status'];
			$foto 			= $_FILES['foto']['name'];
			$tmp 			= $_FILES['foto']['tmp_name'];

			$path			= "upload/user/".$foto;

			//proses update 
			if (move_uploaded_file($tmp, $path)) {
				$query 		= "SELECT * FROM user WHERE id='$_GET[id]'";
				$sql		= mysqli_query($connect, $query);
				$data 		= mysqli_fetch_array($sql);
			//jika ada foto nya ada, hapus filenya
				if (file_exists("upload/user/".$data['foto'])) {
					unlink("upload/user/".$data['foto']);
				}
			//jika mengubah foto
				$query2 	= "UPDATE user SET username='$username', fullname='$fullname', level='$level', tipe='$tipe', cabang='$cabang', status='$status', foto='$foto' WHERE id='$_GET[id]'";
				$sql2		= mysqli_query($connect, $query2);

				if ($sql2) {
					echo '<script>
							window.alert("Data berhasil di ubah");
							window.history.go(-2);
						  </script>';
				}else{
					echo '<script>
							window.alert("Data gagal di ubah");
						 </script>';
				}
		}else{
			//jika tidak mengubah foto
				$query3 	= "UPDATE user SET username='$username', fullname='$fullname', level='$level', tipe='$tipe', cabang='$cabang', status='$status' WHERE id='$_GET[id]'";
				$sql3     	= mysqli_query($connect, $query3);
				if ($sql3) {
					echo '<script>
							window.alert("Data berhasil di ubah");
							window.history.go(-2);
						  </script>';
				}else{
					echo '<script>
							window.alert("Data gagal di ubah");
						 </script>';
				}
			}
		}
	?>

	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Edit Users</h3>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Form Edit Users</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<!-- Form Edit Users -->
						<?php
							$query	= "SELECT * FROM user WHERE id='$_GET[id]'";
							$sql 	= mysqli_query($connect, $query);
							while ($data = mysqli_fetch_array($sql)) {
						?>
						<form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="username" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $data['username'] ?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Fullname<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" name="fullname" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $data['fullname'] ?>">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Level<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" name="level" required="required">
										<option><?php echo $data['level'] ?></option>
										<!-- <option>superadmin</option> Bisa Melihat dan edit/hapus semua data - TSI -->
										<option>adminuser</option> <!--Bisa Menambah/maintenance User - TSI-->
										<option>admindata</option> <!--Bisa Menambah/maintenance Data - TSI-->
										<option>admin</option> <!--Bisa Melihat dan edit/hapus semua pada Divisi-->
								        <option>admin1</option> <!--Bisa Melihat dan edit/hapus semua pada Bagian-->
								        <option>user</option> <!--Bisa Melihat semua pada Divisi-->
								        <option>user1</option> <!--Bisa Melihat semua pada Bagian-->
									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Tipe<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" name="tipe" required="required">
										<option><?php echo $data['tipe'] ?></option>
										<option>KPS</option>
										<option>CAB</option>							        
									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Status User<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control col-md-7 col-xs-12" name="status" required="required">
										<option><?php echo $data['status'] ?></option>
								        <option>Aktif</option>
								        <option>Non Aktif</option>
							        </select>
								</div>
							</div>
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Cabang<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control col-md-7 col-xs-12" name="cabang" required="required">
									<option value="<?php echo $data['cabang']?>" selected><?php echo $data['cabang']?></option>									
									<?php
 										$query	= "SELECT * FROM cabang";
 										$sql	= mysqli_query($connect, $query);
 									    while ($data= mysqli_fetch_array($sql)){
 									?>
								        <option value = "<?php echo $data['kode'] ?>"><?php echo $data['kode']; ?></option>
									<?php
										}
									?>
							        </select>	
								</div>
							</div>							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Foto<span class="required">&nbsp; :</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="file" name="foto" class="form-control col-md-7 col-xs-12">
								</div>
							</div>							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button type="reset" class="btn btn-default">Reset</button>
									<input type="submit" class="btn btn-success" name="edit" value="Simpan">
								</div>
							</div>
						</form>
						<?php 
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>