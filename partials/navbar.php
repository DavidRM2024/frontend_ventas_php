<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://127.0.0.1/frontend_ventas_php">Gestión de Productos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="http://127.0.0.1/frontend_ventas_php/templates/auth/register.php">Registrar Usuario</a></li>
                <li class="nav-item"><a class="nav-link" href="http://127.0.0.1/frontend_ventas_php/templates/auth/login.php">Iniciar Sesión</a></li>
                <li class="nav-item"><a class="nav-link" href="http://127.0.0.1/frontend_ventas_php/templates/productos/productos.php">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="http://127.0.0.1/frontend_ventas_php/templates/auth/logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav> 
<script>
    token = localStorage.getItem("token");
    if (token) {
        $('a[href="http://127.0.0.1/frontend_ventas_php/templates/auth/login.php"]').parent().hide();
        $('a[href="http://127.0.0.1/frontend_ventas_php/templates/auth/register.php"]').parent().hide();
    } else {
        $('a[href="http://127.0.0.1/frontend_ventas_php/templates/productos/productos.php"]').parent().hide();
        $('a[href="http://127.0.0.1/frontend_ventas_php/templates/auth/logout.php"]').parent().hide();
    }
</script>