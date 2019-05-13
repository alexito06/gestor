<?php
$aditionalHeader = <<<ADHEAD
<script src="../plugins/numeric/jquery.numeric.js"></script>
<script type="text/javascript" src="../plugins/bvalidator/jquery.validate.min.js"></script>
<!-- date-picker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- date picker -->
<link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
<!-- Español -->
<script src="../plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
<!--validator-->
<script src="../plugins/bvalidator/jquery.validate.min.js"></script>
ADHEAD;
?>

<?php
require_once("../header.php");
?>

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
	<section class="content">
		<form method="post" id="profileForm">
                    <div class="box box-primary">
                    
                    <div class="box-header">
                    <h2> Test</h2>
                    </div>

                    <div class="box-body">

						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-striped table-hover tablesorter filterable" id="getleerArchivo" cellpadding="0" cellspacing="0"></table>
						</div>

                    </div>
                    
                    <div class="box-footer">
						<div class="col-md-9">
                        <div class="col-md-9">
                            <label for="exampleInputFile">Buscar Archivo</label>
                            <input type="file" id="miArchivo" name="miArchivo">
                        </div>
					</div>
						<button type="submit" class="btn btn-success" id="enviardatos"><span class="glyphicon glyphicon-send"></span> Enviar</button>
                        <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Limpiar</button>
                       <!-- <a href="index2.1.php" class="btn btn-info" role="button"><span class="glyphicon glyphicon-search"></span> Consultar</a>-->
					</div>
                    </div>
                    </form><!-- /.box-primary -->
	</section>
</div><!-- /.content-wrapper -->

<script>
$(function () {

		var timeout = 100000;
		var dataSend = new FormData();

		dataSend.append('task','getleerArchivo');
		dataSend.task='getleerArchivo';
		processData(dataSend);

	$('#profileForm').on('init.field.fv', function(e, data) {

		var $icon = data.element.data('fv.icon'),options = data.fv.getOptions(),validators = data.fv.getOptions(data.field).validators;

		if (validators.notEmpty && options.icon && options.icon.required) {$icon.addClass(options.icon.required).show(); }

		}).
	formValidation({

		framework: 'bootstrap',
		excluded: [':disabled, :not(:visible)'],
		icon: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			miArchivo:{
				// The title field is placed inside .col-xs-8 element
				validators: {
					notEmpty: {
						message: 'Campo obligatorio'
					}
				}
			}

		}

	}).on('success.field.fv', function(e, data) {

		data.fv.disableSubmitButtons(false);

	}).on('success.form.fv', function(e) {
		
		// Prevent default form submission
		e.preventDefault();

		var $form = $(e.target),
			$button = $form.data('formValidation').getSubmitButton(),dataSend = new FormData();

		$('input[type="file"]').each(function($i){
			dataSend.append($(this).prop("id"), $(this)[0].files[0]);
		});

		var other_data = $('#profileForm').serializeArray();

		$.each(other_data,function(key,input){
			dataSend.append(input.name,input.value);
		});

		dataSend.append('task','getEnviarArchivo');
		dataSend.task='getEnviarArchivo';
		processData(dataSend);

	});

	function processData(dataSend) {	

		$.ajax({
			type: "POST",
			url: 'procesaInformacion.php',
			data: dataSend,
			dataType: "json",
			timeout: timeout,
			processData: false,
			contentType: false,
			beforeSend: function() { dialog.show(); },
			complete: function(){ dialog.close(); },
			success: function(json) {

				switch(dataSend.task){

					case "getleerArchivo":

					if(json.success){

						$("#getleerArchivo").html(json.getleerArchivo);

					} if(json.error) {

						

					}
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