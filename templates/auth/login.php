<?php 
require_once '../../partials/security/auth.php';
public_routes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestión de Productos | Login </title>
    <?php require_once '../../partials/header.php'; ?>
</head>

<body>
    <?php require_once '../../partials/navbar.php'; ?>
   

    <div class="container mt-5" id="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h2 class="text-center">Iniciar Sesión</h2>
                    <form id="loginForm" class="mt-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
            
                    <div id="loginAlert" class="alert alert-danger mt-3 d-none" role="alert">
                        Error al iniciar sesión. Por favor, verifica tus credenciales.
                    </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once '../../partials/footer.php'; ?>

</body>
<script>
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        const email = $('#email').val();
        const password = $('#password').val();

        $.ajax({
            url: 'http://127.0.0.1/ventas_php/app/routes/api.php?action=login',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ email, password }),
            success: function (response) {
                if (response.success) {
                    localStorage.setItem('token', response.token);
                    window.location.href = 'http://127.0.0.1/frontend_ventas_php/templates/productos/productos.php';
                } else {
                    $('#loginAlert').removeClass('d-none').text(response.message);
                }
            },
            error: function () {
                $('#loginAlert').removeClass('d-none').text('Ocurrió un error al intentar iniciar sesión.');
            }
        });
    });
</script>
</html>
