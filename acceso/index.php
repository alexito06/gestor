<?php
$aditionalHeader = <<<ADHEAD
  <!-- iCheck -->
	<script type="text/javascript" src="../plugins/bvalidator/jquery.validate.min3.js"></script>

ADHEAD;
?>
<?php
require_once("../header.php");
?>
<body class="hold-transition login-page">
<div class="login-box">
	
	<div class="login-box-body ui-corner-all">
    <div class="login-logo">
    	<img src="../img/user.png" width="40%" height="40%">
    </div><!-- /.login-logo -->
		<p class="login-box-msg"><b>Inicia sesi&oacute;n para ingresar al sistema</b></p>
		<form method="post" id="frmLogin">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Login" name="txtLogin" id="txtLogin" value="">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Contrase&ntilde;a" name="txtPwd" id="txtPwd" value="">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
            	<div class="col-xs-8" id="dvMsg"></div>
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-play"></span>&nbsp;Ingresar</button>
				</div><!-- /.col -->
			</div>
		</form>
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->

    
<script>
$(function () {
	$("input:text").addClass("ui-corner-all ui-widget-content");
    $("input:password").addClass("ui-corner-all ui-widget-content");
	
	$('form').validate({

		rules: {
			txtLogin: { required: true },
			txtPwd: { required: true }
		},
		messages: {
			txtLogin: { required: "Campo obligatorio."},
			txtPwd: { required: "Campo obligatorio." }
		},
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		},
		submitHandler: function(frmLogin){
			regFormulario();
		}//submitHandler
    });
	
	function regFormulario(){
		dialog.show();
		$('#frmLogin').ajaxSubmit({
			url: 'procesaInformacion.php',
			dataType: 'json',
			type: 'POST',
			data: { task: 'validaUsuario' },
			success: function(json){
				dialog.close();
				if(json.error==1){
					$("#dvMsg").html(json.mensaje);
				}else if(json.error==0){
					dialog.show(json.mensaje);
					window.location = "../inicio/inicio.php";
				}
			}
		});//fin del ajaxSubmit
	}
	
});//Fin de function
</script>

<?php  require_once("../footer.php"); ?>