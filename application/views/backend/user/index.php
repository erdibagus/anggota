<div class="row">
	<div class="col-md-12">
		<div class="card">
			<?php
			if ($this->session->flashdata('alert') == 'tambah_user'):
				?>
				<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil ditambahkan
				</div>
			<?php
			elseif ($this->session->flashdata('alert') == 'update_user'):
				?>
				<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil diupdate
				</div>
			<?php
			elseif ($this->session->flashdata('alert') == 'hapus_user'):
				?>
				<div class="alert alert-danger alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil dihapus
				</div>
			<?php
			endif;
			?>
			<div class="card-header">
				<h1 style="text-align: center">Data User</h1>
				<button type="button" class="btn btn-primary btn-bg-gradient-x-purple-blue box-shadow-2" data-toggle="modal" data-target="#tambah">
					<i class="ft-plus-circle"></i> Tambah User
				</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered zero-configuration" >
					<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Kantor</th>
						<th>Level</th>
						<td style="text-align: center"><i class="ft-settings spinner"></i></td>
					</tr>
					</thead>
					<tbody>

					<?php
					$no = 1;
					foreach ($user as $key=>$value):
					?>
					<tr>
						<td><?=$no?></td>
						<td><?=$value['user_nama']?></td>
						<td><?=$value['kantor_nama']?></td>
						<td><?=$value['user_hak_akses']?></td>
						<td>
							<button class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2" onclick="edit('<?=$value['user_id']?>')" data-toggle="modal" data-target="#ubah" value="<?=$value['user_id']?>"><i class="ft-edit"></i></button>
							<button class="btn btn-warning btn-sm  btn-bg-gradient-x-orange-yellow box-shadow-2" onclick="reset('<?=$value['user_id']?>')" data-toggle="modal" data-target="#reset" value="<?=$value['user_id']?>"><i class="ft-unlock"></i></button>
							<button class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2" onclick="hapus('<?=$value['user_id']?>')" data-toggle="modal" data-target="#hapus" value="<?=$value['user_id']?>"><i class="ft-trash"></i></button>
						</td>
					</tr>
					<?php
					$no++;
					endforeach;
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal tambah -->
<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Tambah Data User</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('user/tambah')?>
				<div class="modal-body">
					<fieldset class="form-group floating-label-form-group">
						<label for="nama">Nama</label>
						<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" autocomplete="off" required>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
					<label for="kantor">Kantor</label>
						<select name="kantor" id="basicSelect" class="form-control">
							<option value="">--Pilih--</option>
							<?php
							foreach ($kantor as $key => $value):
								?>
								<option value="<?= $value['kantor_id'] ?>"><?= $value['kantor_nama'] ?></option>
							<?php
							endforeach;
							?>
						</select>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
					<label for="level">Level</label>
						<select name="level" id="basicSelect" class="form-control" required>
							<option value="">--Pilih--</option>
							<option value="admin">Admin</option>
							<option value="user">User</option>
						</select>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" required>
					</fieldset>
					<fieldset class="form-group floating-label-form-group">
						<label for="password">Password</label>
						<input type="text" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required>
					</fieldset>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
					<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="simpan" value="Simpan">
				</div>
			<?= form_close()?>
		</div>
	</div>
</div>

<!-- Modal ubah -->
<div class="modal fade text-left" id="ubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Update Data User</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('user/update') ?>
			<div class="modal-body">
				<input type="text" name="id" id="edit_id" hidden>
				<fieldset class="form-group floating-label-form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" name="nama" id="edit_nama" placeholder="Nama"
						   autocomplete="off" required>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="kantor">Kantor</label>
					<select name="kantor" id="edit_kantor" class="form-control" required>
						<option value="">--Pilih--</option>
						<?php
						foreach ($kantor as $key => $value):
						?>
							<option value="<?= $value['kantor_id'] ?>"><?= $value['kantor_nama'] ?></option>
						<?php
						endforeach;
						?>
					</select>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="level">Level</label>
					<select name="level" id="edit_level" class="form-control" required>
						<option value="">--Pilih--</option>
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
				</fieldset>
			</div>
			<div class="modal-footer">
				<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal"
					   value="Tutup">
				<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="update" value="Update">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<!-- Modal reset password -->
<div class="modal fade text-left" id="reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Reset Password User</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('user/reset') ?>
			<div class="modal-body">
				<input type="text" name="id" id="reset_id" hidden>
				<fieldset class="form-group floating-label-form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" name="nama" id="reset_nama" placeholder="Nama"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="password">Password</label>
					<input type="text" class="form-control" name="password" id="password" placeholder="Password"
						   autocomplete="off" required>
				</fieldset>
			<div class="modal-footer">
				<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal"
					   value="Tutup">
				<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="reset" value="Reset">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
</div>

<!-- Modal hapus -->
<div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Hapus Data User ?</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
					<div id="hapususer">

					</div>
				</div>
		</div>
	</div>
</div>

<script>
	function edit(id) {
	var getUrl = 'user/lihat/' + id;
		$.ajax({
			url : getUrl,
			type : 'ajax',
			dataType : 'json',
			success: function (response) {
				if (response != null){
					$('#edit_id').val(response.user_id);
					$('#edit_nama').val(response.user_nama);
					$('#edit_kantor').val(response.user_kantor);
					$('#edit_level').val(response.user_hak_akses);
					console.log(response);
				}
			},
			error: function (response) {
				console.log(response.status + 'error');
			}
		});
	}

	function reset(id) {
	var getUrl = 'user/lihat/' + id;
		$.ajax({
			url : getUrl,
			type : 'ajax',
			dataType : 'json',
			success: function (response) {
				if (response != null){
					$('#reset_id').val(response.user_id);
					$('#reset_nama').val(response.user_nama);
					console.log(response);
				}
			},
			error: function (response) {
				console.log(response.status + 'error');
			}
		});
	}

	function hapus(id) {
		var html = '' +
			'<a href="user/hapus/'+id+'" class="btn btn-danger btn-bg-gradient-x-red-pink">Hapus</a>';
		$('#hapususer').html(html);
	}
</script>
