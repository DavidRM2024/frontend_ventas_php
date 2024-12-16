<?php 
require_once '../../partials/security/auth.php';
private_routes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestión de Productos | Productos </title>
    <?php require_once '../../partials/header.php'; ?>
    <?php require_once '../../partials/security/validateToken.php'; ?>
</head>

<body>
<?php include '../../partials/navbar.php'; ?>
<div id="content">
    <div class="container mt-4">
        <div class="card p-3">
            <h3 class="text-center">Productos</h3>
            <button id="addProductBtn" class="btn btn-success mb-3">Agregar Producto</button>
            <table id="productsTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTable cargará datos dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Agregar/Editar Producto -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="productForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="productId">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nombre</label>
                        <input type="text" id="productName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Precio</label>
                        <input type="number" id="productPrice" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" id="productStock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Categoría</label>
                        <select id="productCategory" class="form-select" required>
                            <!-- Llenar dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productSupplier" class="form-label">Proveedor</label>
                        <select id="productSupplier" class="form-select" required>
                            <!-- Llenar dinámicamente -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once '../../partials/footer.php';
?>
<body>  
<script>
$(document).ready(function () {
    const token = localStorage.getItem('token');

    // Validación del token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Sesión expirada',
            text: 'Por favor, inicia sesión nuevamente.',
            timer: 3000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'http://127.0.0.1/frontend_ventas_php/templates/auth/login.php';
        });
        return;
    }

    const table = $('#productsTable').DataTable({
        responsive: true,
        scrollX: true,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' }
    });

    function loadProducts() {
        table.clear();
        $.ajax({
            url: 'http://127.0.0.1/ventas_php/app/routes/api.php?action=producto_index',
            headers: { Authorization: 'Bearer ' + token },
            method: 'POST',
            dataType: 'json',
            success: function (response) {
                if (response && response.data) {
                    response.data.forEach(producto => {
                        table.row.add([
                            producto.id,
                            producto.nombre,
                            `$${producto.precio}`,
                            producto.stock,
                            producto.categoria_id,
                            producto.proveedor_id,
                            `
                            <button class="btn btn-sm btn-primary editBtn" data-id="${producto.id}">Editar</button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="${producto.id}">Eliminar</button>
                            `
                        ]).draw();
                    });
                } else {
                    Swal.fire({ icon: 'warning', title: 'No se encontraron productos.' });
                }
            },
            error: function () {
                Swal.fire({ icon: 'error', title: 'Error al cargar los productos.' });
            }
        });
    }

    loadProducts();

    $('#addProductBtn').click(function () {
        $('#productForm')[0].reset();
        $('#productId').val('');
        $('#productModalLabel').text('Agregar Producto');
        $('#productModal').modal('show');
    });

    $('#productForm').submit(function (e) {
        e.preventDefault();

        const id = $('#productId').val();
        const data = {
            nombre: $('#productName').val(),
            precio: $('#productPrice').val(),
            stock: $('#productStock').val(),
            categoria_id: $('#productCategory').val(),
            proveedor_id: $('#productSupplier').val(),
        };

        const url = id 
            ? `http://127.0.0.1/ventas_php/app/routes/api.php?action=producto_update&id=${id}` 
            : 'http://127.0.0.1/ventas_php/app/routes/api.php?action=producto_store';

        $.ajax({
            url: url,
            headers: { Authorization: 'Bearer ' + token },
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function () {
                Swal.fire({ icon: 'success', title: 'Producto guardado exitosamente.' });
                $('#productModal').modal('hide');
                loadProducts();
            },
            error: function () {
                Swal.fire({ icon: 'error', title: 'Error al guardar el producto.' });
            }
        });
    });

    

    $('#productsTable').on('click', '.editBtn', function () {
        const id = $(this).data('id');
        const token = localStorage.getItem('token');
    
        // Limpia y prepara el formulario
        $('#productForm')[0].reset();
        $('#productId').val('');
    
        // Realiza las peticiones en paralelo para producto, categorías y proveedores
        Promise.all([
            $.ajax({
                url: `http://127.0.0.1/ventas_php/app/routes/api.php?action=producto_show&id=${id}`,
                headers: { Authorization: 'Bearer ' + token },
                method: 'POST',
            }),
            $.ajax({
                url: 'http://127.0.0.1/ventas_php/app/routes/api.php?action=categoria_index',
                headers: { Authorization: 'Bearer ' + token },
                method: 'POST',
            }),
            $.ajax({
                url: 'http://127.0.0.1/ventas_php/app/routes/api.php?action=proveedor_index',
                headers: { Authorization: 'Bearer ' + token },
                method: 'POST',
            })
        ])
        .then(([productoResponse, categoriasResponse, proveedoresResponse]) => {
            const producto = productoResponse.data; // Datos del producto
            const categorias = categoriasResponse.data; // Categorías disponibles
            const proveedores = proveedoresResponse.data; // Proveedores disponibles
    
            if (producto) {
                // Llena los campos del formulario con los datos del producto
                $('#productId').val(producto.id);
                $('#productName').val(producto.nombre);
                $('#productPrice').val(producto.precio);
                $('#productStock').val(producto.stock);
    
                // Rellena el select de categorías
                $('#productCategory').empty();
                categorias.forEach(categoria => {
                    const selected = producto.categoria_id == categoria.id ? 'selected' : '';
                    $('#productCategory').append(
                        `<option value="${categoria.id}" ${selected}>${categoria.nombre}</option>`
                    );
                });
    
                // Rellena el select de proveedores
                $('#productSupplier').empty();
                proveedores.forEach(proveedor => {
                    const selected = producto.proveedor_id == proveedor.id ? 'selected' : '';
                    $('#productSupplier').append(
                        `<option value="${proveedor.id}" ${selected}>${proveedor.nombre}</option>`
                    );
                });
    
                // Abre el modal después de cargar todos los datos
                $('#productModalLabel').text('Editar Producto');
                $('#productModal').modal('show');
            } else {
                Swal.fire({ icon: 'error', title: 'No se encontraron datos del producto.' });
            }
        })
        .catch((error) => {
            console.error(error);
            Swal.fire({ icon: 'error', title: 'Error al cargar los datos necesarios.' });
        });
    });
    
    

    $('#productsTable').on('click', '.deleteBtn', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás recuperar este producto.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `http://127.0.0.1/ventas_php/app/routes/api.php?action=producto_delete&id=${id}`,
                    headers: { Authorization: 'Bearer ' + token },
                    method: 'POST',
                    success: function () {
                        Swal.fire('Eliminado', 'El producto ha sido eliminado.', 'success');
                        loadProducts();
                    },
                    error: function () {
                        Swal.fire('Error', 'No se pudo eliminar el producto.', 'error');
                    }
                });
            }
        });
    });
});
</script>
</html>
