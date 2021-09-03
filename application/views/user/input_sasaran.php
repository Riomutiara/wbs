<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Input Sasaran</h3>
    </div>
</div>
<div class="content-body">
    <!-- Description -->
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">TABEL SASARAN STRATEGIS</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right add_sasaran"><i class="fa fa-plus"></i>&nbsp; Sasaran Strategis</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="id_user2" name="id_user2" value="<?= $user['id_user_detail']; ?>">
                        <table class="table table-bordered table-sm table-hover" id="tabel_sasaran">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 10%;">Tahun</th>
                                    <th style="width: 75%;">Sasaran Strategis</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Description -->
</div>

<!-- Modal -->
<div class="modal fade text-left" id="modalSasaran" tabindex="-1" role="dialog" aria-labelledby="modalSasaran" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="form_add_sasaran">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalSasaran"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user_detail']; ?>">
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
                    <div class="form-group">
                        <label for="sasaran">Sasaran Kinerja</label>
                        <textarea class="form-control" id="sasaran" name="sasaran" rows="3" placeholder="Uraian..."></textarea>
                        <small><span class="text-danger" id="error_sasaran"></span></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action" name="action">
                    <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Button Add Sasaran
        $('.add_sasaran').click(function() {
            $('#modalSasaran').modal('show');
            $('.titleModal').text('Input Sasaran Strategis');
            $('#action').val('add');
            $('#tahun').val('Pilih Tahun');
            $('#sasaran').val('');
            $('#error_tahun').text('');
            $('#error_sasaran').text('');
        });

        // Datatables Sasaran
        dataTable = $('#tabel_sasaran').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelSasaran",
                "type": "POST",
                "data": function(data) {
                    data.idUser = $('#id_user2').val();
                }
            },
            columnDefs: [{
                orderable: false,
                targets: [0]
            }],
            autoWidth: !1
        });


        // Add Sasaran
        $(document).on('submit', '#form_add_sasaran', function(event) {
            event.preventDefault();
            var tahun = $('#tahun').val();
            var sasaran = $('#sasaran').val();
            var error_tahun = $('#error_tahun').val();
            var error_sasaran = $('#error_sasaran').val();

            if ($('#tahun').val() == 'Pilih Tahun') {
                error_tahun = 'Pilih Tahun';
                $('#error_tahun').text(error_tahun);
                tahun = '';
            } else {
                error_tahun = '';
                $('#error_tahun').text(error_tahun);
                tahun = $('#tahun').val();
            }

            if ($('#sasaran').val() == '') {
                error_sasaran = 'Sasaran tidak boleh kosong';
                $('#error_sasaran').text(error_sasaran);
                sasaran = '';
            } else {
                error_sasaran = '';
                $('#error_sasaran').text(error_sasaran);
                sasaran = $('#sasaran').val();
            }

            if (error_tahun != '' || error_sasaran != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/tambahSasaran',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_add_sasaran')[0].reset();
                        $('#modalSasaran').modal('hide');
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            }
        });
    });
    // End Document Ready
</script>