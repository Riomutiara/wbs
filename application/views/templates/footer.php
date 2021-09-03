    </div>
    </div>
    <!-- End Content -->
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="<?= base_url(); ?>assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/vendors/js/ui/jquery.sticky.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    
    <script src="<?= base_url(); ?>assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN STACK JS-->
    <script src="<?= base_url(); ?>assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/core/app.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/scripts/customizer.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <!-- END STACK JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>

    <script type="text/javascript" src="<?= base_url(); ?>assets/vendors/js/ui/prism.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/scripts/tooltip/tooltip.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/scripts/forms/checkbox-radio.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.datetimepicker.full.min.js"></script>
<!-- selectpicker -->
    <!-- END PAGE LEVEL JS-->
    <!-- selectpicker -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script> -->
    </body>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    </html>