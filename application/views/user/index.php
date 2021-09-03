<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <!-- <h3 class="content-header-title ml-1">Selamat Datang</h3> -->
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-xl-3 col-md-3 col-sm-12">
            <!-- <div class="sidebar-detached sidebar-left"=""> -->
            <!-- <div class="sidebar"> -->
            <div class="sidebar-content card">
                <div class="card-body">
                    <!-- Card sample -->
                    <div class="text-center">
                        <img class="card-img-top mb-1 img-fluid" data-src="holder.js/100px180/" src="<?= base_url(); ?>assets/images/profile/<?= $user['image']; ?>" style="width: 250px; height:auto;" alt="Card image cap">
                    </div>
                    <h4 class="card-title"><?= $user['nama_akun']; ?></h4>
                    <?php
                    $user_id = $this->session->userdata('id_user_detail');
                    $queryUser = "SELECT * FROM user_details
                                    JOIN bidang ON bidang.id_bidang = user_details.id_bidang
                                    JOIN jabatan ON jabatan.id_jabatan = user_details.id_jabatan 
                                    WHERE id_user_details = $user_id
                                    ";
                    $User = $this->db->query($queryUser)->result_array();
                    ?>
                    <?php foreach ($User as $row) : ?>
                        <p class="card-text"><i class="icon-tag text-primary"></i> <?= $row['nip']; ?> <br>
                            <i class="icon-trophy text-primary"></i> <?= $row['nama_bidang']; ?><br>
                            <i class="icon-badge text-primary"></i> <?= $row['nama_jabatan']; ?>
                        </p>
                    <?php endforeach; ?>
                    <!-- <a href="#" class="btn btn-primary">Button</a> -->
                    <!-- /Card sample -->
                    <hr>
                    <!-- Striped Progress sample -->
                    <div class="category-title pb-1">
                        <h6>Progress example</h6>
                    </div>
                    <div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!-- /Striped Progress sample -->
                </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->
            <!-- End sidebar content -->
        </div>
        <div class="col-xl-9 col-md-9 col-sm-12">
            <!-- Description -->
            <section id="description" class="card">
                <div class="card-header">
                    <h4 class="card-title">DATA PRIBADI</h4><br>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php foreach ($User as $row) : ?>
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-6">
                                        <p>Nama Lengkap :<br>
                                            <strong><?= $row['nama_pegawai']; ?></strong>
                                        <p>
                                        <p>Tempat Lahir : <br>
                                            <strong><?= $row['tempat_lahir']; ?></strong>
                                        </p>
                                        <p>Tanggal Lahir : <br>
                                            <strong><?= $row['tanggal_lahir']; ?></strong>
                                        </p>
                                        <p>Jenis Kelamin : <br>
                                            <?php if ($row['jenis_kelamin'] == 1) {
                                                echo '<strong>Laki-laki</strong>';
                                            } else {
                                                echo '<strong>Perempuan</strong>';
                                            } ?>
                                        </p>
                                        <p>Alamat : <br>
                                            <strong><?= $row['alamat']; ?></strong>
                                        </p>
                                        <p>No. Handphone : <br>
                                            <strong><?= $row['hp']; ?></strong>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p>Instansi : <br>
                                            <strong>RSJ. Prof. HB. Saanin Padang</strong>
                                        </p>
                                        <!-- <p>NIP : <br>
                                            <strong><?= $row['nip']; ?></strong>
                                        </p>
                                        <p>Bidang : <br>
                                            <strong><?= $row['nama_bidang']; ?></strong>
                                        </p>
                                        <p>Jabatan : <br>
                                            <strong><?= $row['nama_jabatan']; ?></strong>
                                        </p> -->
                                        <p>Pendidikan : <br>
                                            <strong><?= $row['pendidikan']; ?></strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!--/ Description -->
            <section id="description" class="card">
                <div class="card-header">
                    <h4 class="card-title">RIWAYAT JABATAN</h4><br>
                </div>
                <div class="card-content">
                    <div class="card">
                        <input type="hidden" id="id_pegawai" value="<?= $this->session->userdata('id_user_detail'); ?>">
                        <table class="table-responsive table-sm table-hover" id="tabel_usulan_jabatan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama / NIP</th>
                                    <th>Bidang</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
            <!--/ Description -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Datatables Riwayat Jabatan
        dataTable = $('#tabel_usulan_jabatan').DataTable({
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url(); ?>user/tabelUsulanJabatan",
                "type": "POST",
                "data": function(data) {
                    data.idUser = $('#id_pegawai').val();
                }
            },
            columnDefs: [{
                orderable: false,
                targets: [0]
            }],
            autoWidth: !1
        });
    })
</script>