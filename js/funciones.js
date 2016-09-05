$(document).ready(function($){
	$("#uni").autocomplete({
    source: './controllers/uniController.php',
    minLength:2
    });
});

function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function validaLetra(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==32){
        return true;
    }     
    patron =/[a-zA-Z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

////////////////Menu paso a paso////////////////////

$(document).ready(function () {

    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });

    $(".prev-step").click(function (e) {
    	
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });

});


function nextTab(elem) {

    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}



$(document).ready(function(){
    // Bloqueamos el SELECT de los cursos
    $("#txt-sem").prop('disabled', true);
    
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
    $("#stl-estacion").change(function(){
        // Guardamos el select de cursos
        var semana = $("#txt-sem");
        
        // Guardamos el select de alumnos
        var estacion = $(this);
        
        if($(this).val() != '')
        {
            $.ajax({
                data: { codestacion : estacion.val() },
                url:   '?controller=variables&action=TraerSemana',
                type:  'POST',
                dataType: 'json',
                beforeSend: function () 
                {
                    estacion.prop('disabled', true);
                },
                success:  function (r) 
                {
                    estacion.prop('disabled', false);
                    
                    // Limpiamos el select
                    //semana.find('option').remove();
                    
                    $(r).each(function(i,obj){ // indice, valor
                    	alert(obj['descgrado']);
                        semana.append('<h4>Planilla a cargo del: ' + obj['descgrado'] + ' ' + obj['apeynom'] + ' Fecha autorizada: ' + obj['semana'] + '</h4>');
                    })
                    
                    semana.prop('disabled', false);
                },
                error: function()
                {
                    alert('Ocurrio un error en el servidor ..');
                    estacion.prop('disabled', false);
                }
            });
        }
        else
        {
            //cursos.find('option').remove();
            semana.prop('disabled', true);
        }
    })
})
































function ValidarUsuario(){
    var pagina = "./administrador.php";
	var nombre = $("#txtNom").val();
	var mail = $("#txtMail").val();
	var clave = $("#txtClave").val();

    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "validarUsuario",
			nombre : nombre,
			mail : mail,
			clave : clave
		},
        async: true
    })
	.done(function (objJson) {
		if(objJson.Exito){
			window.location="./index.php";	
		}
		else{
			window.location="./login.php"
		}

		if(!objJson.Exito){
			alert(objJson.Mensaje);	
		}
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
		
}


function EditarInsertarUser(queHacer)
{
    var pagina = "./administrador.php";

	if (queHacer=="CargarUsuario")
	{
		var nombre = $("#nombreI").val();
		var mail = $("#mailI").val();
		var clave = $("#pwdI").val();	
	}
	else
	{
		var nombre = $("#nombre").val();
		var mail = $("#mail").val();
		var clave = $("#pwd").val();	
	}

	//alert(idUser);
	//var usuario={};
	//usuario.id = idUser;
	//usuario.nombre = nombre;
	//usuario.mail = mail;
	//usuario.clave=clave;

	// if(!Validar(producto)){
	// 	alert("Debe completar TODOS los campos!!!");
	// 	return;
	// }
    $.ajax({
        type: 'post',
        url: pagina,
        dataType: "json",
        data: {
			queHago : queHacer,
			id : idUser,
			nombre : nombre,
			mail : mail,
			clave : clave
		},
        async: true
    })
	.done(function (objJson) {	
		if(!objJson.Exito){
			alert(objJson.Mensaje);	
		}
		$("body").removeClass('modal-open');
		$("div").removeClass('modal-backdrop fade in');
		Mostrar("MostrarGrilla");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
		
}
function MostrarTodo()
{
	Mostrar("MostrarGrilla");
}

function EditarPerfil()
{
	Mostrar("MostrarEditarPerfil");
}

function MostrarPerfil()
{
	Mostrar("MostrarPerfil");
}

function EditarModal(objJson){
	idUser=objJson.id;
	$("#nombre").val(objJson.nombre);
	$("#mail").val(objJson.mail);
	$("#pwd").val(objJson.clave);
}

//function InsertarModal(){
//	document.getElementById( "modelIE" ).setAttribute( "onClick", "EditarInsertarUser('CargarUsuario');" );
//}

function Mostrar(queMostrar)
{
	var funcionAjax=$.ajax({
		url:"./administrador.php",
		type:"post",
		data:{queHago:queMostrar}
	});
	funcionAjax.done(function(retorno){
		$("#principal").html(retorno);
		//$("#informe").html("Correcto!!!");	
	});
	funcionAjax.fail(function(retorno){
		$("#principal").html(":(");
		//$("#informe").html(retorno.responseText);	
	});
	funcionAjax.always(function(retorno){
		//alert("siempre "+retorno.statusText);
	});
}
function Deslogear(){
	var funcionAjax=$.ajax({
		url:"./administrador.php",
		type:"post",
		data:{queHago:"deslogear"}	
	});
	window.location="./login.php"
}

function BorrarUser()
{
	$.ajax({
        type: 'post',
        url: "./administrador.php",
        dataType: "json",
        data: {
			queHago : "BorrarUsuario",
			id : idUser
		},
        async: true
    })
	.done(function (objJson) {	
		if(!objJson.Exito){
			alert(objJson.Mensaje);	
		}
		$("body").removeClass('modal-open');
		$("div").removeClass('modal-backdrop fade in');
		Mostrar("MostrarGrilla");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   
}

function ConfirmarBorrar(idUsuario)
{
	idUser=idUsuario;
}

function SubirFoto(antFoto){
	
    var pagina = "./administrador.php";
	var foto = $("#archivo").val();
	var scrFoto = antFoto;

	//alert(scrFoto);

	if(foto === "")
	{
		return;
	}

	var archivo = $("#archivo")[0];
	var formData = new FormData(); //permite subir archivos
	formData.append("archivo",archivo.files[0]);//configurar el objeto
	formData.append("queHago", "subirFoto");
	formData.append("srcFoto", scrFoto);


	$.ajax({
        type: 'post',
        url: pagina,
        dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
        data: formData,
        async: true
    })
	.done(function (objJson) {//es una funcion que recibe un delegado una repuesta puede ser cualquier texto

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		$("#divFoto").html(objJson.Html);
		Mostrar("MostrarEditarPerfil");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {//recibe mas parametros entre ellos errores
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    }); 
    //son funciones q se disparan depues de que vuelve la funcion de la base de datos  
}

function BorrarFoto(srcFoto){

	var pagina = "./administrador.php";
	var foto =srcFoto;
	
	if(foto === "")
	{
		alert("No hay foto que borrar!!!");
		return;
	}
	
	$.ajax({ 
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "borrarFoto",
			foto : foto
		},
        async: true
    })
	.done(function (objJson) {

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		//$("#divFoto").html(objJson.Html);
		Mostrar("MostrarEditarPerfil");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   	
	
	return;
}

function EditarMiPerfil()
{
    var pagina = "./administrador.php";
	var nombre = $("#nombre").val();
	var mail = $("#mail").val();
	var clave = $("#pwd1").val();
	var clave2 = $("#pwd2").val();

	//if (clave1==clave2) {	
		//document.getElementById("divPassword").innerHTML ="<br>no son iguales las claves.<br/>";
	//}

    $.ajax({
        type: 'post',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "ModificarPerfil",
			nombre : nombre,
			mail : mail,
			clave : clave
		},
        async: true
    })
	.done(function (objJson) {	
		if(!objJson.Exito){
			alert(objJson.Mensaje);	
		}
		Mostrar("MostrarPerfil");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    	
}



