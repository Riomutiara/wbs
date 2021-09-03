<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Input Jabatan</h3>
    </div>
</div>
<div class="content-body">
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Tabel Jabatan</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right input_jabatan"><i class="fa fa-plus"></i>&nbsp; Tambah Jabatan</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-sm table-hover" id="tabel_jabatan">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 80%;">Nama Jabatan</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Pegawai -->
<div class="modal fade text-left" id="modalJabatan" tabindex="-1" role="dialog" aria-labelledby="modalJabatan" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" id="form_input_jabatan">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalJabatan"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan">
                        <small><span class="text-danger" id="error_nama_jabatan"></span></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // TOMBOL TAMBAH
        $('.input_jabatan').click(function() {
            $('#modalJabatan').modal('show');
            $('.titleModal').text('Tambah Data Jabatan');
            $('#nama_jabatan').val('');
            $('#error_nama_jabatan').text('');
        });

        // DATATABLE JABATAN
        dataTable = $('#tabel_jabatan').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>admin/tabelJabatan",
                "type": "POST",
            },
            columnDefs: [{
                orderable: false,
                targets: [0]
            }],
            autoWidth: !1
        });


        // TAMBAH JABATAN
        $(document).on('submit', '#form_input_jabatan', function(event) {
            event.preventDefault();
            var nama_jabatan = $('#nama_jabatan').val();
            var error_nama_jabatan = $('#error_nama_jabatan').val();

            if ($('#nama_jabatan').val() == '') {
                error_nama_jabatan = 'Nama Jabatan tidak boleh kosong';
                $('#error_nama_jabatan').text(error_nama_jabatan);
                nama_jabatan = '';
            } else {
                error_nama_jabatan = '';
                $('#error_nama_jabatan').text(error_nama_jabatan);
                nama_jabatan = $('#title').val();
            }

            if (error_nama_jabatan != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/tambahJabatan',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_input_jabatan')[0].reset();
                        $('#modalJabatan').modal('hide');
                        dataTable.ajax.reload();
                        alert(data);
                    }
                });
            }
        });

        // DELETE JABATAN
        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');

            if (confirm('Hapus Jabatan ini??')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/hapusJabatan',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        dataTable.ajax.reload();
                        alert(data);
                    }
                });
            }
        });
    });
    // End Document Ready
</script>