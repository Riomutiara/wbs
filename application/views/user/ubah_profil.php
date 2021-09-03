<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="horz-layout-basic">Ubah Profil</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <form class="form form-horizontal" method="post" id="form_ubah_profil">
                            <div class="form-body">
                                <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user_detail']; ?>">
                                <!-- DATA IDENTITAS DIRI -->
                                <?php
                                $id_user = $this->session->userdata('id_user_detail');
                                $queryUser = "SELECT * FROM user
                                                                                                            
                                                        WHERE id_user_detail = $id_user";
                                $User = $this->db->query($queryUser)->result_array();
                                ?>

                                <?php foreach ($User as $row) : ?>
                                    <h4 class="form-section"><i class="ft-user"></i> Data Profil</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="username">Username</label>
                                        <div class="col-md-5">
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= $row['username']; ?>" readonly>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3 label-control">Foto</div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img src="<?= base_url('assets/images/profile/') . $user['image']; ?>" class="img-thumbnail">
                                                    <input type="hidden" id="image_name" name="image_name" class="form-control" value="<?= $user['image']; ?>">
                                                </div>
                                                <div class="class col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                        <label class="custom-file-label" for="image">Pilih file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                <?php endforeach; ?>
                            </div>
                            <div class="form-actions text-right">                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Ubah Foto Profil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {

        $(document).on('submit', '#form_ubah_profil', function(event) {
            event.preventDefault();

            var username = $('#username').val();

            var image = $('#image').val();
            if (image == '') {
                alert('Pilih foto atau kembali ke halaman utama!! ');
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/updateProfil',
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alert(data);
                        location.reload();
                        window.location.href = '<?= base_url('user'); ?>';
                    }
                });
            }


        });

        $(document).on('click', '#reset', function() {
            location.reload();
        });
    });
</script>