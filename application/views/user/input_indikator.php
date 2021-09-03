<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Input Indikator</h3>
    </div>
</div>
<div class="content-body">
    <!-- Description -->
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">TABEL INDIKATOR KINERJA</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right add_indikator"><i class="fa fa-plus"></i>&nbsp; Indikator Kinerja</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="id_user2" name="id_user2" value="<?= $user['id_user_detail']; ?>">
                        <table class="table table-bordered table-sm table-hover" id="tabel_indikator">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 10%;">Tahun</th>
                                    <th style="width: 75%;">Indikator Kinerja</th>
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
<div class="modal fade text-left" id="modalIndikator" tabindex="-1" role="dialog" aria-labelledby="modalIndikator" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="form_add_indikator">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalIndikator"></h4>
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
                        <label for="indikator">Indikator Kinerja</label>
                        <textarea class="form-control" id="indikator" name="indikator" rows="3" placeholder="Uraian..."></textarea>
                        <small><span class="text-danger" id="error_indikator"></span></small>
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
        // Button Add indikator
        $('.add_indikator').click(function() {
            $('#modalIndikator').modal('show');
            $('.titleModal').text('Input Indikator Kinerja');
            $('#action').val('add');
            $('#tahun').val('Pilih Tahun');
            $('#indikator').val('');
            $('#error_tahun').text('');
            $('#error_indikator').text('');
        });

        // Datatables indikator
        dataTable = $('#tabel_indikator').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelIndikator",
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


        // Add indikator
        $(document).on('submit', '#form_add_indikator', function(event) {
            event.preventDefault();
            var tahun = $('#tahun').val();
            var indikator = $('#indikator').val();
            var error_tahun = $('#error_tahun').val();
            var error_indikator = $('#error_indikator').val();

            if ($('#tahun').val() == 'Pilih Tahun') {
                error_tahun = 'Pilih Tahun';
                $('#error_tahun').text(error_tahun);
                tahun = '';
            } else {
                error_tahun = '';
                $('#error_tahun').text(error_tahun);
                tahun = $('#tahun').val();
            }

            if ($('#indikator').val() == '') {
                error_indikator = 'Indikator tidak boleh kosong';
                $('#error_indikator').text(error_indikator);
                indikator = '';
            } else {
                error_indikator = '';
                $('#error_indikator').text(error_indikator);
                indikator = $('#indikator').val();
            }

            if (error_tahun != '' || error_indikator != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/tambahIndikator',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_add_indikator')[0].reset();
                        $('#modalIndikator').modal('hide');
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            }
        });
    });
    // End Document Ready
</script>