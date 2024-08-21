$(document).ready(function() {
    $('#register-form').on('submit', function(e) {
        e.preventDefault(); // Evita que el formulario se envíe de la manera tradicional.

        $.ajax({
            url: $(this).attr('action'), // La URL del action del formulario
            type: 'POST',
            data: $(this).serialize(), // Los datos del formulario
            success: function(response) {
                // Verifica si la respuesta contiene un éxito
                if(response.success) {
                    // Redirige al usuario al login
                    alert('Usuario registrado correctamente');
                    window.location.href = '/login'; // Reemplaza '/login' con la URL de tu página de inicio de sesión
                }
            },
            error: function(xhr) {
                // Aquí manejas lo que sucede si hay errores
                var errors = xhr.responseJSON;
                if(errors && errors.errors) { // Asegúrate de que existen errores para mostrar
                    var errorMessages = [];
                    for(var key in errors.errors) {
                        if(errors.errors.hasOwnProperty(key)) {
                            // Esto asume que cada campo tiene al menos un mensaje de error
                            errorMessages.push(errors.errors[key][0]); // Toma el primer mensaje de error
                        }
                    }
                    // Une todos los mensajes de error en una sola cadena separada por saltos de línea
                    alert(errorMessages.join('\n'));
                }
            }
        });
    });
});