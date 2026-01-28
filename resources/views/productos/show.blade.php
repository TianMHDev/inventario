<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar idéntica a la principal -->
    <nav class="navbar navbar-expand-lg mb-4" style="background-color: #7257e9;" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('productos.index') }}">Sistema de Inventarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.index') }}">Lista de Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('productos.create') }}">Agregar Producto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h3 class="mb-0">Detalles del Producto</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            {{-- Mostramos los datos directamente desde el objeto $producto que envió el controlador
                            --}}
                            <div class="col-sm-4 fw-bold">ID:</div>
                            <div class="col-sm-8">{{ $producto->id }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Nombre:</div>
                            <div class="col-sm-8">{{ $producto->nombre }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Precio:</div>
                            <div class="col-sm-8">${{ number_format($producto->precio, 2) }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Stock:</div>
                            <div class="col-sm-8">{{ $producto->stock }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Creado el:</div>
                            {{-- Formateamos las fechas de creación y actualización para que sean legibles --}}
                            <div class="col-sm-8">{{ $producto->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold">Última actualización:</div>
                            <div class="col-sm-8">{{ $producto->updated_at->format('d/m/Y H:i') }}</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('productos.index') }}" class="btn btn-outline-light">Volver</a>
                            <a href="{{ route('productos.edit', $producto->id) }}"
                                class="btn btn-warning px-4 fw-bold">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>