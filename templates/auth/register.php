

<?php 
require_once '../../partials/security/auth.php';
public_routes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestión de Productos | Registrar Usuario </title>
    <?php require_once '../../partials/header.php'; ?>
</head>

<body>
    <?php require_once '../../partials/navbar.php'; ?>
    <div class="container mt-5" id="content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h2 class="text-center mb-4">Registrar Usuario</h2>
                    <form id="registerForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="name" placeholder="Ingresa tu nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" placeholder="ejemplo@correo.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Crea una contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirm" placeholder="Confirma tu contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once '../../partials/footer.php'; ?>

</body>
    <script>
        $(document).ready(function () {
            $('#registerForm').on('submit', function (e) {
                e.preventDefault();

                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val();
                const confirmPassword = $('#password_confirm').val();

                if (!name || !email || !password || !confirmPassword) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Todos los campos son obligatorios',
                    });
                    return;
                }

                if (password !== confirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Las contraseñas no coinciden',
                    });
                    return;
                }

                const newUser = {
                    name: name,
                    email: email,
                    password: password,
                };

                $.ajax({
                    url: 'http://127.0.0.1/ventas_php/app/routes/api.php?action=register',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(newUser),
                    success: function () {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro exitoso! Ahora puedes iniciar sesión.',
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al registrar usuario. Intenta de nuevo.',
                        });
                    }
                });
            });
        });
    </script>

</html>

