<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg mb-4" style="background-color: #7257e9;" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('productos.index') }}">Sistema de Inventarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('productos.index') }}">Lista de Productos</a>
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
            <div class="col-md-10">
                {{-- Muestra mensajes de éxito si existen en la sesión (enviados desde el controlador) --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Lista de Productos</h3>
                        <a href="{{ route('productos.create') }}" class="btn btn-light btn-sm">Nuevo Producto</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productos as $producto)
                                    <tr>
                                        <th scope="row">{{ $producto->id }}</th>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>${{ number_format($producto->precio, 2) }}</td>
                                        <td>{{ $producto->stock }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('productos.show', $producto->id) }}"
                                                    class="btn btn-info btn-sm">Ver</a>
                                                <a href="{{ route('productos.edit', $producto->id) }}"
                                                    class="btn btn-warning btn-sm">Editar</a>

                                                {{-- Botón para eliminar: requiere un formulario y @method('DELETE') --}}
                                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                                    @csrf
                                                    {{-- Laravel no soporta DELETE directamente en HTML, por eso usamos
                                                    @method --}}
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay productos registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Genera automáticamente los botones de paginación (Anterior/Siguiente/Números) --}}
                        <div class="d-flex justify-content-center mt-3">
                            {{ $productos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>