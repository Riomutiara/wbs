<style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg th {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
    }

    .tg .tg-1wig {
        font-weight: bold;
        text-align: left;
        vertical-align: top
    }

    .tg .tg-7btt {
        border-color: inherit;
        font-weight: bold;
        text-align: center;
        vertical-align: top
    }

    .tg .tg-fymr {
        border-color: inherit;
        font-weight: bold;
        text-align: left;
        vertical-align: top
    }

    .tg .tg-0pky {
        border-color: inherit;
        text-align: left;
        vertical-align: top
    }

    .tg .tg-0lax {
        text-align: left;
        vertical-align: top
    }
</style>

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Input Pengukuran Kinerja</h3>
    </div>
</div>
<div class="content-body">
    <!-- Description -->
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title"></h4>
                </div>
                <div class="col-sm-6 col-md-6">
                    <a href="#" class="print_pengukuran_kinerja float-right" data-toggle="tooltip" title="Print"> <i class="ft-printer fa-lg"></i> </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <input type="hidden" id="id_user_detail" name="id_user_detail" value="<?= $user['id_user_detail']; ?>">
                <div class="col-sm-10 col-md-5">
                    <select class="form-control" id="tahun" name="tahun">
                        <option selected>Pilih Tahun...</option>
                        <?php foreach ($tahun as $row) {
                            echo '<option value="' . $row['tahun_id'] . '">' . $row['nama_tahun'] . '</option>';
                        }
                        ?>
                        <input type="hidden" id="tahun_id" name="tahun_id" value="Pilih Tahun...">
                    </select>
                </div>
                <div class="col-sm-10 col-md-5">
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
                        <input type="hidden" id="atasan_id" name="atasan_id" value="Pilih Atasan...">
                    </select>
                </div>
            </div>
        </div>

        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3><i class="ft-calendar text-primary mr-1"></i>Tabel Perjanjian Kinerja (PK)</h3>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-hover" id="tabel_pengukuran">
                                <thead>
                                    <tr>
                                        <th class="tg-7btt" rowspan="2">NO</th>
                                        <th class="tg-7btt" rowspan="2">SASARAN STRATEGIS</th>
                                        <th class="tg-7btt" rowspan="2">INDIKATOR KINERJA</th>
                                        <th class="tg-fymr" rowspan="2">TARGET</th>
                                        <th class="tg-7btt text-center" colspan="3">TRIWULAN I</th>
                                        <th class="tg-7btt text-center" colspan="3">TRIWULAN II</th>
                                        <th class="tg-7btt text-center" colspan="3">TRIWULAN III</th>
                                        <th class="tg-7btt text-center" colspan="3">TRIWULAN IV</th>
                                    </tr>
                                    <tr>
                                        <td class="tg-fymr">REALISASI</td>
                                        <td class="tg-fymr">PENCAPAIAN</td>
                                        <td class="tg-1wig">AKSI</td>
                                        <td class="tg-fymr">REALISASI</td>
                                        <td class="tg-fymr">PENCAPAIAN</td>
                                        <td class="tg-1wig">AKSI</td>
                                        <td class="tg-fymr">REALISASI</td>
                                        <td class="tg-fymr">PENCAPAIAN</td>
                                        <td class="tg-1wig">AKSI</td>
                                        <td class="tg-fymr">REALISASI</td>
                                        <td class="tg-fymr">PENCAPAIAN</td>
                                        <td class="tg-1wig">AKSI</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <?php
                $user_id = $this->session->userdata('id_user_detail');

                $queryUser = "SELECT * FROM user_details
                                WHERE id_user_details = $user_id
                                AND input_anggaran = 2";
                $User = $this->db->query($queryUser)->row_array();
                ?>
                <?php if ($User) : ?>
                    <div class="row">
                        <div class="col-12">
                            <h3><i class="ft-calendar text-primary mr-1"></i>Tabel Kegiatan & Anggaran</h3>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover" id="tabel_program_kegiatan">
                                    <thead>
                                        <tr>
                                            <th class="tg-7btt" rowspan="2">NO</th>
                                            <th class="tg-7btt" rowspan="2">PROGRAM</th>
                                            <th class="tg-7btt" rowspan="2">KEGIATAN</th>
                                            <th class="tg-fymr" rowspan="2">ANGGARAN</th>
                                            <th class="tg-fymr" rowspan="2">KETERANGAN</th>
                                            <th class="tg-7btt text-center" colspan="3">TRIWULAN I</th>
                                            <th class="tg-7btt text-center" colspan="3">TRIWULAN II</th>
                                            <th class="tg-7btt text-center" colspan="3">TRIWULAN III</th>
                                            <th class="tg-7btt text-center" colspan="3">TRIWULAN IV</th>
                                        </tr>
                                        <tr>
                                            <td class="tg-fymr">REALISASI</td>
                                            <td class="tg-fymr">PENCAPAIAN</td>
                                            <td class="tg-1wig">AKSI</td>
                                            <td class="tg-fymr">REALISASI</td>
                                            <td class="tg-fymr">PENCAPAIAN</td>
                                            <td class="tg-1wig">AKSI</td>
                                            <td class="tg-fymr">REALISASI</td>
                                            <td class="tg-fymr">PENCAPAIAN</td>
                                            <td class="tg-1wig">AKSI</td>
                                            <td class="tg-fymr">REALISASI</td>
                                            <td class="tg-fymr">PENCAPAIAN</td>
                                            <td class="tg-1wig">AKSI</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!--/ Description -->
