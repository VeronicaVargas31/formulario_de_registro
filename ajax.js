$(document).ready(function() {

    $.ajax({
        url: 'list.php',
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
                <td><button class="btn btn-outline-dark" onclick="deleteUser(${user.formulario_de_registro_id})">Eliminar</button></td>
                <td><button class="btn-editar" data-id="${user.formulario_de_registro_id}">Editar</button></td>
            </tr>
        `;
    });
    $('#tbody').html(tableBody);
}
})
