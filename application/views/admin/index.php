<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Dashboard Admin</h3>
    </div>
</div>
<div class="content-body">
    <!-- Description -->
    <section id="description" class="card">
        <div class="card-header">
            <h4 class="card-title">SELAMAT DATANG</h4><br>
            <h5><strong><?= $user['nama_akun']; ?></strong></h5>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="card-text">
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius odit sunt odio ratione, ullam ipsum explicabo iusto veniam, similique commodi neque tempora sint et ad. Ipsum non dignissimos veritatis rerum.
                    </p> -->
                </div>
            </div>
        </div>
    </section>
    <!--/ Description -->
    <!-- Description -->
    <section id="description" class="card">
        <div class="card-header">
            <h4 class="card-title">USULAN PERUBAHAN JABATAN</h4><br>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="card-text">
                    <div class="row">
                        <table class="table table-sm table-hover" id="tabel_usulan_jabatan">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 30%;">Nama / NIP</th>
                                    <th style="width: 20%;">Usulan Bidang Baru</th>
                                    <th style="width: 20%;">Usulan Jabatan Baru</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 15%;">Aksi</th>
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
<div class="modal fade text-left" id="modalVerifikasiJabatan" tabindex="-1" role="dialog" aria-labelledby="modalVerifikasiJabatan" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title titleModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" name="tahun_cetak" id="tahun_cetak">
                <input type="hidden" name="nama_atasan" id="nama_atasan">
                <input type="hidden" name="user_id10" id="user_id10"> -->
                <div class="form-group">
                    <p id="nama_pegawai"></p>
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
                <button type="button" class="btn btn-primary printPK"><i class="fa fa-check"></i>&nbsp; Cetak</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Datatables Pegawai
        dataTable = $('#tabel_usulan_jabatan').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>admin/tabelUsulanJabatan",
                "type": "POST",
            },
            columnDefs: [{
                orderable: false,
                targets: [0]
            }],
            autoWidth: !1
        });

        $(document).on('click', '.verifikasi_usulan', function() {
            var id = $(this).attr('id');

            // if (confirm('Apakah Anda yakin? Verifikasi jabatan ini??')) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/fetchUsulanJabatan',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#modalVerifikasiJabatan').modal('show');
                    $('.titleModal').text('Verifikasi Usulan Jabatan');
                    $('#nama_pegawai').text(data.id_pegawai);
                    
                }
            });
            // }
        });

        $(document).on('click', '.tolak_usulan', function() {
            var id = $(this).attr('id');

            if (confirm('Apakah Anda yakin? Tolak usulan jabatan ini??')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/tolakUsulanJabatan',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        dataTable.ajax.reload()
                        alert(data);
                    }
                });
            }
        });

        $(document).on('click', '.non_aktif_usulan', function() {
            var id = $(this).attr('id');

            if (confirm('Apakah Anda yakin? Tolak usulan jabatan ini??')) {
                $.ajax({
                    url: '<?php echo base_url(); ?>admin/nonAktifUsulan',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        dataTable.ajax.reload()
                        alert(data);
                    }
                });
            }
        });
    })
</script>