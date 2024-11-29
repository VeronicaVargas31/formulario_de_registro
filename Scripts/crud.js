$(document).ready(function() {

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

function renderTable(data) {
    let tableBody = '';
    data.forEach(user => {
        tableBody += `
            <tr>
                <td>${user.formulario_de_registro_id}</td>
                <td>${user.nombre_completo}</td>
                <td>${user.genero}</td>
                <td>${user.fecha_nacimiento}</td>
                <td>${user.pais}</td>
                <td>${user.ciudad}</td>
                <td>${user.ocupacion}</td>
                <td>${user.direccion}</td>
                <td>${user.email}</td>
                <td>${user.phone}</td>
                <td><button class="btn-editar" data-id="${user.formulario_de_registro_id}">Editar</button></td>
                <td><button class="btn btn-outline-dark" onclick="deleteUser(${user.formulario_de_registro_id})">Eliminar</button></td>
            </tr>
        `;
    });
    $('#tbody').html(tableBody);
}
})



//obtener usuario y actualizar

$(document).on('click', '.btn-editar', function() {
    var userId = $(this).data('id'); 
   
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
        url: 'PHP/actualizar.php', 
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
