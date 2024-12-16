<?php
echo '<script>
    $(document).ready(async function () {
        const token = localStorage.getItem("token");
        
        // Función para validar el token
        async function validateAuthToken() {
            return new Promise((resolve, reject) => {
                if (!token) {
                    reject("No hay token");
                    return;
                }

                // Validar el token con la API
                $.ajax({
                    url: "http://127.0.0.1/ventas_php/app/routes/api.php?action=validate_token",
                    method: "POST",
                    headers: { Authorization: "Bearer " + token },
                    success: function (response) {
                        resolve(true); // Token válido
                    },
                    error: function (xhr) {
                        if (xhr.status === 401) {
                            reject("Token inválido o expirado");
                        } else {
                            reject("Error desconocido en la validación");
                        }
                    },
                });
            });
        }

        try {
            // Validar el token antes de mostrar el contenido
            await validateAuthToken();
            // Si el token es válido, se muestra el contenido protegido
            $("#content").show();
        } catch (error) {
            // Si el token no es válido o ha expirado, se redirige al inicio de sesión
            alert("Tu sesión ha expirado. Por favor, inicia sesión nuevamente.");
            localStorage.removeItem("token"); // Eliminar token inválido
            window.location.href = "http://127.0.0.1/frontend_ventas_php/templates/auth/login.php";
        }
    });
</script>';
?>
