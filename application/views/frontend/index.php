<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Anggota - SEKARTAMA</title>
        <link href='<?= base_url() ?>assets/frontend/css/style.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script type='text/javascript' src=''></script>
        
    </head>
    <body className='snippet-body'>
        <div class="container">
            <div class="card">
                <div class="form">
                    <div class="left-side">
                        <div class="left-heading">
                            <h3>SEKARTAMA</h3>
                        </div>
                        <div class="steps-content">
                            <h3>Langkah <span class="step-number">1</span></h3>
                            <p class="step-number-content active">Isi data diri sesuai KTP</p>
                            <p class="step-number-content d-none">Alamat Lengkap</p>
                        </div>
                        <ul class="progress-bar">
                            <li class="active">Data diri</li>
                            <li>Alamat</li>
                            <li>Bukti transfer</li>
                        </ul>                     
                    </div>
                    <div class="right-side">
                        <div class="main active">
                            <img src="<?= base_url()?>assets/images/logoaja.png" alt="avatar" width="50">
                            <div class="text">
                                <h2>Form Anggota SEKARTAMA</h2>
                                <p>Input data sesuai KTP.</p>
                            </div>
                            <div class="input-text">
                                <div class="input-div">
                                    <input type="text" name="nik" required require>
                                    <span>NIK</span>
                                </div>
                                <div class="input-div"> 
                                    <input type="text" name="nama" id="user_name" required require>
                                    <span>Nama</span>
                                </div>
                                <select class="form-control" id="provinsi" name="provinsi">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($provinsi as $key => $prov) : ?>
							<option value="<?= $prov['id']; ?>"><?= $prov['nama_provinsi']; ?></option>
						<?php endforeach; ?>
                                    </select>
                            </div>
                            <div class="input-text">
                                <div class="input-div">
                                    <select name="jenis_kelamin">
                                        <option value="" hidden>Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="input-div">
                                    <input type="text" name="pekerjaan" required require>
                                    <span>Pekerjaan</span>
                                </div>
                            </div>
                            <div class="buttons">
                                <button class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <img src="<?= base_url()?>assets/images/logoaja.png" alt="avatar" width="50" >
                            <div class="text">
                                <h2>Form Anggota SEKARTAMA</h2>
                                <p>Masukkan alamat lengkap.</p>
                            </div>
                            <div class="input-text">
                                <div class="input-div">
                                    <input type="text" name="alamat" required require>
                                    <span>Alamat</span></span>
                                </div>
                            </div>
                            <div class="input-text">
                                <div class="input-div">
                                    <label for="provinsi">Provinsi</label>
                                    
                                </div>
                                <div class="input-div"> 
                                    <select name="provinsi">
                                        <option>Kabupaten/Kota</option>
                                        <option>BCA</option>
                                        <option>B-TECH</option>
                                        <option>BA</option>
                                        <option>B-COM</option>
                                        <option>B-SC</option>
                                        <option>MBA</option>
                                        <option>MCA</option>
                                        <option>M-COM</option>
                                        <option>M-TECH</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-text">
                                <div class="input-div">
                                    <select>
                                        <option>Kecamatan</option>
                                        <option>BCA</option>
                                        <option>B-TECH</option>
                                        <option>BA</option>
                                        <option>B-COM</option>
                                        <option>B-SC</option>
                                        <option>MBA</option>
                                        <option>MCA</option>
                                        <option>M-COM</option>
                                        <option>M-TECH</option>
                                    </select>
                                </div>
                                <div class="input-div">
                                    <select>
                                        <option>Desa</option>
                                        <option>BCA</option>
                                        <option>B-TECH</option>
                                        <option>BA</option>
                                        <option>B-COM</option>
                                        <option>B-SC</option>
                                        <option>MBA</option>
                                        <option>MCA</option>
                                        <option>M-COM</option>
                                        <option>M-TECH</option>
                                    </select>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button class="back_button">Back</button>
                                <button class="next_button">Next Step</button>
                            </div>
                        </div>
                        <div class="main">
                            <img src="<?= base_url()?>assets/images/logoaja.png" alt="avatar" width="50" >
                            <div class="text">
                                <h2>Form Anggota SEKARTAMA</h2>
                                <p>Lampiran bukti transfer.</p>
                            </div>
                            <div class="input-text">
                                <div class="input-div">
                                <input type="file" name="lampiran" title="File Gambar dan PDF" id="foto">
                                    <span>Lampiran</span>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button class="back_button">Back</button>
                                <button class="submit_button">Submit</button>
                            </div>
                        </div>                        
                        <!-- <div class="main">
                            <small><i class="fa fa-smile-o"></i></small>
                            <div class="text">
                                <h2>User Photo</h2>
                                <p>Upload your profile picture and share yourself.</p>
                            </div>
                            <div class="user_card">
                                <span></span>
                                <div class="circle">
                                    <span><img src="https://i.imgur.com/hnwphgM.jpg"></span>
                                    
                                </div>
                                <div class="social">
                                    <span><i class="fa fa-share-alt"></i></span>
                                    <span><i class="fa fa-heart"></i></span>
                                    
                                </div>
                                <div class="user_name">
                                    <h3>Peter Hawkins</h3>
                                    <div class="detail">
                                        <p><a href="#">Izmar,Turkey</a>Hiring</p>
                                        <p>17 last day . 94Apply</p>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons button_space">
                                <button class="back_button">Back</button>
                                <button class="submit_button">Submit</button>
                            </div>
                        </div> -->
                        <div class="main">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                            
                            <div class="text congrats">
                                <h2>Selamat!</h2>
                                <p>Terimakasih Bapak/Ibu. <span class="shown_name"></span> informasi Anda masukkan telah berhasil dikirimkan, kami akan segera menghubungi Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type='text/javascript' src='<?= base_url()?>assets/frontend/js/main.js'></script>
                          
    </body>
</html>