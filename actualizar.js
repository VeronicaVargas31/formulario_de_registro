$(document).on('click', '.btn-editar', function() {
    var userId = $(this).data('id'); 
   
    $.ajax({
        url: 'obtener_usuario.php', 
        method: 'GET',
        data: { id: userId }, 
        success: function(response) {
        console.log("Respuesta del servidor:", response);

            try {
                var usuario = JSON.parse(response);
                $('#id').val(usuario.formulario_de_registro_id);
                $('#nombre_completo').val(usuario.nombre_completo);
                $('#genero').val(usuario.genero);
                $('#fecha_nacimiento').val(usuario.fecha_nacimiento); 
                $('#pais').val(usuario.pais);
                $('#ciudad').val(usuario.ciudad);
                $('#ocupacion').val(usuario.ocupacion);
                $('#direccion').val(usuario.direccion);
                $('#email').val(usuario.email);
                $('#phone').val(usuario.phone);

                // Mostrar el formulario de edición
                $('#formEditar').show();
            } catch (error) {
                console.error("Error al analizar la respuesta del servidor: ", error);
                alert("Error al obtener los datos del usuario.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al obtener los datos del usuario: ", error);
            alert("No se pudo cargar la información del usuario.");
        }
    });
});











$('#formEditar').submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize(); 
    $.ajax({
        url: 'actualizar.php', 
        type: 'POST', 
        data: formData, 
        dataType: 'json',
        success: function(response) {
          
            if (response.success) {
                alert('Usuario actualizado correctamente');
            } else {
                alert('Error');
            }
        },
        error: function() {
        
            console.error("Error al enviar los datos al servidor.");
            alert("No se pudo completar la solicitud.");
        }
    });
});





