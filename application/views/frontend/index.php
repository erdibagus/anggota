<div class="container tengah">
		<div class="text-center mb-2">
				<img src="<?= base_url() ?>assets/images/logo/sekartama.png" alt="branding logo">
		</div>
		<div class="box-shadow-5">
			<?php
			if ($this->session->flashdata('alert') == 'tambah_anggota'):
				?>
				<div class="alert alert-success alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					Data berhasil ditambahkan
				</div>
			<?php
			elseif ($this->session->flashdata('form_error')):
				?>
				<div class="alert alert-warning alert-dismissible animated fadeInDown" id="feedback" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					NIK sudah terdaftar
				</div>
			<?php
			endif;
			?>
			
			<div class="card-header center">
				<button type="button" class="btn btn-primary btn-bg-gradient-x-red-pink box-shadow-2"
						data-toggle="modal" data-target="#bootstrap">
						Pendaftaran Anggota
				</button>
			</div>
		</div>
		</div>


<!-- Modal tambah -->
<div class="modal fade text-left" id="bootstrap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-gradient-x-purple-red">
				<h3 class="modal-title text-white font-weight-bold" id="myModalLabel35"> Form Pendaftaran Anggota</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="text-white" aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('anggota_masuk/tambah') ?>
			<div class="modal-body">
				<fieldset class="form-group floating-label-form-group">
					<label for="nik">NIK</label>
					<input type="number" class="form-control" name="nik" id="nik" placeholder="NIK"
						   autocomplete="off" required>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama anggota"
						   autocomplete="off" required>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="jenis_kelamin">Jenis Kelamin</label>
					<select name="jenis_kelamin" id="basicSelect" class="form-control" required>
						<option value="">--Pilih--</option>
						<option value="L">Laki Laki</option>
						<option value="P">Perempuan</option>
					</select>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="pekerjaan">Pekerjaan</label>
					<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan"
						   autocomplete="off" required>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="alamat">Alamat</label>
					<textarea class="form-control" id="alamat" rows="3" name="alamat" placeholder="Alamat"
							  autocomplete="off" required></textarea>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
				<label for="provinsi">Provinsi</label>
                            <select class="form-control" id="provinsi" name="provinsi">
                                <option value="">--Pilih--</option>
                                <?php foreach ($provinsi as $prov) : ?>
                                    <option value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
                                <?php endforeach; ?>
                            </select>
				</fieldset>
				
					<div class="form-group">
						<label for="kabupaten">Kabupaten/Kota</label>
						<select class="form-control" id="kabupaten" name="kabupaten">
							<option value="">--Pilih--</option>
						</select>
					</div>
				
				
					<div class="form-group">
						<label for="kecamatan">Kecamatan</label>
						<select class="form-control" id="kecamatan" name="kecamatan">
							<option value="">--Pilih--</option>
						</select>
					</div>
				
					<div class="form-group">
						<label for="desa">Desa</label>
						<select class="form-control" id="desa" name="desa">
							<option value="">--Pilih--</option>
						</select>
					</div>
			</div>
			<div class="modal-footer">
				<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal"
					   value="Tutup">
				<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" name="simpan" value="Daftar">
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<?php if($this->session->flashdata('Pesan')): ?>
<?= $this->session->flashdata('Pesan') ?>
<?php else: ?>
<script>
$(document).ready(function() {
    let timerInterval
    Swal.fire({
        title: 'Selamat Datang',
        timer: 1000,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {

    })
});
</script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('WilayahController/getKabupaten') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kabupaten').html(response);
                }
            });
        });

        $('#kabupaten').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('WilayahController/getKecamatan') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#kecamatan').html(response);
                }
            });
        });

        $('#kecamatan').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('WilayahController/getDesa') ?>",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#desa').html(response);
                }
            });
        });
    });
</script>