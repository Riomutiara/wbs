<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Input Program</h3>
    </div>
</div>
<div class="content-body">
    <!-- Description -->
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">TABEL PROGRAM</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right add_program"><i class="fa fa-plus"></i>&nbsp; Program</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" id="id_user2" name="id_user2" value="<?= $user['id_user_detail']; ?>">
                        <table class="table table-bordered table-sm table-hover" id="tabel_program">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 10%;">Tahun</th>
                                    <th style="width: 50%;">Nama Program</th>                                    
                                    <th style="width: 30%;">Keterangan</th>                                    
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
<div class="modal fade text-left" id="modalProgram" tabindex="-1" role="dialog" aria-labelledby="modalProgram" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="form_add_program">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalProgram"></h4>
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
                        <label for="program">Nama Program</label>
                        <textarea class="form-control" id="program" name="program" rows="3" placeholder="Uraian..."></textarea>
                        <small><span class="text-danger" id="error_program"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="ket_program">Keterangan</label>
                        <input type="input" name="ket_program" id="ket_program" class="form-control">
                        <small><span class="text-danger" id="error_ket_program"></span></small>
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
        // Button Add program
        $('.add_program').click(function() {
            $('#modalProgram').modal('show');
            $('.titleModal').text('Input Program');
            $('#action').val('add');
            $('#tahun').val('Pilih Tahun');
            $('#program').val('');
            $('#error_tahun').text('');
            $('#error_program').text('');
        });

        // Datatables program
        dataTable = $('#tabel_program').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelProgram",
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
        $(document).on('submit', '#form_add_program', function(event) {
            event.preventDefault();
            var tahun = $('#tahun').val();
            var program = $('#program').val();
            var ket_program = $('#ket_program').val();
            var error_tahun = $('#error_tahun').val();
            var error_program = $('#error_program').val();
            var error_ket_program = $('#error_ket_program').val();

            if ($('#tahun').val() == 'Pilih Tahun') {
                error_tahun = 'Pilih Tahun';
                $('#error_tahun').text(error_tahun);
                tahun = '';
            } else {
                error_tahun = '';
                $('#error_tahun').text(error_tahun);
                tahun = $('#tahun').val();
            }

            if ($('#program').val() == '') {
                error_program = 'Nama Program tidak boleh kosong';
                $('#error_program').text(error_program);
                program = '';
            } else {
                error_program = '';
                $('#error_program').text(error_program);
                program = $('#program').val();
            }

            if ($('#ket_program').val() == '') {
                error_ket_program = 'Nama ket_program tidak boleh kosong';
                $('#error_ket_program').text(error_ket_program);
                ket_program = '';
            } else {
                error_ket_program = '';
                $('#error_ket_program').text(error_ket_program);
                ket_program = $('#ket_program').val();
            }
            

            if (error_tahun != '' || error_program != '' || error_ket_program != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/tambahProgram',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_add_program')[0].reset();
                        $('#modalProgram').modal('hide');
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            }
        });
    });
    // End Document Ready
</script>