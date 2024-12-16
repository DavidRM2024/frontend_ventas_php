<?php

function private_routes()
{
    echo '
    <script>
        let token = localStorage.getItem("token");
        if (!token) {
            window.location.href = "http://127.0.0.1/frontend_ventas_php/templates/auth/login.php";
        } 
    </script>';
}

function public_routes()
{
    echo '
    <script>
        let token = localStorage.getItem("token");
        if (token) {
             window.location.href = "http://127.0.0.1/frontend_ventas_php/templates/productos/productos.php";
        }
    </script>';
}
