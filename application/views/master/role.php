<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Role</h3>
    </div>
</div>
<div class="content-body">
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Tabel Role</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right add_role"><i class="fa fa-plus"></i> Tambah Role</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                
                <div class="row">
                    <table class="table table-bordered table-sm table-hover" id="table_role">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 75%;">Role</th>
                                <th style="width: 15%;"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section> 
</div>

<!-- Modal -->
<div class="modal fade text-left" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="modalRole" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" id="form_add_role">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalRole"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="role">Nama Role</label>
                    <input type="text" id="role" name="role" class="form-control">
                    <small><span class="text-danger" id="error_role"></span></small>
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
        // Button Add
        $('.add_role').click(function() {
            $('#modalRole').modal('show');
            $('#role').val('');
            $('#error_role').text('');
            $('#action').val('add');
            $('.titleModal').text('Tambah Role');
        });

        // Datatables Role
        dataTable = $('#table_role').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>master/tableRole",
                "type": "POST",
            },
            columnDefs: [{
                orderable: !1,
                targets: [0]
            }],
            autoWidth: !1
        });

        // Add Role
        $(document).on('submit', '#form_add_role', function(event) {
            event.preventDefault();
            var role = $('#role').val();
            var error_role = $('#error_role').val();

            if ($('#role').val() == '') {
                error_role = 'Nama Role tidak boleh kosong';
                $('#error_role').text(error_role);
                role = '';
            } else {
                error_role = '';
                $('#error_role').text(error_role);
                role = $('#role').val();
            }

            if (error_role != '') {
                alert("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>master/addRole',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_add_role')[0].reset();
                        $('#modalRole').modal('hide');
                        dataTable.ajax.reload();
                        toastr["success"](data);
                    }
                });
            }
        });

        // Access Role
        $(document).on('click', '.access', function() {
            var id = $(this).attr('id');

            document.location.href = "<?= base_url('master/roleAccess/'); ?>" + id;
        });

        // Delete Role
        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');

            if (confirm("Hapus data ini?")) {
                $.ajax({
                    url: '<?php echo base_url(); ?>master/deleteRole',
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
    });
</script>