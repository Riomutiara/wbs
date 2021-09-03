<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Buat Perjanjian Kinerja</h3>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <!-- Description -->
            <section id="description" class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <label for="tahun">Tahun</label>
                            <select class="form-control" id="tahun" name="tahun">
                                <option selected>Pilih Tahun</option>
                                <?php foreach ($tahun as $row) {
                                    echo '<option value="' . $row['tahun_id'] . '">' . $row['nama_tahun'] . '</option>';
                                }
                                ?>
                            </select>
                            <small><span class="text-danger" id="error_tahun"></span></small>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <label for="atasan">Atasan Langsung</label>
                            <select class="form-control select2" id="atasan" name="atasan" data-live-search="true">
                                <option selected>Pilih Atasan...</option>
                                <?php
                                $queryJabatan = "SELECT * FROM user_details
                                                JOIN jabatan ON jabatan.id_jabatan = user_details.id_jabatan";
                                $Jabatan = $this->db->query($queryJabatan)->result_array();
                                ?>
                                <?php foreach ($Jabatan as $row) {
                                    echo '<option value="' . $row['id_user_details'] . '">' . $row['nama_pegawai'] . ' / ' . $row['nama_jabatan'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <a href="#" class="btn btn-primary print_pk float-right" data-toggle="tooltip" title="Print"> <i class="ft-printer fa-lg"></i> </a>
                        </div>
                    </div>

                </div>
            </section>
            <!-- A -->
            <section id="description" class="card">
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-top-border no-hover-bg">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#home1" aria-controls="home1" aria-expanded="true"><b>FORM INPUT PERJANJIAN KINERJA (PK)</b></a>
                            </li>
                            <?php
                            $id_user = $this->session->userdata('id_user_detail');

                            $queryUser = ("SELECT * FROM user_details
                                WHERE id_user_details = $id_user");
                            $hasil = $this->db->query($queryUser)->result_array();
                            ?>
                            <?php foreach ($hasil as $row) : ?>
                                <?php if ($row['input_anggaran'] == 2) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#profile1" aria-controls="profile1" aria-expanded="false"><b>FORM INPUT PROGRAM DAN KEGIATAN</b></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>



                        <!-- Tab Perjanjian Kinerja -->
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane active in" id="home1" aria-labelledby="home-tab1" aria-expanded="true">
                                <div class="card-header">
                                    <div class="row float-right">
                                        <div class="form-group mr-1">
                                            <a href="<?= base_url(); ?>user/inputSasaran" class="float-right" data-toggle="tooltip" title="Tambah Sasaran"> <i class="ft-edit fa-lg"></i>&nbsp; Tambah Sasaran </a>
                                        </div>
                                        <div class="form-group mr-2">
                                            <a href="<?= base_url(); ?>user/inputIndikator" class="float-right" data-toggle="tooltip" title="Tambah Indikator"> <i class="ft-edit fa-lg"></i>&nbsp; Tambah Indikator </a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="card-body">
                                    <form method="post" id="form_buat_perjanjian">
                                        <input type="hidden" name="user_id" id="user_id" value="<?= $user['id_user_detail']; ?>">
                                        <input type="hidden" name="tahun_id" id="tahun_id">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="sasaran">Sasaran Strategis</label>
                                                    <select class="custom-select block" id="sasaran" name="sasaran">
                                                        <option selected>Pilih Sasaran</option>
                                                        <?php
                                                        $id_user = $user['id_user_detail'];
                                                        $querySasaran = "SELECT * FROM sasaran WHERE sasaran.id_user_detail = $id_user";
                                                        $Sasaran = $this->db->query($querySasaran)->result_array();
                                                        ?>
                                                        <?php foreach ($Sasaran as $row) {
                                                            echo '<option value="' . $row['id_sasaran'] . '">' . $row['nama_sasaran'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <small><span class="text-danger" id="error_sasaran"></span></small>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="indikator">Indikator Kinerja</label>
                                                    <select class="custom-select block" id="indikator" name="indikator">
                                                        <option selected>Pilih Indikator</option>
                                                        <?php
                                                        $id_user = $user['id_user_detail'];
                                                        $queryIndikator = "SELECT * FROM indikator WHERE indikator.id_user_detail = $id_user";
                                                        $Indikator = $this->db->query($queryIndikator)->result_array();
                                                        ?>
                                                        <?php foreach ($Indikator as $row) {
                                                            echo '<option value="' . $row['id_indikator'] . '">' . $row['nama_indikator'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <small><span class="text-danger" id="error_indikator"></span></small>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="target">Target</label>
                                                    <input type="text" class="form-control" id="target" name="target" placeholder="Wajib diisi dengna angka atau huruf...">
                                                    <small><span class="text-danger" id="error_target"></span></small>
                                                    <small><span class="text-danger">* target wajib diisi berupa ANGKA atau HURUF / tidak boleh menggunakan simbol seperti %, <,> dan =</span></small>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <input type="hidden" name="action" id="action" value="add">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card-footer">
                                        <input type="hidden" id="tahun_2" name="tahun_2" value="Pilih Tahun">
                                        <input type="hidden" id="user_id_2" name="user_id_2" value="<?= $user['id_user_detail']; ?>">
                                        <input type="hidden" id="user_id_3" name="user_id_3" value="Pilih Atasan...">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm table-hover" id="tabel_pk">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%;">No</th>
                                                                <th style="width: 42%;">Sasaran Strategis</th>
                                                                <th style="width: 43%;">Indikator Kinerja</th>
                                                                <th style="width: 5%;">Target</th>
                                                                <th style="width: 5%;"></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>







                            <!-- Tab Kegiatan -->
                            <div class="tab-pane" id="profile1" role="tabpanel" aria-labelledby="profile-tab1" aria-expanded="false">
                                <div class="card-header">
                                    <div class="row float-right">
                                        <div class="form-group mr-1">
                                            <a href="<?= base_url(); ?>user/inputProgram" class="float-right" data-toggle="tooltip" title="Tambah Program"> <i class="ft-edit fa-lg"></i>&nbsp; Tambah Program </a>
                                        </div>
                                        <div class="form-group mr-2">
                                            <a href="<?= base_url(); ?>user/inputKegiatan" class="float-right" data-toggle="tooltip" title="Tambah Kegiatan"> <i class="ft-edit fa-lg"></i>&nbsp; Tambah Kegiatan </a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="card-body">
                                    <form method="post" id="form_program_kegiatan">
                                        <input type="hidden" name="user_id2" id="user_id2" value="<?= $user['id_user_detail']; ?>">
                                        <input type="hidden" name="tahun_id2" id="tahun_id2">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="program">Nama Program</label>
                                                    <select class="custom-select block" id="program" name="program">
                                                        <option selected>Pilih Program</option>
                                                        <?php
                                                        $id_user = $user['id_user_detail'];
                                                        $queryProgram = "SELECT * FROM program WHERE program.id_user_detail = $id_user";
                                                        $Program = $this->db->query($queryProgram)->result_array();
                                                        ?>
                                                        <?php foreach ($Program as $row) {
                                                            echo '<option value="' . $row['id_program'] . '">' . $row['nama_program'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <small><span class="text-danger" id="error_program"></span></small>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="kegiatan">Nama Kegiatan</label>
                                                    <select class="custom-select block" id="kegiatan" name="kegiatan">
                                                        <option selected>Pilih Kegiatan</option>
                                                        <?php
                                                        $id_user = $user['id_user_detail'];
                                                        $queryKegiatan = "SELECT * FROM kegiatan WHERE kegiatan.id_user_detail = $id_user";
                                                        $Kegiatan = $this->db->query($queryKegiatan)->result_array();
                                                        ?>
                                                        <?php foreach ($Kegiatan as $row) {
                                                            echo '<option value="' . $row['id_kegiatan'] . '">' . $row['nama_kegiatan'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <small><span class="text-danger" id="error_kegiatan"></span></small>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="anggaran">Anggaran (Rp.)</label>
                                                    <input type="number" class="form-control" id="anggaran" name="anggaran">
                                                    <small><span class="text-danger" id="error_anggaran"></span></small>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <input type="hidden" name="action2" id="action2" value="add">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card-footer">
                                        <input type="hidden" id="tahun_3" name="tahun_3" value="Pilih Tahun">
                                        <input type="hidden" id="user_id_4" name="user_id_4" value="<?= $user['id_user_detail']; ?>">
                                        <input type="hidden" id="user_id_5" name="user_id_5" value="Pilih Atasan...">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm table-hover" id="tabel_program">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%;">No</th>
                                                                <th style="width: 42%;">Nama Program</th>
                                                                <th style="width: 43%;">Kegiatan</th>
                                                                <th style="width: 5%;">Anggaran</th>
                                                                <th style="width: 5%;"></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Description -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade text-left" id="modalPrintPK" tabindex="-1" role="dialog" aria-labelledby="modalPrintPK" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title titleModal" id="modalPrintPK"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="tahun_cetak" id="tahun_cetak">
                <input type="hidden" name="nama_atasan" id="nama_atasan">
                <input type="hidden" name="user_id10" id="user_id10">
                <div class="form-group">
                    <label for="tanggal_cetak">Tanggal Print</label>
                    <div class="input-group">
                        <input type='input' class="form-control" id="tanggal_cetak" name="tanggal_cetak" placeholder="Cari Tanggal...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="fa fa-calendar-alt"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary printPK"><i class="fa fa-check"></i>&nbsp; Cetak</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#target').on('keypress', function(event) {
            var regex = new RegExp("^[a-zA-Z0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        $('#tanggal_cetak').datetimepicker({
            timepicker: false,
            datepicker: true,
            scrollInput: false,
            theme: 'success',
            format: 'd-m-Y',
        });

        $(document).on('change', '#tahun', function() {
            var id = $('#tahun').val();

            $('#tahun_id').val(id);
            $('#tahun_id2').val(id);
            $('#tahun_2').val(id);
            dataTable.ajax.reload();

            $('#tahun_3').val(id);
            dataTable2.ajax.reload();
        });

        $(document).on('change', '#atasan', function() {
            var id = $('#atasan').val();

            $('#user_id_3').val(id);
            $('#user_id_5').val(id);
        });

        // Datatables perjanjian Kinerja        
        dataTable = $('#tabel_pk').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelPerjanjianKinerja",
                "type": "POST",
                "data": function(data) {
                    data.idTahun = $('#tahun_2').val();
                    data.idUser = $('#user_id_2').val();
                }
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 4]
            }],
            autoWidth: !1,
            language:{		         			
                search: "Indikator Kinerja :"
            },
        });

        // Datatables Program & Kegiatan        
        dataTable2 = $('#tabel_program').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelProgramKegiatan",
                "type": "POST",
                "data": function(data) {
                    data.idTahun = $('#tahun_2').val();
                    data.idUser = $('#user_id_2').val();
                }
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 4]
            }],
            autoWidth: !1,
            language:{		         			
                search: "Kegiatan :"
            },
        });


        // Add Perjanjian Kinerja
        $(document).on('submit', '#form_buat_perjanjian', function(event) {
            event.preventDefault();
            var tahun = $('#tahun').val();
            var sasaran = $('#sasaran').val();
            var indikator = $('#indikator').val();
            var target = $('#target').val();
            var error_tahun = $('#error_tahun').val();
            var error_sasaran = $('#error_sasaran').val();
            var error_indikator = $('#error_indikator').val();
            var error_target = $('#error_target').val();

            if ($('#tahun').val() == 'Pilih Tahun') {
                error_tahun = 'Pilih Tahun';
                $('#error_tahun').text(error_tahun);
                tahun = '';
            } else {
                error_tahun = '';
                $('#error_tahun').text(error_tahun);
                tahun = $('#tahun').val();
            }

            if ($('#sasaran').val() == 'Pilih Sasaran') {
                error_sasaran = 'Sasaran  tidak boleh kosong';
                $('#error_sasaran').text(error_sasaran);
                sasaran = '';
            } else {
                error_sasaran = '';
                $('#error_sasaran').text(error_sasaran);
                sasaran = $('#sasaran').val();
            }

            if ($('#indikator').val() == 'Pilih Indikator') {
                error_indikator = 'Indikator tidak boleh kosong';
                $('#error_indikator').text(error_indikator);
                indikator = '';
            } else {
                error_indikator = '';
                $('#error_indikator').text(error_indikator);
                indikator = $('#indikator').val();
            }

            if ($('#target').val() == '') {
                error_target = 'Target tidak boleh kosong';
                $('#error_target').text(error_target);
                target = '';
            } else {
                error_target = '';
                $('#error_target').text(error_target);
                target = $('#target').val();
            }

            if (error_tahun != '' || error_indikator != '' || error_sasaran != '' || error_target != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/tambahPerjanjian',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        dataTable.ajax.reload();
                        $('#form_buat_perjanjian')[0].reset();
                        $('#sasaran').val('Pilih Sasaran');
                        $('#indikator').val('Pilih Indikator');
                        $('#target').val('');
                        alert(data);
                    }
                });
            }
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');

            if (confirm('Hapus data ini??')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/hapusPerjanjianKinerja',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            }
        });

        $(document).on('click', '.delete_program', function() {
            var id = $(this).attr('id');

            if (confirm('Hapus data ini??')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/hapusProgramKegiatan',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        alert(data);
                        dataTable2.ajax.reload();
                    }
                });
            }
        });





        $(document).on('click', '.print_pk', function() {
            var tahun_id = $('#tahun').val();
            var atasan_id = $('#atasan').val();
            var user_id = $('#user_id').val();

            $('#modalPrintPK').modal('show');
            $('.titleModal').text('Print PK');
            $('#tahun_cetak').val(tahun_id);
            $('#nama_atasan').val(atasan_id);
            $('#user_id10').val(user_id);

        });

        $(document).on('click', '.printPK', function() {
            var tahun_id = $('#tahun').val();
            var atasan_id = $('#atasan').val();
            var user_id = $('#user_id').val();
            var tanggal = $('#tanggal_cetak').val();

            if (tahun_id == 'Pilih Tahun') {
                alert('Pilih Tahun Perjanjian Kinerja!');
            } else if (atasan_id == 'Pilih Atasan...') {
                alert('Pilih Atasan langsung anda!');
            } else {
                window.open('<?php echo base_url('user/printPK/'); ?>' + tahun_id + '/' + user_id + '/' + atasan_id + '/' + tanggal);
                $('#modalPrintPK').modal('hide');
                $('#tanggal_cetak').val('');
            }
        });













        // Add Program & Kegiatan
        $(document).on('submit', '#form_program_kegiatan', function(event) {
            event.preventDefault();
            var tahun = $('#tahun').val();
            var program = $('#program').val();
            var kegiatan = $('#kegiatan').val();
            var anggaran = $('#anggaran').val();
            var error_tahun = $('#error_tahun').val();
            var error_program = $('#error_program').val();
            var error_kegiatan = $('#error_kegiatan').val();
            var error_anggaran = $('#error_anggaran').val();

            if ($('#tahun').val() == 'Pilih Tahun') {
                error_tahun = 'Pilih Tahun';
                $('#error_tahun').text(error_tahun);
                tahun = '';
            } else {
                error_tahun = '';
                $('#error_tahun').text(error_tahun);
                tahun = $('#tahun').val();
            }

            if ($('#program').val() == 'Pilih Program') {
                error_program = 'Program  tidak boleh kosong';
                $('#error_program').text(error_program);
                program = '';
            } else {
                error_program = '';
                $('#error_program').text(error_program);
                program = $('#program').val();
            }

            if ($('#kegiatan').val() == 'Pilih Kegiatan') {
                error_kegiatan = 'Kegiatan tidak boleh kosong';
                $('#error_kegiatan').text(error_kegiatan);
                kegiatan = '';
            } else {
                error_kegiatan = '';
                $('#error_kegiatan').text(error_kegiatan);
                kegiatan = $('#kegiatan').val();
            }

            if ($('#anggaran').val() == '') {
                error_anggaran = 'Anggaran tidak boleh kosong';
                $('#error_anggaran').text(error_anggaran);
                anggaran = '';
            } else {
                error_anggaran = '';
                $('#error_anggaran').text(error_anggaran);
                anggaran = $('#anggaran').val();
            }

            if (error_tahun != '' || error_program != '' || error_kegiatan != '' || error_anggaran != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/tambahProgram2',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        dataTable2.ajax.reload();
                        $('#form_buat_perjanjian')[0].reset();
                        $('#program').val('Pilih Program');
                        $('#kegiatan').val('Pilih Kegiatan');
                        $('#anggaran').val('');
                        alert(data);
                    }
                });
            }
        });
    });
    // End Document Ready
</script>