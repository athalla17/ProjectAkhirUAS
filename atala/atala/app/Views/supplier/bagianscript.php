<script src="<?php echo base_url('/assets/user/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/popper.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/bootstrap.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/plugins/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/inspinia.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/plugins/pace/pace.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/user/js/plugins/select2/select2.full.min.js') ?>"></script>
<script>
	$(document).ready(function(){
		$('.dataTables-example').DataTable({
			pageLength: 10,
			responsive: true
		});
		$('.chosen-select').chosen({width: "100%"});
	});
</script>