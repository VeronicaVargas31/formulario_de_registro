$(document).ready(function() {
new DataTable("#myTable",{
    ajax:{
        url: 'PHP/list.php',
       
     },
     columns: [
        { data: 'formulario_de_registro_id' },
        { data: 'nombre_completo' },
        { data: 'genero' },
        { data: 'fecha_nacimiento' },
        { data: 'pais' },
        { data: 'ciudad' },
        { data: 'ocupacion' },
        { data: 'direccion' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'botons'},
    ]
});






$('.speaker-form').submit(function(e){
    e.preventDefault(); 

    var formData = $(this).serialize(); 
    var formulario_de_registro = document.getElementById("formulario_de_registro");

$.ajax({
    url: 'PHP/form.php', 
    type: 'POST', 
    data: formData,
    dataType: 'json',
    success: function(response) {
        alert("Formulario enviado exitosamente"); 
        location.reload();
        console.log(response); 
// Reset the form
formulario_de_registro.reset();



 
 $.ajax({
    url: 'PHP/list.php',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
                renderTable(data);
            },
            error: function() {
                console.error("Error al obtener los datos.");
            }
        });
    },
    error: function(){
        alert("Hubo un problema al enviar el formulario. Intente nuevamente.");
    },    
 });
});
});

//obtener usuario y actualizar

$(document).on('click', '.btn-editar', function() {
    var userId = $(this).data('id'); 
   console.log(userId);
    $.ajax({
        url: 'PHP/obtener_usuario.php', 
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
                $('#formEditar').show();
            } catch (error) {
                console.error("Error al analizar la respuesta del servidor: ", error);
                alert("Error al obtener los datos del usuario.");
            }
        },
        error: function() {
            console.error("Error al obtener los datos del usuario: ", error);
            alert("No se pudo cargar la información del usuario.");
        }
    });
});

$('#formEditar').submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize(); 
    $.ajax({
        url: 'PHP/actualizar.php', 
        type: 'POST', 
        data: formData, 
        dataType: 'json',
        success: function(response) {
          
            if (response.success) {
                alert('Usuario actualizado correctamente');
                location.reload();
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



//Borrar 
function deleteUser(userId) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        $.ajax({
        url: 'PHP/borrar.php', 
        type: 'POST',
        data: { id: userId }, 
        dataType: 'json' ,
        success: function(response) {
            if (response.success) {
             
             alert('Usuario eliminado correctamente'); 
             location.reload();
            } else {
                alert('Hubo un error al eliminar el usuario');
                }
            },
            error: function() {
                console.error("Error al eliminar el usuario.");
            }
        });
    }
}
