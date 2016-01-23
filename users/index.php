<html>
<head>
    <script Language="javascript" src="http://code.jquery.com/jquery-2.2.0.min.js"></script>

    <script type="text/javascript">

    $( document ).ready(function() {    

        $( "#name" ).keypress(function() {
            var name = $('#name').val();
            $('#nameReply').val(name);
            $('#text').html(name);
        });

        $( "#copyBtn" ).click(function() {
            var operator = 'sum';

            $.ajax({
                url: "paises.php", 
                type:  'post',
                data: $('#forma').serialize() ,
                success: function(response){
                    $('#paises').html(response);
                }
            });
        });
		
		$( "#paises" ).click(function() { 

            $.ajax({
                url: "ciudades.php", 
                type:  'post',
                data: $('#forma2').serialize() ,
                success: function(response){
                    $('#ciudades').html(response);
                }
            });
        });
    });
    
    </script>

</head>
<body>
    <form name="forma" id="forma" method="post">

        <div id="copy">
            <input type="text" name="name" id="name">
            <input type="text" name="nameReply" id="nameReply">
        </div>
    </form>
    <div id="page"></div>
    <input type="button" value="copiar" id="copyBtn">
    <form name="forma2" id="forma2" method="post">
		<select id="paises" name="pais">
		</select>
		<select id="ciudades">
		</select>
	</form>
	
	<a href="formulario.php">Registrarse</a>
</body>
</html>