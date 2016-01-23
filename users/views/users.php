<html>
<head>
</head>
<script Language="javascript" src="http://code.jquery.com/jquery-2.2.0.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >

<script type="text/javascript">
$( document ).ready(function() {   
	list();
	$('#btnUpdate').hide();

	$( "#btnRegister" ).click(function() {
		var id = $('#id').val();
		var name = $('#name').val();
		var lastname = $('#lastname').val();

		if(id === ''){
			$('#msgError').html('cedula requerido');
			$('#msgError').show();
		}else if(name === '' ){
			$('#msgError').html('nombre requerido');
			$('#msgError').show();
		}else if(lastname === '' ){
			$('#msgError').html('apellido requerido');
			$('#msgError').show();
		}else{
			console.log('insert');
			$('#msgError').hide(); 
			$.ajax({
				url: "../controllers/users.php", 
				type:  'post',
				data: $('#forma').serialize()+'&option=insert' ,
				dataType: 'json',
				success: function(response){
					console.log(response);
					if (response.error == true) {
						$('#msgError').html('Ocurrio un error insertando el usuario');
						$('#msgError').show();
					}else{
						$('#msgSuccess').html('El ususario se inserto correctamente');
						$('#msgSuccess').show();
						list();
						clear();
					}

				}
			});
		}
	});
	
	$( "#btnLimpiar" ).click(function() {
		clear();
		$('#btnRegister').show();
		$('#btnUpdate').hide();
	});

	function clear(){
		$('#idUser').val('');
		$('#id').val('');
		$('#name').val('');
		$('#lastname').val('');
	}

});

function updateUser(){		
	var id = $('#id').val();
	var name = $('#name').val();
	var lastname = $('#lastname').val();

	if(id === ''){
		$('#msgError').html('cedula requerido');
		$('#msgError').show();
	}else if(name === '' ){
		$('#msgError').html('nombre requerido');
		$('#msgError').show();
	}else if(lastname === '' ){
		$('#msgError').html('apellido requerido');
		$('#msgError').show();
	}else{
		console.log('actualizar');
		$('#msgError').hide(); 
		$.ajax({
			url: "../controllers/users.php", 
			type:  'post',
			data: $('#forma').serialize()+'&option=update' ,
			dataType: 'json',
			success: function(response){
				if (response.error == true) {
					$('#msgError').html('Ocurrio un error actualizando el usuario');
					$('#msgError').show();
				}else{
					$('#msgSuccess').html('El ususario se actualizando correctamente');
					$('#msgSuccess').show();
					list();
					clear();
				}

			}
		});
	}
};

function deleteUser(id){		
	$.ajax({
		url: "../controllers/users.php", 
		type:  'post',
		data: 'idUser='+id+'&option=delete' , 
		dataType: 'json',
		success: function(response){
			console.log(response);
			if (response.error == true) {
				$('#msgError').html('Ocurrio un error eliminando el usuario');
				$('#msgError').show();
			}else{
				$('#msgSuccess').html('El ususario se elimino correctamente');
				$('#msgSuccess').show();
				list();
			}

		}
	});
}

function selectUser(id){	
	$('#btnRegister').hide();
	$('#btnUpdate').show();
	$.ajax({
		url: "../controllers/users.php", 
		type:  'post',
		data: 'idUser='+id+'&option=select' , 
		dataType: 'json',
		success: function(response){
			console.log(response);
			
			$('#idUser').val(response.id_usuario);
			$('#id').val(response.cedula);
			$('#name').val(response.nombre);
			$('#lastname').val(response.apellido);
		}
	});
}

function list(){
	$.ajax({
		url: "../controllers/users.php", 
		type:  'post',
		data: $('#forma').serialize()+'&option=list' ,
		dataType: 'json',
		success: function(response){
			console.log(response);
			var html = '';


			for(i = 0; i < response.length; i++){
				html += '<tr>';
				html += '<td>'+response[i].cedula+'</td>';
				html += '<td>'+response[i].nombre+'</td>';
				html += '<td>'+response[i].apellido+'</td>';
				html += '<td><div class="delete" onclick="deleteUser('+response[i].id_usuario+')">Eliminar</div></td>';
				html += '<td><div class="delete" onclick="selectUser('+response[i].id_usuario+')">Actualizar</div></td>';
				html += '</tr>';
			}

			$('#listUsers tbody').html(html);

		}
	});
}
</script>


<style type="text/css">
#msgError{
	background-color: red;
	padding: 4px;
	text-align: center;
	color: black;
	display: none;
}
#msgSuccess{
	background-color: green;
	padding: 4px;
	text-align: center;
	color: black;
	display: none;
}
.delete{
	text-decoration: underline;
	color: blue;
	cursor: pointer;
}

</style>
<body>

	<form name="forma" id="forma" method="post">
		<h3><label><b>Registrarse</b></label></h3>
		<div class="form-group">
			<input type="hidden" name="idUser" id="idUser">
			<label for="id" ><b>Cedula:</b></label>
			<input type="text" name="id" id="id" placeholder="Cedula" class="form-control" >
		</div>
		<div class="form-group">
			<label for="name"><b>Nombre(s):</b></label>
			<input type="text" name="name" id="name" placeholder="Nombre" class="form-control" >
		</div>
		<div class="form-group">
			<label for="lastName"><b>Apellido(s):</b></label>
			<input type="text" name="lastname" id="lastname" placeholder="Apellido" class="form-control"	>
		</div>
		<button type="button" id="btnRegister" class="btn btn-primary">
			<span>Ingresar</span>
		</button>
		
		<button type="button" id="btnUpdate" onclick ="updateUser()" class="btn btn-primary">
			<span>Actualizar</span>
		</button> 
		
		<button type="button" id="btnLimpiar" class="btn btn-primary">
			<span>Limpiar</span>
		</button>
	</form> 

	<div id="msgError">
	</div>
	<div id="msgSuccess">
	</div>
	<table cellpadding="1" cellspacing="1" width="100%" id="listUsers" class="table table-striped" >
		<thead>
			<tr>
				<td>CEDULA</td>
				<td>NOMBRE</td>
				<td>APELLIDO</td>
				<td>ELIMINAR</td>
				<td>ACTUALIZAR</td>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>

</body>
</html>