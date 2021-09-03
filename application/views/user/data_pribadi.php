<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-basic">Ubah Data Pribadi</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="form-body">
                            <!-- DATA IDENTITAS DIRI -->
                            <?php
                            $id_user = $this->session->userdata('id_user_detail');
                            $queryUser = "SELECT * FROM user_details
                                                        LEFT JOIN bidang ON bidang.id_bidang = user_details.id_bidang
                                                        LEFT JOIN jabatan ON jabatan.id_jabatan = user_details.id_jabatan                                                        
                                                        WHERE id_user_details = $id_user ORDER BY bidang.nama_bidang AND jabatan.nama_jabatan ASC";
                            $User = $this->db->query($queryUser)->result_array();
                            ?>

                            <form class="form form-horizontal" method="post" id="form_ubah_data_pribadi">
                                <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user_detail']; ?>">
                                <?php foreach ($User as $row) : ?>
                                    <h4 class="form-section"><i class="ft-user"></i> Indentitas Diri</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="nama_pegawai">Nama Lengkap / NIP</label>
                                        <div class="col-md-5">
                                            <input type="text" id="nama_pegawai" name="nama_pegawai" class="form-control" placeholder="Nama Lengkap" value="<?= $row['nama_pegawai']; ?>" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" readonly value="<?= $row['nip']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="tempat_lahir">Tempat / Tanggal Lahir</label>
                                        <div class="col-md-5 col-sm-5">
                                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?= $row['tempat_lahir']; ?>">
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="input-group">
                                                <input type='text' class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= $row['tanggal_lahir']; ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <span class="fas fa-calendar-alt"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="jenis_kelamin">Jenis Kelamin</label>
                                        <div class="col-md-9">
                                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                                                <!-- <option selected value="<?= $row['jenis_kelamin']; ?>"><?= $row['jenis_kelamin']; ?></option> -->
                                                <?php if ($row['jenis_kelamin'] == 1) : ?>
                                                    <option selected value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                <?php else : ?>
                                                    <option value="1">Laki-laki</option>
                                                    <option selected value="2">Perempuan</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="alamat">Alamat Lengkap</label>
                                        <div class="col-md-9">
                                            <textarea id="alamat" name="alamat" rows="5" class="form-control" placeholder="Alamat Lengkap..."><?= $row['alamat']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="hp">No. Hp</label>
                                        <div class="col-md-9">
                                            <input type="text" id="hp" name="hp" class="form-control" placeholder="Nomor Handphone" value="<?= $row['hp']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="pendidikan">Pendidikan</label>
                                        <div class="col-md-9">
                                            <input type="text" id="pendidikan" name="pendidikan" class="form-control" placeholder="Pendidikan" value="<?= $row['pendidikan']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-actions text-right">
                                        <button type="button" class="btn btn-warning mr-1" id="reset">
                                            <i class="fa fa-undo"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check"></i> Ubah Data Pribadi
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </form>

                            <form class="form form-horizontal" method="post" id="form_ubah_data_jabatan">
                                <input type="hidden" id="id_user2" name="id_user2" value="<?= $user['id_user_detail']; ?>">
                                <!-- DATA PEKERJAAN -->
                                <h4 class="form-section"><i class="ft-clipboard"></i> Data Pekerjaan</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput5">Instansi</label>
                                    <div class="col-md-9">
                                        <input type="text" id="projectinput5" class="form-control" value="RSJ. Prof. HB. Saanin Padang" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-sm-3 label-control" for="bidang">Bidang</label>
                                    <div class="col-md-8 col-sm-6">
                                        <select id="bidang" name="bidang" class="form-control select2" data-live-search="true">
                                            <option selected value="<?= $row['id_bidang']; ?>"><?= $row['nama_bidang']; ?></option>
                                            <?php
                                            $queryBidang = "SELECT * FROM bidang";
                                            $Bidang = $this->db->query($queryBidang)->result_array();
                                            ?>
                                            <?php foreach ($Bidang as $row2) : ?>
                                                <option value="<?= $row2['id_bidang']; ?>"><?= $row2['nama_bidang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-sm-3 label-control" for="jabatan">Jabatan</label>
                                    <div class="col-md-8 col-sm-6">
                                        <select id="jabatan" name="jabatan" class="form-control select2" data-live-search="true">
                                            <option selected value="<?= $row['id_jabatan']; ?>"><?= $row['nama_jabatan']; ?></option>
                                            <?php
                                            $queryJabatan = "SELECT * FROM jabatan";
                                            $Jabatan = $this->db->query($queryJabatan)->result_array();
                                            ?>
                                            <?php foreach ($Jabatan as $row3) : ?>
                                                <option value="<?= $row3['id_jabatan']; ?>"><?= $row3['nama_jabatan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="masa_jabatan">Tmt. Masa Jabatan</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type='text' class="form-control" id="masa_jabatan" name="masa_jabatan" placeholder="Tanggal mulai masa jabatan">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <span class="fas fa-calendar-alt"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-md-3 col-sm-3 label-control" for="atasan_langsung">Atasan Langsung</label>
                                    <div class="col-md-8 col-sm-6">
                                        <select id="atasan_langsung" name="atasan_langsung" class="form-control select2" data-live-search="true">
                                            <option selected value="1">Pilih Atasan langsung Anda...</option>
                                            <?php
                                            $queryUser = "SELECT * FROM user_details JOIN jabatan ON jabatan.id_jabatan = user_details.id_jabatan";
                                            $User = $this->db->query($queryUser)->result_array();
                                            ?>
                                            <?php foreach ($User as $row4) : ?>
                                                <option value="<?= $row4['id_user_details']; ?>"><?= $row4['nama_pegawai']; ?> / <?= $row4['nama_jabatan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions text-right">
                                    <button type="button" class="btn btn-warning mr-1" id="reset">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check"></i> Ubah Data Jabatan
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#tanggal_lahir').datetimepicker({
            timepicker: false,
            datepicker: true,
            scrollInput: false,
            theme: 'success',
            format: 'd-m-Y',
        });

        $('#masa_jabatan').datetimepicker({
            timepicker: false,
            datepicker: true,
            scrollInput: false,
            theme: 'success',
            format: 'd-m-Y',
        });

        $(document).on('submit', '#form_ubah_data_pribadi', function(event) {
            event.preventDefault();

            $.ajax({
                url: '<?php echo base_url(); ?>user/updateDataPribadi',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data);
                    location.reload();
                    window.location.href = '<?= base_url('user'); ?>';
                }
            });
        });

        $(document).on('submit', '#form_ubah_data_jabatan', function(event) {
            event.preventDefault();
            var masa_jabatan = $('#masa_jabatan').val();
            var atasan_langsung = $('#atasan_langsung').val();

            if (masa_jabatan == '' || atasan_langsung == 1) {
                alert('Data belum lengkap! Input Tmt. masa jabatan atau Input Atasan langsung Anda')
            } else {
                if (confirm("Apakah Anda yakin? update data Jabatan?")) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>user/updateDataJabatan',
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            alert(data);
                            location.reload();
                            window.location.href = '<?= base_url('user'); ?>';
                        }
                    });
                }
            }

        });

        $(document).on('click', '#reset', function() {
            location.reload();
        });
    });
</script>