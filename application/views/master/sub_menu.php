<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Sub Menu</h3>
    </div>
</div>
<div class="content-body">
    <section id="description" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Tabel Sub Menu</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-primary float-right add_submenu"><i class="fa fa-plus"></i>&nbsp; Tambah Sub Menu</button>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-sm table-hover" id="table_submenu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Judul Sub Menu</th>
                                <th>Url</th>
                                <th>Aktif</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade text-left" id="modalSubMenu" tabindex="-1" role="dialog" aria-labelledby="modalSubMenu" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" id="form_add_submenu">
                <div class="modal-header">
                    <h4 class="modal-title titleModal" id="modalSubMenu"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="menu_id">Menu</label>
                        <select class="form-control" id="menu_id" name="menu_id">
                            <option selected>Pilih Menu</option>
                            <?php foreach ($menu as $row) {
                                echo '<option value="' . $row['id'] . '">' . $row['menu'] . '</option>';
                            }
                            ?>
                        </select>
                        <small><span class="text-danger" id="error_menu_id"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="title">Nama Sub Menu</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <small><span class="text-danger" id="error_title"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url">
                        <small><span class="text-danger" id="error_url"></span></small>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Status</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1">Aktif</option>
                            <option value="2">Tidak Aktif</option>
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



<script>
    $(document).ready(function() {
        // Button Add
        $('.add_submenu').click(function() {
            $('#modalSubMenu').modal('show');
            $('.titleModal').text('Tambah Sub Menu');
            $('#menu_id').val('Pilih Menu');
            $('#action').val('add');
            $('#title').val('');
            $('#url').val('');
            $('#is_active').val('1');
            $('#error_menu_id').text('');
            $('#error_title').text('');
            $('#error_url').text('');
        });

        // Datatables Submenu
        dataTable = $('#table_submenu').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>master/tableSubMenu",
                "type": "POST",
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 5]
            }],
            autoWidth: !1
        });


        // Add Submenu
        $(document).on('submit', '#form_add_submenu', function(event) {
            event.preventDefault();
            var menu_id = $('#menu_id').val();
            var title = $('#title').val();
            var url = $('#url').val();
            var is_active = $('#is_active').val();
            var error_menu_id = $('#error_menu_id').val();
            var error_title = $('#error_title').val();
            var error_url = $('#error_url').val();
            var error_is_active = $('#error_is_active').val();

            if ($('#menu_id').val() == 'Pilih Menu') {
                error_menu_id = 'Pilih Menu';
                $('#error_menu_id').text(error_menu_id);
                menu_id = '';
            } else {
                error_menu_id = '';
                $('#error_menu_id').text(error_menu_id);
                menu_id = $('#menu_id').val();
            }

            if ($('#title').val() == '') {
                error_title = 'Title tidak boleh kosong';
                $('#error_title').text(error_title);
                title = '';
            } else {
                error_title = '';
                $('#error_title').text(error_title);
                title = $('#title').val();
            }

            if ($('#url').val() == '') {
                error_url = 'URL tidak boleh kosong';
                $('#error_url').text(error_url);
                url = '';
            } else {
                error_url = '';
                $('#error_url').text(error_url);
                url = $('#url').val();
            }

            if (error_menu_id != '' || error_title != '' || error_url != '') {
                toastr["error"]("Data Belum Lengkap!");
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>master/addSubmenu',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_add_submenu')[0].reset();
                        $('#modalSubMenu').modal('hide');
                        alert(data);
                        dataTable.ajax.reload();
                    }
                });
            }
        });

        // Edit Submenu
        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: '<?php echo base_url(); ?>master/fetchSingleSubMenu',
                method: 'POST',
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#modalSubMenu').modal('show');
                    $('.titleModal').text('Edit Sub Menu');
                    $('#menu_id').val(data.menu_id);
                    $('#title').val(data.title);
                    $('#url').val(data.url);
                    $('#is_active').val(data.active);
                    $('#id').val(id);
                    $('#action').val('edit');
                }
            });
        });

        // Delete Submenu
        $(document).on('click', '.delete', function() {
            var id = $(this).attr('id');

            if (confirm("Hapus data ini?")) {
                $.ajax({
                    url: '<?php echo base_url(); ?>master/deleteSubMenu',
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
    // End Document Ready
</script>