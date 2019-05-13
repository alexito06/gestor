var dialog={};

dialog.alert = function (msg){
	 BootstrapDialog.show({
                type: BootstrapDialog.TYPE_DANGER,
				
                title: 'Información',
                message: msg,
                buttons: [{
                    label: 'Aceptar'
					,action: function(thisDialog){ thisDialog.close();}
                }]
            });     
			
//	BootstrapDialog.alert(msg);
};

dialog.show = function (msg){

	if(msg === undefined){
		msg='<div style="text-align:center">Procesando información ... <img src="../img/procesando.gif" border="0"></div>';
	}
	else{
		msg = '<div style="text-align:center">'+msg+'</div>';
	}

	//try {
	dialog.b = new BootstrapDialog({ message: msg, size_normal: "10px",closable: false });
	
    dialog.b.realize();
    dialog.b.getModalHeader().hide();
	dialog.b.getModalFooter().hide();
    dialog.b.getModalBody().css('background-color', '#337ab7');
    dialog.b.getModalBody().css('color', '#fff');
	dialog.b.open();
	//}
//catch(err) {

//}
	//return false;
};
dialog.remote2 = function(liga){
	BootstrapDialog.show({
            message: function(dialog) {
                var $message = $('<div></div>');
                var pageToLoad = dialog.getData('pageToLoad');
                $message.load(pageToLoad);
        
                return $message;
            },
            data: {
                'pageToLoad': '../geolocation.php'
            }
        });
		
};
dialog.remote = function(msg, aceptFunction, title){
	 var dialogInstance3 = new BootstrapDialog({
		 buttons: [{
			icon: 'glyphicon glyphicon-eye-open',
			label: 'Cerrar',
			cssClass: 'btn-success',
			action: aceptFunction === undefined ? aux_dialog_close : aceptFunction
			}]
		})
            .setTitle(title)
            .setMessage(msg)
            .setType(BootstrapDialog.TYPE_PRIMARY)
			.setSize(BootstrapDialog.SIZE_WIDE)
            .open();
			
			
	/*BootstrapDialog.show({
		title: title,
		message: msg,
		buttons: [{
			icon: 'glyphicon glyphicon-eye-open',
			label: 'Cerrar',
			cssClass: 'btn-success',
			action: aceptFunction === undefined ? aux_dialog_close : aceptFunction
		}]
	});*/

};

dialog.close = function (){
	dialog.b.close();
};

function aux_dialog_close(dialogWin){ dialogWin.close();}





dialog.message = function(msg, aceptFunction){
	BootstrapDialog.show({
		type:BootstrapDialog.TYPE_INFO,
		title: "Información"
		,message: msg
        ,buttons: [{
            	label: 'aceptar'
              	,cssClass: 'btn btn-outline btn-primary'
              	,action: aceptFunction === undefined ? aux_dialog_close : aceptFunction
          	}]
    });
}

dialog.confirm = function(msg, aceptFunction, closeFunction){
	/*var dialogInstance = BootstrapDialog.show({
			title: "Información",
            message: 'Hello Banana!'
        });*/
	
	/*var dialogInstance = new BootstrapDialog();
        dialogInstance.setTitle('Dialog instance 2');
        dialogInstance.setMessage(msg);
        dialogInstance.setType(BootstrapDialog.TYPE_SUCCESS);
        dialogInstance.open();*/
	
	
	/*BootstrapDialog.show({
		title: "Confirmar"
		,message: msg
        ,buttons: [{
            	label: 'aceptar'
              	,cssClass: 'btn btn-outline btn-primary'
              	,action: aceptFunction
          	}, {
              	label: 'Cancelar'
				,cssClass: 'btn btn-outline btn-danger'
				,action: closeFunction === undefined ? aux_dialog_close : closeFunction
        }]
    });*/
	
	 
	BootstrapDialog.show({
			title: 'Confirmar',
			type: 'type-success',
			size: 'size-normal',
            message: msg,
            buttons: [{
                label: 'Enviar',
                cssClass: 'btn-primary',
				action: aceptFunction
            }, {
                label: 'Cancelar',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
}

dialog.succes = function (msg, aceptFunction){
	 BootstrapDialog.show({
                type: BootstrapDialog.TYPE_SUCCESS ,
				
                title: 'Registro exitoso',
                message: msg,
                buttons: [{
                    label: 'Aceptar'
					,action: aceptFunction
                }]
            });     
			
//	BootstrapDialog.alert(msg);
};

dialog.erase = function(msg, aceptFunction, closeFunction){
	 
	BootstrapDialog.show({
			title: 'Borra el registro',
			type: 'type-danger',
			size: 'size-normal',
            message: msg,
            buttons: [{
                label: 'Borrar',
                cssClass: 'btn-primary',
				action: aceptFunction
            }, {
                label: 'Cancelar',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });

}

