<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title ml-1">Role Akses Menu</h3>
    </div>
</div>
<div class="content-body">
    <!-- Description -->
    <section id="description" class="card">
        <div class="card-header">
            <h4 class="card-title">Role : <span class="badge badge-danger"><?= $role['role']; ?></span></h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <table class="table table-bordered table-sm table-hover" id="table_role">
                    <thead>
                        <tr>
                            <th style="width: 10%;">No</th>
                            <th style="width: 85%;">Menu</th>
                            <th style="width: 55%;">Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <td><?= $i; ?> </th>
                                <td><?= $m['menu']; ?></td>
                                <td class="text-center">
                                    <input type="checkbox" class="css-control-input check" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>
                                    " data-menu=" <?= $m['id']; ?>">
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/ Description -->
</div>

<script>
    $(document).ready(function() {
        $('.check').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
                url: "<?= base_url('master/changeaccess'); ?>",
                type: 'POST',
                data: {
                    menuId: menuId,
                    roleId: roleId
                },
                success: function(data) {
                    alert(data);
                }
            });
        });
    });
</script>