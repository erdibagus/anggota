<div class="row">
	<div class="col-md-12">
		<div class="card box-shadow-2">
			<?php
			if ($this->session->flashdata('alert') == 'hapus_anggota'):
				?>
				<div class="alert alert-danger alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil dihapus
				</div>
			<?php
			elseif ($this->session->flashdata('alert') == 'update_anggota'):
				?>
				<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data Approved, lihat tabel anggota.
				</div>
			<?php
			endif;
			?>
			<div class="card-header">
				<h1 style="text-align: center">Anggota Masuk</h1>
			</div>
			<hr>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered zero-configuration" id="tabel" width="100%">
						<thead>
						<tr>
							<th>No</th>
							<th>NIK</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Pekerjaan</th>
							<th>Alamat</th>
							<th>Desa</th>
							<th>Kecamatan</th>
							<th>Kabupaten/Kota</th>
							<th>Provinsi</th>
							<th>Tanggal Masuk</th>
							<td style="text-align: center"><i class="ft-settings spinner"></i></td>
						</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal lihat -->
<div class="modal fade text-left" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Lihat Data Anggota</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('anggota_masuk/update') ?>
			<div class="modal-body">
				<fieldset class="form-group floating-label-form-group">
					<label for="nik">NIK</label>
					<input type="number" class="form-control" name="nik" id="lihat_nik" placeholder="NIK"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" name="nama" id="lihat_nama" placeholder="Nama anggota"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="no_anggota">Jenis Kelamin</label>
					<input type="text" class="form-control" name="jenis_kelamin" id="lihat_jenis_kelamin" placeholder="Jenis Kelamin"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="pekerjaan">Pekerjaan</label>
					<input type="text" class="form-control" name="pekerjaan" id="lihat_pekerjaan" placeholder="Pekerjaan"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="alamat">Alamat</label>
					<textarea class="form-control" id="lihat_alamat" rows="3" name="alamat" placeholder="Alamat"
							  autocomplete="off" readonly></textarea>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="desa">Desa</label>
					<input type="text" class="form-control" id="lihat_desa" placeholder="Desa"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="kecamatan">Kecamatan</label>
					<input type="text" class="form-control" id="lihat_kecamatan" placeholder="Kecamatan"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="kabupaten">Kabupaten/Kota</label>
					<input type="text" class="form-control" id="lihat_kabupaten" placeholder="Kabupaten"
						   autocomplete="off" readonly>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="kabupaten">Provinsi</label>
					<input type="text" class="form-control" id="lihat_provinsi" placeholder="Kabupaten"
						   autocomplete="off" readonly>
				</fieldset>
					
					<input type="text" class="form-control" id="lihat_provinsi" placeholder="Provinsi"
						   autocomplete="off" hidden>
				
					
					<input type="text" class="form-control" name="desa" id="id_desa" placeholder="Desa"
						   autocomplete="off" hidden>
				
					<input type="text" class="form-control" name="kecamatan" id="id_kecamatan" placeholder="Kecamatan"
						   autocomplete="off" hidden>
				
					
					<input type="text" class="form-control" name="kabupaten" id="id_kabupaten" placeholder="Kabupaten"
						   autocomplete="off" hidden>
				
					
					<input type="text" class="form-control" name="provinsi" id="id_provinsi" placeholder="Provinsi"
						   autocomplete="off" hidden>

				<fieldset class="form-group floating-label-form-group">
					<label for="tanggal_gabung">Tanggal Bergabung</label>
					<div class='input-group'>
						<input type="date" class="form-control" id="lihat_tanggal_gabung" name="tanggal_gabung"
							   placeholder="Tanggal Bergabung" autocomplete="off" readonly>
						<div class="input-group-append">
										<span class="input-group-text">
											<span class="ft-calendar"></span>
										</span>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="modal-footer">
				<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal" value="Tutup">
				<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="update" value="Approv">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<!-- Modal hapus -->
<div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel35"> Hapus Data anggota ?</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<input type="reset" class="btn btn-secondary btn-bg-gradient-x-blue-cyan" data-dismiss="modal" value="Tutup">
				<div id="hapusanggota">

				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>

<script type="text/javascript"> 

var table;  
 $(document).ready(function() {
  
     //datatables
     table = $('#tabel').DataTable({ 
  
         "processing": true, //Feature control the processing indicator.
         "serverSide": true, //Feature control DataTables' server-side processing mode.
         "order": [], //Initial no order.
         lengthChange: false,
  
         // Load data for the table's content from an Ajax source
         "ajax": {
             "url": "<?php echo site_url('anggota_masuk/ajax_list')?>",
             "type": "POST"
         },
  
         //Set column definition initialisation properties.
         "columnDefs": [
         { 
             "targets": [ -1 ], //first column / numbering column
             "orderable": false, //set not orderable
         },
         ],
  
     });

 });

function konfirmasi(id) {
	var html = '' +
			'<a href="anggota_masuk/hapus/'+id+'" class="btn btn-danger btn-bg-gradient-x-red-pink">Hapus</a>';
		$('#hapusanggota').html(html);
	}

function lihat(id) {
	var getUrl = 'anggota/lihat/' + id;
		$.ajax({
			url : getUrl,
			type : 'ajax',
			dataType : 'json',
			success: function (response) {
				if (response != null){
					$('#lihat_nik').val(response.anggota_id);
					$('#lihat_nama').val(response.nama);
					$('#lihat_no_anggota').val(response.no_anggota);
					$('#lihat_jenis_kelamin').val(response.jenis_kelamin);
					$('#lihat_pekerjaan').val(response.pekerjaan);
					$('#lihat_alamat').val(response.alamat);
					$('#lihat_desa').val(response.nama_desa);
					$('#lihat_kecamatan').val(response.nama_kecamatan);
					$('#lihat_kabupaten').val(response.nama_kabupaten);
					$('#lihat_provinsi').val(response.nama_provinsi);
					$('#id_desa').val(response.desa);
					$('#id_kecamatan').val(response.kecamatan);
					$('#id_kabupaten').val(response.kabupaten);
					$('#id_provinsi').val(response.provinsi);
					$('#lihat_tanggal_gabung').val(response.tanggal_gabung);
					console.log(response);
				}
			},
			error: function (response) {
				console.log(response.status + 'error');
			}
		});
	}

</script>

