<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 20px;" background-color="black">
        <ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('productos.edit') }}">Editar Producto</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('productos.show') }}">Buscar Producto</a>
  </li>
</ul>
        <h1>Sistema de Inventarios</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Stock</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Celular</td>
      <td>1000</td>
      <td>10</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Laptop</td>
      <td>2000</td>
      <td>5</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Mouse</td>
      <td>100</td>
      <td>20</td>
    </tr>
  </tbody>
</table>
<a href="{{ route('productos.edit') }}" class="btn btn-warning" style="margin-right: 5px;">Editar</a>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
