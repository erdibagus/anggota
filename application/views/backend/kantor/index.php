<div class="row">
	<div class="col-md-12">
		<div class="card">
			<?php
			if ($this->session->flashdata('alert') == 'tambah_kantor'):
				?>
				<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil ditambahkan
				</div>
			<?php
			elseif ($this->session->flashdata('alert') == 'update_kantor'):
				?>
				<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil diupdate
				</div>
			<?php
			elseif ($this->session->flashdata('alert') == 'hapus_kantor'):
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
				<h1 style="text-align: center">Data kantor</h1>
				<button type="button" class="btn btn-primary btn-bg-gradient-x-purple-blue box-shadow-2" data-toggle="modal" data-target="#tambah">
					<i class="ft-plus-circle"></i> Tambah kantor
				</button>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered zero-configuration" >
						<thead>
						<tr>
							<th>No</th>
							<th>Kantor</th>
							<td style="text-align: center"><i class="ft-settings spinner"></i></td>
						</tr>
						</thead>
						<tbody>

						<?php
						$no = 1;
						foreach ($kantor as $key=>$value):
						?>
						<tr>
							<td><?=$no?></td>
							<td><?=$value['kantor_nama']?></td>
							<td>
								<button class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2 kantor-edit" onclick="edit('<?=$value['kantor_id']?>')" data-toggle="modal" data-target="#ubah" value="<?=$value['kantor_id']?>"><i class="ft-edit"></i></button>
								<button class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2 kantor-hapus" onclick="hapus('<?=$value['kantor_id']?>')" data-toggle="modal" data-target="#hapus" value="<?=$value['kantor_id']?>"><i class="ft-trash"></i></button>
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
</div>

<!-- Modal tambah -->
<div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Tambah Data Kantor</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('kantor/tambah')?>
				<div class="modal-body">
					<fieldset class="form-group floating-label-form-group">
						<label for="kantor">Kantor</label>
						<input type="text" class="form-control" name="kantor" id="kantor" placeholder="kantor" autocomplete="off" required>
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
<div class="modal fade text-left" id="ubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Ubah Data Kantor</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('kantor/update')?>
				<div class="modal-body" id="updateformkantor">

				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
					<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="update" value="Update">
				</div>
			<?= form_close()?>
		</div>
	</div>
</div>

<!-- Modal hapus -->
<div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Hapus Data kantor ?</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
					<div id="hapuskantor">

					</div>
				</div>
		</div>
	</div>
</div>

<script>
	function edit(id) {		
		var getUrl = 'kantor/updateForm/' + id;
		var html = '';
		$.ajax({
			url : getUrl,
			type : 'ajax',
			dataType : 'json',
			success: function (response) {
				console.log(response);
				if (response != null){
					html += '' +
						'<input type="hidden" value="'+id+'" name="id">' +
						'<fieldset class="form-group floating-label-form-group">' +
						'<label for="kantor">Kantor</label>' +
						'<input type="text" class="form-control" name="kantor" id="kantor" value="'+response.kantor_nama+'" placeholder="Kantor" autocomplete="off" required>' +
						'</fieldset>';

					console.log(html);
					$('#updateformkantor').html(html);
				}
			},
			error: function (response) {
				console.log(response.status + 'error');
			}
		});
	}

	function hapus(id) {
		var html = '' +
			'<a href="kantor/hapus/'+id+'" class="btn btn-danger btn-bg-gradient-x-red-pink">Hapus</a>';
		$('#hapuskantor').html(html);
	}
</script>
