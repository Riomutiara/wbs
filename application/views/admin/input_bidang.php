<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Input Bidang</h3>
    </div>
</div>
<div class="content-body">
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Tabel Bidang</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right input_bidang"><i class="fa fa-plus"></i>&nbsp; Tambah Bidang</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-sm table-hover" id="tabel_bidang">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 80%;">Nama Bidang</th>
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
<div class="modal fade text-left" id="modalBidang" tabindex="-1" role="dialog" aria-labelledby="modalBidang" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" id="form_input_bidang">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalBidang"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_bidang">Nama Bidang</label>
                        <input type="text" class="form-control" id="nama_bidang" name="nama_bidang">
                        <small><span class="text-danger" id="error_nama_bidang"></span></small>
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
        $('.input_bidang').click(function() {
            $('#modalBidang').modal('show');
            $('.titleModal').text('Tambah Data Bidang');
            $('#nama_bidang').val('');
            $('#error_nama_bidang').text('');
        });

        // DATATABLE BIDANG
        dataTable = $('#tabel_bidang').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>admin/tabelBidang",
                "type": "POST",
            },
            columnDefs: [{
                orderable: false,
                targets: [0]
            }],
            autoWidth: !1
        });


        // TAMBAH BIDANG
        $(document).on('submit', '#form_input_bidang', function(event) {
            event.preventDefault();
            var nama_bidang = $('#nama_bidang').val();
            var error_nama_bidang = $('#error_nama_bidang').val();

            if ($('#nama_bidang').val() == '') {
                error_nama_bidang = 'Nama Bidang tidak boleh kosong';
                $('#error_nama_bidang').text(error_nama_bidang);
                nama_bidang = '';
            } else {
                error_nama_bidang = '';
                $('#error_nama_bidang').text(error_nama_bidang);
                nama_bidang = $('#title').val();
            }

            if (error_nama_bidang != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/tambahBidang',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_input_bidang')[0].reset();
                        $('#modalBidang').modal('hide');
                        dataTable.ajax.reload();
                        alert(data);
                    }
                });
            }
        });

        // DELETE BIDANG
        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');

            if (confirm('Hapus Bidang ini??')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/hapusBidang',
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