<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script Language="javascript" src="http://code.jquery.com/jquery-2.2.0.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
	
	<script type="text/javascript">

	$( document ).ready(function() { 
		$('#btnUpdate').hide();	
		list();	
		loadHabitaciones();
		


		$( "#habitacion" ).change(function() {
			loadAcomodacion();
		});



		function loadHabitaciones(){
			$.ajax({
				url: "controller.php", 
				type:  'post',
				data: $('#forma').serialize()+'&option=cargar',				
				success: function(response){					
					$('#habitacion').html(response);
				},
				complete : function(response){
					loadAcomodacion();
				}
				
			});
		}

		$( "#btnRegister" ).click(function() {
			var name = $('#name').val();
			var phone = $('#phone').val();
			var address = $('#address').val();

			if(name === ''){
				$('#msgError').html('Nombre del hotel requerido');
				$('#msgError').show();
			}else if(phone === '' ){
				$('#msgError').html('Teléfono requerido');
				$('#msgError').show();
			}else if(address === '' ){
				$('#msgError').html('Dirección requerido');
				$('#msgError').show();
			}else{
				
				$('#msgError').hide(); 
				$.ajax({
					url: "controller.php", 
					type:  'post',
					data: $('#forma').serialize()+'&option=insert' ,
					dataType: 'json',
					success: function(response){
						
						if (response.error == true) {
							$('#msgError').html('Ocurrio un error insertando el hotel');
							$('#msgError').show();
						}else{
							$('#msgSuccess').html('El hotel se inserto correctamente');
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
	$('#msgError').hide();
	$('#msgSuccess').hide();
});


});

function clear(){
	$('#name').val('');
	$('#phone').val('');
	$('#address').val('');

}

function loadAcomodacion(id){
	var idHabitacion = $('#habitacion').val();

	$.ajax({
		url: "controller.php", 
		type:  'post',
		data: 'idHabitacion='+idHabitacion+'&option=cargarAcomodaciones',				
		success: function(response){					
			$('#acomodacion').html(response);
		},
		complete: function(response){								
			if(id !== undefined){
				$('#acomodacion').val(id);
			}
		}
	});
}

function list(){
	$.ajax({
		url: "controller.php", 
		type:  'post',
		data: $('#forma').serialize()+'&option=list' ,
		dataType: 'json',
		success: function(response){
			
			var html = '';


			for(i = 0; i < response.length; i++){
				html += '<tr>';
				html += '<td>'+response[i].nombre+'</td>';
				html += '<td>'+response[i].telefono+'</td>';
				html += '<td>'+response[i].direccion+'</td>';
				html += '<td>'+response[i].habitacion+'</td>';
				html += '<td>'+response[i].acomodacion+'</td>';
				html += '<td><div class="delete" onclick="selectHotel('+response[i].id+')">Actualizar</div></td>';
				html += '<td><div class="delete" onclick="deleteHotel('+response[i].id+')">Eliminar</div></td>';
				html += '</tr>';
			}

			$('#listUsers tbody').html(html);

		}
	});
}
function deleteHotel(id){		
	$.ajax({
		url: "controller.php", 
		type:  'post',
		data: 'idHotel='+id+'&option=delete' , 
		dataType: 'json',
		success: function(response){
			
			if (response.error == true) {
				$('#msgError').html('Ocurrio un error eliminando el hotel');
				$('#msgError').show();
			}else{
				$('#msgSuccess').html('El hotel se elimino correctamente');
				$('#msgSuccess').show();
				list();
			}

		}
	});
}
function selectHotel(id){
		
	$('#btnRegister').hide();
	$('#btnUpdate').show();
	$.ajax({
		url: "controller.php", 
		type:  'post',
		data: 'idHotel='+id+'&option=selectHotel' , 
		dataType: 'json',
		success: function(response){
				
			
			$('#idHotel').val(response.id);
			$('#name').val(response.nombre);
			$('#phone').val(response.telefono);
			$('#address').val(response.direccion);
			$('#habitacion').val(response.id_habitacion);
			loadAcomodacion(response.id_acomodacion);
			//$('#acomodacion').val(response.id_acomodacion);
		}
	});
}

function updateHotel(){		
	var name = $('#name').val();
	var phone = $('#phone').val();
	var address = $('#address').val();
	var habitacion = $('#habitacion').val();
	var acomodacion = $('#acomodacion').val();

	if(name === ''){
		$('#msgError').html('Nombre del hotel requerido');
		$('#msgError').show();
	}else if(phone === '' ){
		$('#msgError').html('Teléfono requerido');
		$('#msgError').show();
	}else if(address === '' ){
		$('#msgError').html('Dirección requerido');
		$('#msgError').show();
	}else{
		
		$('#msgError').hide(); 
		$.ajax({
			url: "controller.php", 
			type:  'post',
			data: $('#forma').serialize()+'&option=updateHotel' ,
			dataType: 'json',
			success: function(response){
				if (response.error == true) {
					$('#msgError').html('Ocurrio un error actualizando el hotel');
					$('#msgError').show();
				}else{
					$('#msgSuccess').html('El hotel se actualizando correctamente');
					$('#msgSuccess').show();
					list();
					clear();
				}

			}
		});
	}
};

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
.forma{
	width:90%;  
	margin: 35px 150px 29px 56px;
}
.tabla{
	width:95%;
	margin-left:30px;
	margin-bottom:30px;
}

</style>
</head>
<body>

	<form name="forma" id="forma" method="post" class="forma">
		<h3><label><b>Hoteles Decameron</b></label></h3>
		<h4><label><b>Ingrese los datos del hotel</b></label></h4>
		<div class="form-group">
			<input type="hidden" name="idHotel" id="idHotel">
			<label for="id" ><b>Nombre del hotel:</b></label>
			<input type="text" name="name" id="name" placeholder="Nombre" class="form-control" >
		</div>
		<div class="form-group">
			<label for="lastName"><b>Teléfono:</b></label>
			<input type="text" name="phone" id="phone" placeholder="Teléfono" class="form-control"	>
		</div>
		<div class="form-group">
			<label for="lastName"><b>Dirección:</b></label>
			<input type="text" name="address" id="address" placeholder="Dirección" class="form-control"	>
		</div>
		<h4><label><b>Selecciona la habitación y la acomodación</b></label></h4>
		<div class="form-group">
			<label for="habitacion"><b>Habitación:</b></label>
			<select id="habitacion" name="habitacion"> 
			</select>
		</div>
		<div class="form-group">
			<label for="acomodacion"><b>Acomodación:</b></label>
			<select id="acomodacion" name ="acomodacion">
			</select>
		</div>

		<button type="button" id="btnRegister" class="btn btn-primary">
			<span>Ingresar</span>
		</button>
		<button type="button" id="btnUpdate" onclick="updateHotel()" class="btn btn-primary">
			<span>Actualizar</span>
		</button> 				
		<button type="button" id="btnLimpiar" class="btn btn-primary">
			<span>Limpiar</span>
		</button>
		
		<div id="msgError">
		</div>
		<div id="msgSuccess">
		</div>
	</form>


	<table cellpadding="1" cellspacing="1" width="100%" id="listUsers" class="table table-hover table table-bordered tabla" >
		<thead>
			<tr class="bg-primary" style="align:center"> <td colspan="7">Listado de los hoteles Decameron</td></tr>
			<tr class="bg-primary">
				<td>Nombre hotel</td>
				<td>teléfono</td>
				<td>Dirección</td>
				<td>Habitación</td>
				<td>Acomodación</td>
				<td>Actualizar</td>
				<td>Eliminar</td>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>

</body>


</html>