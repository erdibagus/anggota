<div class="tengah text-center">
	<div class="text-center mb-2">
			<img src="<?= base_url() ?>assets/images/logo/sekartama.png" alt="branding logo">
	</div>
		<button type="button" class="btn btn-primary text-center btn-bg-gradient-x-red-pink box-shadow-5"
				data-toggle="modal" data-target="#bootstrap">
				Pendaftaran Anggota
		</button>
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
			<?= form_open_multipart('anggota_masuk/tambah'); ?>
			<!-- <form action="<?= base_url() ?>anggota_masuk/tambah" method="POST" enctype="multipart/form-data"> -->
			<div class="modal-body">
				<fieldset class="form-group floating-label-form-group">
					<label for="nik">NIK</label>
					<input type="number" class="form-control" name="anggota_id" id="nik" placeholder="NIK"
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
                            <select class="form-control" id="provinsi" name="provinsi" required>
                                <option value="">--Pilih--</option>
                                <?php foreach ($provinsi as $prov) : ?>
                                    <option value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
                                <?php endforeach; ?>
                            </select>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
						<label for="kabupaten">Kabupaten/Kota</label>
						<select class="form-control" id="kabupaten" name="kabupaten" required>
							<option value="">--Pilih--</option>
						</select>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
						<label for="kecamatan">Kecamatan</label>
						<select class="form-control" id="kecamatan" name="kecamatan" required>
							<option value="">--Pilih--</option>
						</select>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
						<label for="desa">Desa</label>
						<select class="form-control" id="desa" name="desa" required>
							<option value="">--Pilih--</option>
						</select>
				</fieldset>
				<fieldset class="form-group floating-label-form-group">
					<label for="lampiran">Lampiran</label>
						<input type="file" name="lampiran" title="File Gambar dan PDF" id="lampiran">
				</fieldset>
				</div>
				<div class="modal-footer">
				<input type="reset" class="btn btn-secondary btn-bg-gradient-x-red-pink" data-dismiss="modal"
					   value="Tutup">
				<input type="submit" class="btn btn-primary btn-bg-gradient-x-blue-cyan" value="Daftar">
			</div>
			<!-- </form> -->
			<?= form_close(); ?>
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