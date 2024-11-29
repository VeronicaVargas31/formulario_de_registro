function deleteUser(userId) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        $.ajax({
        url: 'borrar.php', 
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
