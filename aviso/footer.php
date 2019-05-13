<!-- Bootstrap 3.3.5 -->
<script src="../style/assets/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="../style/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../style/dist/js/demo.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="../plugins/jquery.jqGrid-4.4.1/css/ui.jqgrid.css" />
<script src="../plugins/jquery.jqGrid-4.4.1/js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="../plugins/jquery.jqGrid-4.4.1/js/jquery.jqGrid.min.js"></script>

<script src="../plugins/bootstrap-dialog/bootstrap-dialog.min.js"></script>
<link href="../plugins/bootstrap-dialog/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />

<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel='stylesheet' type='text/css'>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
<script src="../plugins/common_function.js"></script>

<script>

	$(function () {
		$('.sidebar-menu li a').each(function(index) {
            if(this.href.trim() == window.location){
				var menu=this.href.trim().split('/');
				//alert(menu[7])
				var subMenu=menu[7].split('.');
				$('.treeview-menu li.'+subMenu[0]).addClass("active");
				$('.treeview.'+menu[6]).addClass("active");
            }
        });
	});

</script>

</body>
</html>