</div>

<!-- Modal TW 1-->
<div class="modal fade text-left" id="modalRealisasi" tabindex="-1" role="dialog" aria-labelledby="modalRealisasi" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" id="form_input_realisasi">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalRealisasi"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>
                            <i id="text_1"></i> <br>
                            <strong id="sasaran"></strong><br>
                            <i id="text_2"></i> <br>
                            <strong id="indikator"></strong>
                        </p>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="target">Target</label>
                        <input type="text" class="form-control" id="target" name="target" readonly>
                        <small><span class="text-danger" id="error_target"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="realisasi">Realisasi</label>
                        <input type="text" class="form-control" id="realisasi" name="realisasi">
                        <small><span class="text-danger" id="error_realisasi"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="pencapaian">Pencapaian</label>
                        <input type="text" class="form-control" id="pencapaian" name="pencapaian">
                        <small><span class="text-danger" id="error_pencapaian"></span></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_triwulan" name="id_triwulan">
                    <input type="hidden" id="id_perjanjian" name="id_perjanjian">
                    <input type="hidden" id="action" name="action">
                    <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal print -->
<div class="modal fade text-left" id="modalTw" tabindex="-1" role="dialog" aria-labelledby="modalTw" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title titleModal" id="modalTw"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control" id="triwulan_cetak" name="triwulan_cetak">
                        <option selected>Pilih Triwulan...</option>
                        <option value="I">Triwulan 1</option>
                        <option value="II">Triwulan 2</option>
                        <option value="III">Triwulan 3</option>
                        <option value="IV">Triwulan 4</option>
                        <input type="hidden" id="triwulan_id" name="triwulan_id">
                    </select>
                </div>
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
                <button type="button" class="btn btn-primary cetak_triwulan"><i class="fa fa-check"></i>&nbsp; Cetak</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
            $('#th').val(id);
            dataTable.ajax.reload();
            dataTable2.ajax.reload();
        });

        $(document).on('change', '#triwulan', function() {
            var id = $('#triwulan').val();

            $('#triwulan_tb').val(id);
        });

        // Datatables Sasaran n Indikator
        dataTable = $('#tabel_pengukuran').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelPengukuranKinerja",
                "type": "POST",
                "data": function(data) {
                    data.idTahun = $('#tahun_id').val();
                    data.idUser = $('#id_user_detail').val();
                    // data.idTriwulan = $('#triwulan').val();
                }
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
            }],
            autoWidth: !1,
            language:{		         			
                search: "Indikator Kinerja :"
            },
        });

        // Datatables Program n Kegiatan
        dataTable2 = $('#tabel_program_kegiatan').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelInputProgramKegiatan",
                "type": "POST",
                "data": function(data) {
                    data.idTahun = $('#tahun_id').val();
                    data.idUser = $('#id_user_detail').val();
                    // data.idTriwulan = $('#triwulan').val();
                }
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
            }],
            autoWidth: !1,
            language:{		         			
                search: "Kegiatan :"
            },
        });

        // INPUT REALISASI
        $(document).on('submit', '#form_input_realisasi', function(event) {
            event.preventDefault();
            var triwulan = $('#triwulan').val();
            var realisasi = $('#realisasi').val();
            var pencapaian = $('#pencapaian').val();
            var error_triwulan = $('#error_triwulan').val();
            var error_realisasi = $('#error_realisasi').val();
            var error_pencapaian = $('#error_pencapaian').val();

            if ($('#triwulan').val() == 'Pilih Triwulan...') {
                error_triwulan = 'Pilih Triwulan';
                $('#error_triwulan').text(error_triwulan);
                triwulan = '';
            } else {
                error_triwulan = '';
                $('#error_triwulan').text(error_triwulan);
                triwulan = $('#triwulan').val();
            }

            if ($('#realisasi').val() == '') {
                error_realisasi = 'Realisasi tidak boleh kosong';
                $('#error_realisasi').text(error_realisasi);
                realisasi = '';
            } else {
                error_realisasi = '';
                $('#error_realisasi').text(error_realisasi);
                realisasi = $('#realisasi').val();
            }

            if ($('#pencapaian').val() == '') {
                error_pencapaian = 'Pencapaian tidak boleh kosong';
                $('#error_pencapaian').text(error_pencapaian);
                pencapaian = '';
            } else {
                error_pencapaian = '';
                $('#error_pencapaian').text(error_pencapaian);
                pencapaian = $('#pencapaian').val();
            }

            if (error_triwulan != '' || error_realisasi != '' || error_pencapaian != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/inputRealisasiDanAnggaran',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_input_realisasi')[0].reset();
                        $('#modalRealisasi').modal('hide');
                        alert(data);
                        dataTable.ajax.reload();
                        dataTable2.ajax.reload();
                    }
                });
            }
        });

        $(document).on('change', '#realisasi', function() {
            var a = $('#target').val();
            var b = $('#realisasi').val();

            var hasil = (b / a) * 100;
            $('#pencapaian').val(hasil.toFixed(2));
        });


        // INPUT REALISASI TRIWULAN
        $(document).on('click', '.realisasi1', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN I');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi1);
                    $('#pencapaian').val(data.pencapaian1);
                    $('#id_triwulan').val(1);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add');
                }
            });
        });

        $(document).on('click', '.realisasi2', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN II');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi2);
                    $('#pencapaian').val(data.pencapaian2);
                    $('#id_triwulan').val(2);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add');
                }
            });
        });
        $(document).on('click', '.realisasi3', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN III');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi3);
                    $('#pencapaian').val(data.pencapaian3);
                    $('#id_triwulan').val(3);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add');
                }
            });
        });
        $(document).on('click', '.realisasi4', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN IV');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi4);
                    $('#pencapaian').val(data.pencapaian4);
                    $('#id_triwulan').val(4);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add');
                }
            });
        });

        // INPUT REALISASI TRIWULAN / KEGIATAN DAN ANGGARAN
        $(document).on('click', '.realisasi_kegiatan1', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN I');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);
                    $('#realisasi').val(data.realisasi1);
                    $('#pencapaian').val(data.pencapaian1);
                    $('#id_triwulan').val(1);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add_anggaran');
                }
            });
        });

        $(document).on('click', '.realisasi_kegiatan2', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN II');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);
                    $('#realisasi').val(data.realisasi2);
                    $('#pencapaian').val(data.pencapaian2);
                    $('#id_triwulan').val(2);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add_anggaran');
                }
            });
        });
        $(document).on('click', '.realisasi_kegiatan3', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN III');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);
                    $('#realisasi').val(data.realisasi3);
                    $('#pencapaian').val(data.pencapaian3);
                    $('#id_triwulan').val(3);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add_anggaran');
                }
            });
        });
        $(document).on('click', '.realisasi_kegiatan4', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN IV');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);
                    $('#realisasi').val(data.realisasi4);
                    $('#pencapaian').val(data.pencapaian4);
                    $('#id_triwulan').val(4);
                    $('#id_perjanjian').val(id);
                    $('#action').val('add_anggaran');
                }
            });
        });






        // EDIT REALISASI TRIWULAN SASARAN & INDIKATOR
        $(document).on('click', '.edit_realisasi1', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN I');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi1);
                    $('#pencapaian').val(data.pencapaian1);
                    $('#id_triwulan').val(1);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit');
                }
            });
        });
        $(document).on('click', '.edit_realisasi2', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN II');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi2);
                    $('#pencapaian').val(data.pencapaian2);
                    $('#id_triwulan').val(2);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit');
                }
            });
        });
        $(document).on('click', '.edit_realisasi3', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN III');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi3);
                    $('#pencapaian').val(data.pencapaian3);
                    $('#id_triwulan').val(3);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit');
                }
            });
        });
        $(document).on('click', '.edit_realisasi4', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSinglePengukuran',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN IV');
                    $('#text_1').text('Sasaran :');
                    $('#text_2').text('Indikator :');
                    $('#sasaran').text(data.sasaran);
                    $('#indikator').text(data.indikator);
                    $('#target').val(data.target);
                    $('#realisasi').val(data.realisasi4);
                    $('#pencapaian').val(data.pencapaian4);
                    $('#id_triwulan').val(4);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit');
                }
            });
        });
        // END

        // EDIT REALISASI TRIWULAN PROGRAM & KEGIATAN
        $(document).on('click', '.edit_realisasi_kegiatan1', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN I');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);                    
                    $('#realisasi').val(data.realisasi1);
                    $('#pencapaian').val(data.pencapaian1);
                    $('#id_triwulan').val(1);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit_anggaran');
                }
            });
        });
        $(document).on('click', '.edit_realisasi_kegiatan2', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN II');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);
                    $('#realisasi').val(data.realisasi2);
                    $('#pencapaian').val(data.pencapaian2);
                    $('#id_triwulan').val(2);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit_anggaran');
                }
            });
        });
        $(document).on('click', '.edit_realisasi_kegiatan3', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN III');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);
                    $('#realisasi').val(data.realisasi3);
                    $('#pencapaian').val(data.pencapaian3);
                    $('#id_triwulan').val(3);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit_anggaran');
                }
            });
        });
        $(document).on('click', '.edit_realisasi_kegiatan4', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>User/fetchSingleProgramKegiatan',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalRealisasi').modal('show');
                    $('.titleModal').text('TRIWULAN IV');
                    $('#text_1').text('Program :');
                    $('#text_2').text('Kegiatan :');
                    $('#sasaran').text(data.program);
                    $('#indikator').text(data.kegiatan);
                    $('#target').val(data.anggaran_program);
                    $('#realisasi').val(data.realisasi4);
                    $('#pencapaian').val(data.pencapaian4);
                    $('#id_triwulan').val(4);
                    $('#id_perjanjian').val(id);
                    $('#action').val('edit_anggaran');
                }
            });
        });
        // END
        
        // CETAK
        $(document).on('click', '.print_pengukuran_kinerja', function() {
            var id_user = $('#id_user_detail').val();
            var id_tahun = $('#tahun_id').val();
            var id_atasan = $('#atasan_id').val();

            if (id_tahun == 'Pilih Tahun...') {
                alert('Pilih Tahun Pengukuran Kinerja!')
            } else if (id_atasan == 'Pilih Atasan...') {
                alert('Pilih Atasan Anda!')
            } else {
                $('#modalTw').modal('show');
                $('.titleModal').text('Cetak Pengukuran Kinerja');
                $('#triwulan_id').val('Pilih Triwulan...');
                $('#user_id2').val(id_user);
                $('#tahun_id2').val(id_tahun);                
            }
        });

        $(document).on('click', '#triwulan_cetak', function() {
            var id_triwulan = $('#triwulan_cetak').val();
            $('#triwulan_id').val(id_triwulan);
        });

        $(document).on('change', '#atasan', function() {
            var id_atasan = $('#atasan').val();
            $('#atasan_id').val(id_atasan);
        });


        $(document).on('click', '.cetak_triwulan', function() {
            var id_user = $('#id_user_detail').val();
            var id_tahun = $('#tahun_id').val();
            var id_triwulan = $('#triwulan_id').val();
            var id_atasan = $('#atasan_id').val();
            var tanggal = $('#tanggal_cetak').val();

            if (id_triwulan == 'Pilih Triwulan...') {
                alert('Pilih triwulan yang akan dicetak!');
            } else {
                window.open('<?php echo base_url('user/printPengukuranKinerja/'); ?>' + id_user + '/' + id_tahun + '/' + id_triwulan + '/' + id_atasan + '/' + tanggal);            
                $('#modalTw').modal('hide');
                $('#triwulan_cetak').val('Pilih Triwulan...');
                $('#tanggal_cetak').val('');
            }
        });
    });
    // End Document Ready
</script>