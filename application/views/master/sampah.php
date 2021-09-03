<div class="container">
    <!-- Title -->
    <div class="hk-pg-header">
        <div>
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="archive"></i></span></span>Basic Tables</h4>
        </div>
    </div>
    <!-- /Title -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <h5 class="hk-sec-title">Data Table</h5>
                <p class="mb-40">Add advanced interaction controls to HTML tables like <code>search, pagination & selectors</code>. For responsive table just add the <code>responsive: true</code> to your DataTables function. <a href="https://datatables.net/reference/option/" target="_blank">View all options</a>.</p>
                <div class="row">
                    <div class="col">
                        <div class="table-wrap">
                            <table id="table_role" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th></th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- <section class="hk-sec-wrapper">
        <div class="row">
            <div class="col-12">
                <h5 class="hk-sec-title">Data Table</h5>
                <button type="button" class="btn btn-purple add_role float-right" data-toggle="modal" data-target="#modalRole">
                    <i class="fa fa-plus mr-5"></i>Tambah Role
                </button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table id="table_role" class="table table-hover w-100 display pb-30">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>     -->
</div>





<!-- Main Container -->
<!-- <main id="main-container"> -->
<!-- Page Content -->
<!-- <div class="content">
        <h2 class="content-heading"><i class="si si-puzzle mr-5 text-muted"></i>Role Access</h2>
        <div class="block">
            <div class="block-header block-header-default">
                <div class="block-title">
                    <strong>Tabel Role</strong>
                </div>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="row mb-3">
                    <div class="col-12">
                        <button type="button" class="btn btn-alt-success add_role float-right" data-toggle="modal" data-target="#modalRole">
                            <i class="fa fa-plus mr-5"></i>Add Role
                        </button>
                    </div>
                </div>
                <table class="table table-hover table-sm table-vcenter" id="table_role">
                    <thead>
                        <tr>
                            <th style="width: 10%;">No</th>
                            <th style="width: 80%;">Role</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> -->
<!-- END Dynamic Table Full -->
<!-- </div> -->
<!-- END Page Content -->
<!-- </main> -->
<!-- END Main Container -->

<!-- Role Modal -->
<div class="modal fade" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="modalRole" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title titleModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_add_role">
                    <div class="form-group">
                        <label for="role">Nama Role</label>
                        <input type="text" class="form-control" id="role" placeholder="">
                        <small><span class="text-danger" id="error_role"></span></small>
                    </div>
                    <input type="hidden" id="action" name="action">
                    <input type="hidden" id="id" name="id">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="modalRole" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <form method="post" id="form_add_role">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-gd-aqua">
                        <h3 class="block-title titleModal"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove fa-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="role">Nama Role</label>
                                <input type="text" class="form-control" id="role" name="role">
                                <small><span class="text-danger" id="error_role"></span></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action" name="action">
                    <input type="hidden" id="id" name="id">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-alt-success">
                        <i class="fa fa-check"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- END Role Modal -->


<script>
    $(document).ready(function() {
        // Button Add
        $('.add_role').click(function() {
            $('#role').val('');
            $('#error_role').text('');
            $('#id').val('');
            $('#action').val('add');
            $('.titleModal').text('Tambah Role');
        });

        // Datatables Role
        $('#table_role').DataTable({
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
        //     $('#table_role').DataTable({
        // 	responsive: true,
        // 	autoWidth: false,
        // 	language: { search: "",
        // 	searchPlaceholder: "Search",
        // 	sLengthMenu: "_MENU_items"

        // 	}
        // });



        // Add Role
        // $(document).on('submit', '#form_add_role', function(event) {
        //     event.preventDefault();
        //     var role = $('#role').val();
        //     var error_role = $('#error_role').val();

        //     if ($('#role').val() == '') {
        //         error_role = 'Role tidak boleh kosong';
        //         $('#error_role').text(error_role);
        //         role = '';
        //     } else {
        //         error_role = '';
        //         $('#error_role').text(error_role);
        //         role = $('#role').val();
        //     }

        //     if (error_role != '') {
        //         toastr["error"]("Data Belum Lengkap!");
        //     } else {
        //         $.ajax({
        //             url: '<?php echo base_url(); ?>setting/addRole',
        //             method: 'POST',
        //             data: new FormData(this),
        //             contentType: false,
        //             processData: false,
        //             success: function(data) {
        //                 $('#form_add_role')[0].reset();
        //                 $('#modalRole').modal('hide');
        //                 dataTable.ajax.reload();
        //                 toastr["success"](data);
        //             }
        //         });
        //     }
        // });

        // // Access Role
        // $(document).on('click', '.access', function() {
        //     var id = $(this).attr('id');

        //     document.location.href = "<?= base_url('setting/roleAccess/'); ?>" + id;
        // });

        // // Edit Role
        // $(document).on('click', '.edit', function() {
        //     var id = $(this).attr('id');

        //     $.ajax({
        //         url: '<?php echo base_url(); ?>setting/fetchSingleRole',
        //         method: 'POST',
        //         data: {
        //             id: id
        //         },
        //         dataType: 'JSON',
        //         success: function(data) {
        //             $('#modalRole').modal('show');
        //             $('.titleModal').text('Edit Role Users');
        //             $('#role').val(data.role);
        //             $('#id').val(id);
        //             $('#action').val('edit');
        //         }
        //     });
        // });

        // // Delete Role
        // $(document).on('click', '.delete', function() {
        //     var id = $(this).attr('id');

        //     if (confirm("Hapus data ini?")) {
        //         $.ajax({
        //             url: '<?php echo base_url(); ?>setting/deleteRole',
        //             method: 'POST',
        //             data: {
        //                 id: id
        //             },
        //             success: function(data) {
        //                 toastr["success"](data);
        //                 dataTable.ajax.reload();
        //             }
        //         });
        //     }
        // });
    });
    // End Document Ready
</script>








