<!-- General JS Scripts -->
<script src="<?=base_url('assets/')?>modules/jquery.min.js"></script>
<script src="<?=base_url('assets/')?>modules/popper.js"></script>
<script src="<?=base_url('assets/')?>modules/tooltip.js"></script>
<script src="<?=base_url('assets/')?>modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url('assets/')?>modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?=base_url('assets/')?>modules/moment.min.js"></script>
<script src="<?=base_url('assets/')?>js/stisla.js"></script>

<!-- JS Libraies -->
<script src="<?=base_url('assets/')?>modules/sweetalert/sweetalert2.all.js"></script>
<script src="<?=base_url('assets/')?>modules/chart.min.js"></script>
<script src="<?=base_url('assets/')?>modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url('assets/')?>modules/datatables/datatables.min.js"></script>
<script src="<?=base_url('assets/')?>modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url('assets/')?>modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?=base_url('assets/')?>modules/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="<?=base_url('assets/')?>modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>



<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="<?=base_url('assets/')?>js/scripts.js"></script>
<script src="<?=base_url('assets/')?>js/custom.js"></script>
<!-- Data Table -->
<?php $this->load->view('component/data-table');?>
<!-- Sweet Alert -->
<?php $this->load->view('component/sweet-alert');?>