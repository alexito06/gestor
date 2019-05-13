<?php
$aditionalHeader = <<<ADHEAD
  <!-- iCheck -->
	<link rel="stylesheet" href="../plugins/iCheck/skins/all.css">
	<script type="text/javascript" src="../plugins/bvalidator/jquery.validate.min.js"></script>
ADHEAD;
?>
<?php 
require_once("../header.php"); ?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
<?php 
session_start();

//if($_SESSION['userInfo']->rol!=0){
if(1!=0){

require_once("../main_header.php"); 
require_once("../menu.php"); 
?>      
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<section class="content" id="tabla">
		<div class="box box-primary">
			<div class="box-header">
				<h2> Gestor de Avisos</h2>
			</div>

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">

						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-striped table-hover tablesorter filterable" id="getConsulta" cellpadding="0" cellspacing="0"></table>
						</div>

					</div><!-- /.col-md -->
				</div><!-- /.row -->
			</div><!-- /.box-body -->
			<div class="box-footer">
			<form action="estadistica_xls.php" method="post" class="form-group success">
			<input type="date" name="fecha1" id="fecha1">
			<input type="date" name="fecha2" id="fecha2">
			<input type="submit" class="btn btn-success" value="Excell" name="desEx" id="desEx">
			</form>
				<!--<a href="../plugins/tcPDF/index.php" target="_blank"><span class="btn btn-info"> Crear PDF</span> </a>-->
			</div>
		</div><!-- /.box-primary -->
	</section>


</div><!-- /.content-wrapper -->
<script>
$(function () {
	
		var dataSend = {};
		var timeout = 10000000;
		
		$("input:text").addClass("ui-corner-all ui-widget-content");
		
		dataSend.task = "getConsulta";
		processData();

		//console.log(dataSend.task);
		function processData() {

			$.ajax({
				type: "POST",
				url: 'procesaInformacion.php',
				data: dataSend,
				dataType: "json",
				timeout: timeout,
				beforeSend: function() {
					dialog.show();
				},
				success: function(json) {
					dialog.close();
					//alert(dataSend.task)
					switch(dataSend.task){
						case "getConsulta":
							$("#getConsulta").html(json.getConsulta);
							
							$('.pdfEnv').on('click', function(e){
								
								//var id = $(this).parents("#getConsulta tbody tr").find('td:eq(0)').html();
//								console.log($(this).val());
									redirect_by_post('comprobantePDF.php', { 
										id: $(this).val() 
								}, true);

							});
							
							
							break;

						default:
							break;
					}

				return false;
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
					dialog.close();
					msg = "";
					if (textStatus == "timeout") {
						msg = "tiempo agotado";
					} else {
						//msg = messageCommon.errorSend;
						msg = "Error en la conexi&oacute;n";
					}
					dialog.alert(msg)
					return false;
				}
			});
		}


		function redirect_by_post(purl, pparameters, in_new_tab) {
			pparameters = (typeof pparameters == 'undefined') ? {} : pparameters;
			in_new_tab = (typeof in_new_tab == 'undefined') ? true : in_new_tab;
		
			var form = document.createElement("form");
			$(form).attr("id", "reg-form").attr("name", "reg-form").attr("action", purl).attr("method", "post").attr("enctype", "multipart/form-data");
			if (in_new_tab) {
				$(form).attr("target", "_self");
			}
			$.each(pparameters, function(key) {
				$(form).append('<input type="text" name="' + key + '" value="' + this + '" />');
			});
			document.body.appendChild(form);
			form.submit();
			document.body.removeChild(form);
		
			return false;
		}




	});
</script>


<?php }else{ 
require_once("../main_header_access.php"); 
?>

      <div class="content-wrapper">
        <div class="container">
        	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div class="callout callout-danger">
				<center><h1>Acceso denegado para el sistema</h1></center>
                <?php echo "<meta http-equiv=\"refresh\" content=\"1; url=../acceso/index.php\"/>"; ?>
			</div>
		</div><!-- /.container -->
      </div><!-- /.content-wrapper -->
<?php } require_once("../copyright.php"); require_once("../footer.php"); ?>