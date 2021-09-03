<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Input Pegawai</h3>
    </div>
</div>
<div class="content-body">
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Tabel Pegawai</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right add_pegawai"><i class="fa fa-plus"></i>&nbsp; Tambah Pegawai</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-sm table-hover" id="table_pegawai">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 30%;">Nama / NIP</th>
                                <th style="width: 15%;">Bidang</th>
                                <th style="width: 15%;">Jabatan</th>
                                <th style="width: 5%;">Jenis Kelamin</th>
                                <th style="width: 10%;">Status Login</th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Pegawai -->
<div class="modal fade text-left" id="modalPegawai" tabindex="-1" role="dialog" aria-labelledby="modalPegawai" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" id="form_add_pegawai">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalPegawai"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai">
                                <small><span class="text-danger" id="error_nama_pegawai"></span></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nip">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nip" name="nip">
                                <small><span class="text-danger" id="error_nip"></span></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                <small><span class="text-danger" id="error_tempat_lahir"></span></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type='text' class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="fa fa-calendar-alt"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea type="text" class="form-control" id="alamat" name="alamat"></textarea>
                                <small><span class="text-danger" id="error_alamat"></span></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenis_jabatan">Jenis Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control" id="jenis_jabatan" name="jenis_jabatan">
                                    <option value="1">Fungsional / Pelaksana</option>
                                    <option value="2">Struktural</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hp_pegawai">HP</label>
                                <input type="text" class="form-control" id="hp_pegawai" name="hp_pegawai">
                                <small><span class="text-danger" id="error_hp_pegawai"></span></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <divl class="col-6">
                            <div class="form-group">
                                <label for="bidang">Bidang <span class="text-danger">*</span></label>
                                <select class="form-control" id="bidang" name="bidang">
                                    <option selected>Pilih Bidang...</option>
                                    <?php foreach ($bidang as $row) {
                                        echo '<option value="' . $row['id_bidang'] . '">' . $row['nama_bidang'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <small><span class="text-danger" id="error_bidang"></span></small>
                            </div>
                        </divl>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control" id="jabatan" name="jabatan">
                                    <option selected>Pilih Jabatan...</option>
                                    <?php foreach ($jabatan as $row) {
                                        echo '<option value="' . $row['id_jabatan'] . '">' . $row['nama_jabatan'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <small><span class="text-danger" id="error_jabatan"></span></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan" name="pendidikan">
                                <small><span class="text-danger" id="error_pendidikan"></span></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status_user">Status</label>
                                <select class="form-control" id="status_user" name="status_user">
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_anggaran">Punya Kegiatan / Anggaran? <span class="text-danger">*</span></label>
                        <select class="form-control" id="input_anggaran" name="input_anggaran">
                            <option value="1">Tidak</option>
                            <option value="2">Ya, Pegawai mempunyai program / kegiatan dan anggaran</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action" name="action">
                    <input type="hidden" id="id" name="id">
                    <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Login -->
<div class="modal fade text-left" id="modalAksesUser" tabindex="-1" role="dialog" aria-labelledby="modalAksesUser" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" id="form_akses_user">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalAksesUser"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_pegawai2">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_pegawai2" name="nama_pegawai2" readonly>
                        <small><span class="text-danger" id="error_nama_pegawai2"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option selected>Pilih Role...</option>
                            <?php foreach ($role as $row) {
                                echo '<option value="' . $row['id'] . '">' . $row['role'] . '</option>';
                            }
                            ?>
                        </select>
                        <small><span class="text-danger" id="error_role"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <small><span class="text-danger" id="error_username"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="password1">Password</label>
                        <input type="password" class="form-control" id="password1" name="password1">
                        <small><span class="text-danger" id="error_password1"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="password2">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password2" name="password2">
                        <small><span class="text-danger" id="error_password2"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="status_login">Status Login</label>
                        <select class="form-control" id="status_login" name="status_login">
                            <option value="1">Aktif</option>
                            <option value="2">Tidak aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action2" name="action2">
                    <input type="hidden" id="id2" name="id2">
                    <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#tanggal_lahir').datetimepicker({
            timepicker: false,
            datepicker: true,
            scrollInput: false,
            theme: 'success',
            format: 'd-m-Y',
        });
        
        // Button Add
        $('.add_pegawai').click(function() {
            $('#modalPegawai').modal('show');
            $('.titleModal').text('Tambah Data Pegawai');
            $('#menu_id').val('Pilih Menu');
            $('#action').val('add');
            $('#id').val('');
            $('#nip').val('');
            $('#nama_pegawai').val('');
            $('#tempat_lahir').val('');
            $('#tanggal_lahir').val('');
            $('#jenis_kelamin').val('1');
            $('#alamat').val('');
            $('#jenis_jabatan').val('1');
            $('#hp_pegawai').val('');
            $('#bidang').val('Pilih Bidang...');
            $('#jabatan').val('Pilih Jabatan...');
            $('#pendidikan').val('');
            $('#input_anggaran').val('1');
            $('#status_user').val(1);

            $('#error_nip').text('');
            $('#error_nama_pegawai').text('');
            $('#error_bidang').text('');
            $('#error_jabatan').text('');
        });

        // Datatables Pegawai
        dataTable = $('#table_pegawai').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>admin/tabelPegawai",
                "type": "POST",
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 6]
            }],
            autoWidth: !1
        });


        // Add Submenu
        $(document).on('submit', '#form_add_pegawai', function(event) {
            event.preventDefault();
            var nip = $('#nip').val();
            var nama_pegawai = $('#nama_pegawai').val();
            var jabatan = $('#jabatan').val();
            var bidang = $('#bidang').val();

            var error_nip = $('#error_nip').val();
            var error_nama_pegawai = $('#error_nama_pegawai').val();
            var error_jabatan = $('#error_jabatan').val();
            var error_bidang = $('#error_bidang').val();

            if ($('#nip').val() == '') {
                error_nip = 'NIP tidak boleh kosong';
                $('#error_nip').text(error_nip);
                nip = '';
            } else {
                error_nip = '';
                $('#error_nip').text(error_nip);
                nip = $('#title').val();
            }

            if ($('#nama_pegawai').val() == '') {
                error_nama_pegawai = 'Nama Pegawai tidak boleh kosong';
                $('#error_nama_pegawai').text(error_nama_pegawai);
                nama_pegawai = '';
            } else {
                error_nama_pegawai = '';
                $('#error_nama_pegawai').text(error_nama_pegawai);
                nama_pegawai = $('#nama_pegawai').val();
            }

            if ($('#jabatan').val() == 'Pilih Jabatan...') {
                error_jabatan = 'Pilih Jabatan';
                $('#error_jabatan').text(error_jabatan);
                jabatan = '';
            } else {
                error_jabatan = '';
                $('#error_jabatan').text(error_jabatan);
                jabatan = $('#jabatan').val();
            }

            if ($('#bidang').val() == 'Pilih Bidang...') {
                error_bidang = 'Pilih Bidang';
                $('#error_bidang').text(error_bidang);
                bidang = '';
            } else {
                error_bidang = '';
                $('#error_bidang').text(error_bidang);
                bidang = $('#bidang').val();
            }

            if (error_nip != '' || error_nama_pegawai != '' || error_jabatan != '' || error_bidang != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/tambahPegawai',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_add_pegawai')[0].reset();
                        $('#modalPegawai').modal('hide');
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            }
        });

        // Edit Pegawai
        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>admin/fetchSinglePegawai',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalPegawai').modal('show');
                    $('.titleModal').text('Edit Data Pegawai');
                    $('#nip').val(data.nip);
                    $('#nama_pegawai').val(data.nama_pegawai);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tanggal_lahir').val(data.tanggal_lahir);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#alamat').val(data.alamat);
                    $('#jenis_jabatan').val(data.jenis_jabatan);
                    $('#hp_pegawai').val(data.hp);
                    $('#bidang').val(data.bidang);
                    $('#jabatan').val(data.jabatan);
                    $('#pendidikan').val(data.pendidikan);
                    $('#input_anggaran').val(data.input_anggaran);
                    $('#status_user').val(data.status_user);
                    $('#action').val('edit');
                    $('#id').val(id);
                }
            });
        });

        // Akses Menu
        $(document).on('click', '.akses', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>admin/fetchSinglePegawai',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalAksesUser').modal('show');
                    $('.titleModal').text('Akses User');
                    $('#nama_pegawai2').val(data.nama_pegawai);
                    $('#action2').val('edit_akses');
                    $('#id2').val(id);
                    if (data.role == null) {
                        $('#role').val('Pilih Role...');
                        $('#action2').val('tambah_akses');
                    } else {
                        $('#role').val(data.role);
                    }
                    $('#username').val(data.username);
                    $('#status_login').val(data.is_active);

                    $('#error_username').text('');
                    $('#error_password1').text('');
                    $('#error_password2').text('');
                    $('#error_role').text('');
                }
            });
        });

        // Akses User Submit
        $(document).on('submit', '#form_akses_user', function(event) {
            event.preventDefault();
            var username = $('#username').val();
            var password1 = $('#password1').val();
            var password2 = $('#password2').val();
            var role = $('#role').val();

            var error_username = $('#error_username').val();
            var error_password1 = $('#error_password1').val();
            var error_password2 = $('#error_password2').val();
            var error_role = $('#error_role').val();

            if ($('#username').val() == '') {
                error_username = 'Username tidak boleh kosong';
                $('#error_username').text(error_username);
                username = '';
            } else {
                error_username = '';
                $('#error_username').text(error_username);
                username = $('#title').val();
            }

            if ($('#password1').val() == '') {
                error_password1 = 'Password tidak boleh kosong';
                $('#error_password1').text(error_password1);
                password1 = '';
            } else {
                error_password1 = '';
                $('#error_password1').text(error_password1);
                password1 = $('#password1').val();
            }

            if ($('#password2').val() == '') {
                error_password2 = 'Konfirmasi password tidak boleh kosong';
                $('#error_password2').text(error_password2);
                password2 = '';
            } else {
                error_password2 = '';
                $('#error_password2').text(error_password2);
                password2 = $('#password2').val();
            }

            if ($('#role').val() == 'Pilih Role...') {
                error_role = 'Pilih Role User';
                $('#error_role').text(error_role);
                role = '';
            } else {
                error_role = '';
                $('#error_role').text(error_role);
                role = $('#role').val();
            }

            if (error_username != '' || error_password1 != '' || error_password2 != '' || error_role != '') {
                alert("Data Belum Lengkap!");
            } else if (password1 != password2) {
                alert("Konfirmasi Password yang anda inputkan tidak sama!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/aksesUSerLogin',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_akses_user')[0].reset();
                        $('#modalAksesUser').modal('hide');
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            }
        });
    });
    // End Document Ready
</script>